<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Starry Particles - Mobile Optimized with Web Worker</title>
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
    <canvas id="background"></canvas>
    <script>
        /* === CANVAS === */
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
        // Reduced numbers for mobile optimization
        const NUM_PARTICLES = 50; // significantly fewer stars for mobile
        const BIG_STAR_CHANCE = 0.15; // fewer big stars
        const MIN_SPEED = 0.15;
        const MAX_SPEED = 1.5;
        const PARALLAX_MIN = 0.2;
        const PARALLAX_MAX = 0.8; // reduced parallax effect
        const SHOOT_INTERVAL_MIN = 15000; // less frequent shooting stars
        const SHOOT_INTERVAL_MAX = 25000;

        /* === STATE === */
        let particles = [];
        let shootingStars = [];
        let frameSkip = 0; // For skipping frames on mobile

        const randVel = () => (Math.random() - 0.5) * 0.8; // slower movement

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
                r: isBig ? randRange(3, 6) : randRange(1.5, 3), // smaller sizes
                depth: randRange(PARALLAX_MIN, PARALLAX_MAX),
                twinkleOffset: Math.random() * Math.PI * 2,
                twinkleSpeed: randRange(0.5, 1.5), // slower twinkle
                isBig,
            });
        }

        /* === INTERACTION === */
        // Simplified interaction for mobile - just to track touches
        const mouse = {
            x: -9999,
            y: -9999
        };

        // Touch support
        window.addEventListener('touchmove', e => {
            if (e.touches.length > 0) {
                mouse.x = e.touches[0].clientX;
                mouse.y = e.touches[0].clientY;
            }
        });
        window.addEventListener('touchend', () => {
            mouse.x = mouse.y = -9999;
        });

        /* === DRAW HELPERS === */
        function drawStar(ctx, x, y, r) {
            // Simpler star drawing - just a circle for efficiency
            ctx.beginPath();
            ctx.arc(x, y, r, 0, Math.PI * 2);
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

            // Draw particles with the updated positions (with frame skipping)
            frameSkip++;
            if (frameSkip % 2 === 0) { // Only draw every other frame
                drawAllStarsAndShootingStars();
            }
        };

        /* === ANIMATION === */
        let lastTime = performance.now();

        function animate(time) {
            const dt = time - lastTime;
            lastTime = time;
            requestAnimationFrame(animate);

            // Only send updates to the worker every other frame
            if (frameSkip % 2 === 0) {
                // Tell worker to calculate the next physics step
                worker.postMessage({
                    type: 'step',
                    data: {
                        dt,
                        time,
                        mouse // Pass mouse coords for interaction
                    }
                });
            }
        }

        // Function to handle all drawing logic
        function drawAllStarsAndShootingStars() {
            // Clear & backdrop
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = 'rgba(0,0,35,0.25)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            /* --- Stars --- */
            // No blur filter for better performance
            ctx.fillStyle = 'rgb(50,160,255)';

            for (const p of particles) {
                // Twinkle + depth fade
                const base = 0.6 + 0.4 * Math.sin(lastTime / 1000 * p.twinkleSpeed + p.twinkleOffset);
                ctx.globalAlpha = base * p.depth;
                drawStar(ctx, p.x, p.y, p.r);
            }

            ctx.globalAlpha = 1;

            /* --- Shooting stars (simpler) --- */
            ctx.strokeStyle = 'rgba(255,255,255,0.8)';
            ctx.lineWidth = 1.5;
            for (const s of shootingStars) {
                ctx.beginPath();
                ctx.moveTo(s.x, s.y);
                ctx.lineTo(s.x - s.dx * 3, s.y - s.dy * 3);
                ctx.stroke();
            }
        }

        // Start the animation loop
        requestAnimationFrame(animate);
    </script>
</body>

</html>