<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Starry Particles – v5 (Constellations via Spatial Hash)</title>
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
        }
    </style>
</head>

<body>
    <canvas id="background"></canvas>
    <script>
        /* === CANVAS SETUP === */
        const canvas = document.getElementById('background');
        const ctx = canvas.getContext('2d');

        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resize);
        resize();

        /* === CONFIG === */
        const NUM_PARTICLES = 220;
        const BIG_STAR_CHANCE = 0.25;
        const MIN_SPEED = 0.25;
        const MAX_SPEED = 2.5;
        const PARALLAX_MIN = 0.2;
        const PARALLAX_MAX = 1;
        const SHOOT_INTERVAL_MIN = 8000;
        const SHOOT_INTERVAL_MAX = 15000;

        // Constellation optimization via spatial hash
        const CONSTELLATION_MAX_CONNECTIONS = 3;
        const CONSTELLATION_HOVER_RADIUS = 120;
        const CONSTELLATION_THRESHOLD_SQ = 4000; // squared distance threshold (~63px)
        const CELL_SIZE = Math.sqrt(CONSTELLATION_THRESHOLD_SQ);

        /* === STATE === */
        const particles = [];
        const shootingStars = [];
        let nextShootAt = performance.now() + Math.random() * (SHOOT_INTERVAL_MAX - SHOOT_INTERVAL_MIN) + SHOOT_INTERVAL_MIN;
        let bigStarClickCount = 0;

        const randRange = (min, max) => Math.random() * (max - min) + min;
        const randVel = () => (Math.random() - 0.5) * 1.2;

        for (let i = 0; i < NUM_PARTICLES; i++) {
            const isBig = Math.random() < BIG_STAR_CHANCE;
            particles.push({
                x: randRange(0, canvas.width),
                y: randRange(0, canvas.height),
                dx: randVel(),
                dy: randVel(),
                r: isBig ? randRange(5, 10) : randRange(2.5, 5),
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
        window.addEventListener('click', e => {
            particles.forEach(p => {
                if (p.isBig && Math.hypot(p.x - e.clientX, p.y - e.clientY) <= p.r) {
                    if (++bigStarClickCount >= 3) {
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
                life: 1000
            });
        }

        /* === ANIMATION === */
        let lastTime = performance.now();

        function animate(time) {
            const dt = time - lastTime;
            lastTime = time;
            requestAnimationFrame(animate);

            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = 'rgba(0,0,35,0.25)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            if (time > nextShootAt) {
                spawnShootingStar();
                nextShootAt = time + randRange(SHOOT_INTERVAL_MIN, SHOOT_INTERVAL_MAX);
            }

            // Draw stars
            ctx.filter = 'blur(1px)';
            ctx.fillStyle = 'rgb(50,160,255)';
            for (const p of particles) {
                const dxm = p.x - mouse.x,
                    dym = p.y - mouse.y;
                const distm = Math.hypot(dxm, dym);
                if (distm < CONSTELLATION_HOVER_RADIUS) {
                    const strength = (CONSTELLATION_HOVER_RADIUS - distm) / CONSTELLATION_HOVER_RADIUS;
                    p.dx += (dxm / distm) * strength * 0.8;
                    p.dy += (dym / distm) * strength * 0.8;
                }
                p.x += p.dx * p.depth;
                p.y += p.dy * p.depth;
                const speed = Math.hypot(p.dx, p.dy);
                if (speed > MAX_SPEED) {
                    p.dx = (p.dx / speed) * MAX_SPEED;
                    p.dy = (p.dy / speed) * MAX_SPEED;
                } else if (speed < MIN_SPEED) {
                    p.dx = (p.dx / speed) * MIN_SPEED;
                    p.dy = (p.dy / speed) * MIN_SPEED;
                }
                if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
                const base = 0.6 + 0.4 * Math.sin(time / 1000 * p.twinkleSpeed + p.twinkleOffset);
                ctx.globalAlpha = base * p.depth;
                drawStar(ctx, p.x, p.y, p.r);
            }
            ctx.globalAlpha = 1;

            /* --- Constellation lines via spatial hash --- */
            // Build hash only for hovered stars
            const hoverStars = particles.filter(p => {
                const dx = p.x - mouse.x,
                    dy = p.y - mouse.y;
                return dx * dx + dy * dy < CONSTELLATION_HOVER_RADIUS * CONSTELLATION_HOVER_RADIUS;
            });
            const grid = new Map();
            for (const p of hoverStars) {
                const cellX = Math.floor(p.x / CELL_SIZE);
                const cellY = Math.floor(p.y / CELL_SIZE);
                const key = cellX + ',' + cellY;
                if (!grid.has(key)) grid.set(key, []);
                grid.get(key).push(p);
            }
            ctx.strokeStyle = 'rgba(80,180,255,0.3)';
            ctx.lineWidth = 1;
            for (const a of hoverStars) {
                let connections = 0;
                const cellX = Math.floor(a.x / CELL_SIZE);
                const cellY = Math.floor(a.y / CELL_SIZE);
                for (let dx = -1; dx <= 1 && connections < CONSTELLATION_MAX_CONNECTIONS; dx++) {
                    for (let dy = -1; dy <= 1 && connections < CONSTELLATION_MAX_CONNECTIONS; dy++) {
                        const bucket = grid.get((cellX + dx) + ',' + (cellY + dy));
                        if (!bucket) continue;
                        for (const b of bucket) {
                            if (b === a) continue;
                            const distSq = (a.x - b.x) ** 2 + (a.y - b.y) ** 2;
                            if (distSq < CONSTELLATION_THRESHOLD_SQ) {
                                ctx.beginPath();
                                ctx.moveTo(a.x, a.y);
                                ctx.lineTo(b.x, b.y);
                                ctx.stroke();
                                connections++;
                                if (connections >= CONSTELLATION_MAX_CONNECTIONS) break;
                            }
                        }
                    }
                }
            }

            // Shooting stars
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
                if (s.life <= 0 || s.x > canvas.width + 50 || s.y > canvas.height + 50) shootingStars.splice(i, 1);
            }
        }
        requestAnimationFrame(animate);
    </script>
</body>

</html>