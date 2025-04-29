<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Starry Particles – v5</title>
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
    const particles = [];
    const shootingStars = [];
    let nextShootAt = performance.now() + randRange(SHOOT_INTERVAL_MIN, SHOOT_INTERVAL_MAX);
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

    function spawnShootingStar() {
        const startX = Math.random() < 0.5 ? randRange(0, canvas.width) : -50;
        const startY = Math.random() < 0.5 ? -50 : randRange(0, canvas.height);
        const angle = Math.atan2(canvas.height - startY, canvas.width - startX) + randRange(-0.2, 0.2);
        shootingStars.push({
            x: startX,
            y: startY,
            dx: Math.cos(angle) * 8,
            dy: Math.sin(angle) * 8,
            life: 1000,
        });
    }

    /* === ANIMATION === */
    let lastTime = performance.now();

    function animate(time) {
        const dt = time - lastTime;
        lastTime = time;
        requestAnimationFrame(animate);

        // Clear & backdrop
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = 'rgba(0,0,35,0.25)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Shooting star timing
        if (time > nextShootAt) {
            spawnShootingStar();
            nextShootAt = time + randRange(SHOOT_INTERVAL_MIN, SHOOT_INTERVAL_MAX);
        }

        /* --- Stars --- */
        ctx.filter = 'blur(1px)';
        ctx.fillStyle = 'rgb(50,160,255)';

        for (const p of particles) {
            // Cursor repulsion
            const dxm = p.x - mouse.x;
            const dym = p.y - mouse.y;
            const distm = Math.hypot(dxm, dym);
            if (distm < 100) {
                const strength = (100 - distm) / 100;
                p.dx += (dxm / distm) * strength * 0.8;
                p.dy += (dym / distm) * strength * 0.8;
            }

            // Position update w/ parallax
            p.x += p.dx * p.depth;
            p.y += p.dy * p.depth;

            // Speed clamp
            let speed = Math.hypot(p.dx, p.dy);
            if (speed > MAX_SPEED) {
                p.dx = (p.dx / speed) * MAX_SPEED;
                p.dy = (p.dy / speed) * MAX_SPEED;
            } else if (speed < MIN_SPEED) {
                p.dx = (p.dx / speed) * MIN_SPEED;
                p.dy = (p.dy / speed) * MIN_SPEED;
            }

            // Bounce
            if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
            if (p.y < 0 || p.y > canvas.height) p.dy *= -1;

            // Twinkle + depth fade
            const base = 0.6 + 0.4 * Math.sin(time / 1000 * p.twinkleSpeed + p.twinkleOffset);
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
        for (let i = shootingStars.length - 1; i >= 0; i--) {
            const s = shootingStars[i];
            s.x += s.dx;
            s.y += s.dy;
            s.life -= dt;
            ctx.beginPath();
            ctx.moveTo(s.x, s.y);
            ctx.lineTo(s.x - s.dx * 4, s.y - s.dy * 4);
            ctx.stroke();
            if (s.life <= 0 || s.x > canvas.width + 50 || s.y > canvas.height + 50) {
                shootingStars.splice(i, 1);
            }
        }
    }

    requestAnimationFrame(animate);
    </script>
</body>

</html>