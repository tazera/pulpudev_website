<?php
// This file is a special case that needs to be accessed directly
// But we'll add a back-to-site link when accessed directly for better UX
$is_direct_access = !isset($_SERVER['HTTP_REFERER']) || 
                   strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false;

$back_to_site_html = '';
if ($is_direct_access) {
    $back_to_site_html = '
    <div id="back-to-site">
        <a href="/pages/home/home.php">Back to Site</a>
    </div>
    <style>
        #back-to-site {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: rgba(0,0,0,0.7);
            padding: 10px 15px;
            border-radius: 5px;
        }
        #back-to-site a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-family: system-ui, sans-serif;
        }
        #back-to-site a:hover {
            text-decoration: underline;
        }
    </style>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Starry Particles with Web Worker</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
            font-family: system-ui, sans-serif;
            color: white;
        }

        #background {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
            /* allow clicks through */
        }
    </style>
</head>

<body>
    <?php echo $back_to_site_html; ?>
    <canvas id="background"></canvas>
    <script>
        /* === CANVAS SETUP === */
        const canvas = document.getElementById('background');
        const ctx = canvas.getContext('2d');



        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            // Inform worker of size change if it exists
            if (worker) {
                worker.postMessage({
                    type: 'resize',
                    data: {
                        width: canvas.width,
                        height: canvas.height
                    }
                });
            }
        }
        window.addEventListener('resize', resize);
        resize();

        /* === CONFIG === */
        const NUM_PARTICLES = 220; // more stars overall
        const BIG_STAR_CHANCE = 0.25; // more giants
        const MIN_SPEED = 0.25;
        const MAX_SPEED = 2.5;
        const PARALLAX_MIN = 0.2; // farther layer depth
        const PARALLAX_MAX = 1;
        const SHOOT_INTERVAL_MIN = 8000;
        const SHOOT_INTERVAL_MAX = 15000;

        /* === STATE === */
        let particles = [];
        let shootingStars = [];
        let bigStarClickCount = 0;

        const randVel = () => (Math.random() - 0.5) * 1.2;

        function randRange(min, max) {
            return Math.random() * (max - min) + min;
        }

        // Spawn stars
        for (let i = 0; i < NUM_PARTICLES; i++) {
            const isBig = Math.random() < BIG_STAR_CHANCE;
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                dx: randVel(),
                dy: randVel(),
                r: isBig ? randRange(5, 10) : randRange(2.5, 5), // bigger sizes
                depth: randRange(PARALLAX_MIN, PARALLAX_MAX),
                twinkleOffset: Math.random() * Math.PI * 2,
                twinkleSpeed: randRange(1, 3),
                isBig,
            });
        }

        /* === INTERACTION === */
        const mouse = {
            x: -9999,
            y: -9999
        };
        window.addEventListener('mousemove', e => {
            mouse.x = e.clientX;
            mouse.y = e.clientY;
        });
        window.addEventListener('mouseleave', () => {
            mouse.x = mouse.y = -9999;
        });

        // Easter‑egg: click three giants
        window.addEventListener('click', e => {
            const {
                clientX,
                clientY
            } = e;
            particles.forEach(p => {
                if (p.isBig && Math.hypot(p.x - clientX, p.y - clientY) <= p.r) {
                    bigStarClickCount += 1;
                    if (bigStarClickCount >= 3) {
                        bigStarClickCount = 0;
                        alert('✨ You found the Easter egg! ✨');
                    }
                }
            });
        });

        /* === DRAW HELPERS === */
        function drawStar(ctx, x, y, r, spikes = 5) {
            const step = Math.PI / spikes;
            let rot = -Math.PI / 2;
            const inner = r * 0.5;
            ctx.beginPath();
            for (let i = 0; i < spikes; i++) {
                ctx.lineTo(x + Math.cos(rot) * r, y + Math.sin(rot) * r);
                rot += step;
                ctx.lineTo(x + Math.cos(rot) * inner, y + Math.sin(rot) * inner);
                rot += step;
            }
            ctx.closePath();
            ctx.fill();
        }

        /* === WEB WORKER SETUP === */
        // Create the Web Worker
        const worker = new Worker('/components/background_animation/physics.js');

        // Initialize the worker with our particles and canvas dimensions
        worker.postMessage({
            type: 'init',
            data: {
                particles,
                width: canvas.width,
                height: canvas.height
            }
        });

        // Handle messages from the worker
        worker.onmessage = e => {
            // Update our local copy of the particles
            particles = e.data.particles;
            shootingStars = e.data.shootingStars;

            // Draw particles with the updated positions
            drawAllStarsAndConstellations();
        };

        /* === ANIMATION === */
        let lastTime = performance.now();

        function animate(time) {
            const dt = time - lastTime;
            lastTime = time;

            // Physics step
            worker.postMessage({
                type: 'step',
                data: {
                    dt,
                    time,
                    mouse
                }
            });
            requestAnimationFrame(animate);
        }


        // Function to handle all drawing logic
        function drawAllStarsAndConstellations() {
            // Clear & backdrop
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = 'rgba(0,0,35,0.25)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            /* --- Stars --- */
            ctx.filter = 'blur(1px)';
            ctx.fillStyle = 'rgb(50,160,255)';

            for (const p of particles) {
                // Twinkle + depth fade
                const base = 0.6 + 0.4 * Math.sin(lastTime / 1000 * p.twinkleSpeed + p.twinkleOffset);
                ctx.globalAlpha = base * p.depth; // far stars dimmer
                drawStar(ctx, p.x, p.y, p.r);
            }

            ctx.globalAlpha = 1;

            /* --- Constellation lines --- */
            const hoverStars = particles.filter(p => Math.hypot(p.x - mouse.x, p.y - mouse.y) < 120);
            ctx.strokeStyle = 'rgba(80,180,255,0.3)';
            ctx.lineWidth = 1;
            for (let i = 0; i < hoverStars.length; i++) {
                for (let j = i + 1; j < hoverStars.length; j++) {
                    const a = hoverStars[i];
                    const b = hoverStars[j];
                    if ((a.x - b.x) ** 2 + (a.y - b.y) ** 2 < 4000) {
                        ctx.beginPath();
                        ctx.moveTo(a.x, a.y);
                        ctx.lineTo(b.x, b.y);
                        ctx.stroke();
                    }
                }
            }

            /* --- Shooting stars --- */
            ctx.filter = 'none';
            ctx.strokeStyle = 'rgba(255,255,255,0.9)';
            ctx.lineWidth = 2;
            for (const s of shootingStars) {
                ctx.beginPath();
                ctx.moveTo(s.x, s.y);
                ctx.lineTo(s.x - s.dx * 4, s.y - s.dy * 4);
                ctx.stroke();
            }
        }

        // Start the animation loop
        requestAnimationFrame(animate);
    </script>
</body>

</html>