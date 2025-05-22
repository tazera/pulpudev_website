<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Starry Particles – v6 Modular & Refactored</title>
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
        // == CANVAS SETUP ==
        const canvas = document.getElementById('background');
        const ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        // == CONFIG ==
        const CONFIG = {
            NUM_PARTICLES: 220,
            BIG_STAR_CHANCE: 0.25,
            MIN_SPEED: 0.25,
            MAX_SPEED: 2.5,
            PARALLAX_MIN: 0.2,
            PARALLAX_MAX: 1,
            SHOOT_INTERVAL_MIN: 8000,
            SHOOT_INTERVAL_MAX: 15000,
            CONST: {
                MAX_CONNECTIONS: 3,
                HOVER_RADIUS: 120,
                THRESHOLD_SQ: 4000
            }
        };
        CONFIG.CELL_SIZE = Math.sqrt(CONFIG.CONST.THRESHOLD_SQ);

        // == UTILS ==
        const randRange = (min, max) => Math.random() * (max - min) + min;
        const randVel = () => (Math.random() - 0.5) * 1.2;

        function distanceSq(a, b) {
            const dx = a.x - b.x,
                dy = a.y - b.y;
            return dx * dx + dy * dy;
        }

        // == STATE ==
        let particles = [];
        const shootingStars = [];
        let nextShootAt = performance.now() + randRange(CONFIG.SHOOT_INTERVAL_MIN, CONFIG.SHOOT_INTERVAL_MAX);

        // == INITIALIZATION ==
        function initParticles() {
            particles = [];
            for (let i = 0; i < CONFIG.NUM_PARTICLES; i++) {
                const isBig = Math.random() < CONFIG.BIG_STAR_CHANCE;
                particles.push({
                    x: randRange(0, canvas.width),
                    y: randRange(0, canvas.height),
                    dx: randVel(),
                    dy: randVel(),
                    r: isBig ? randRange(5, 10) : randRange(2.5, 5),
                    depth: randRange(CONFIG.PARALLAX_MIN, CONFIG.PARALLAX_MAX),
                    twinkleOffset: Math.random() * Math.PI * 2,
                    twinkleSpeed: randRange(1, 3),
                    isBig
                });
            }
        }
        initParticles();

        // == MOUSE ==
        const mouse = {
            x: -Infinity,
            y: -Infinity
        };
        window.addEventListener('mousemove', e => ({
            x: mouse.x,
            y: mouse.y
        } = {
            x: e.clientX,
            y: e.clientY
        }));
        window.addEventListener('mouseleave', () => ({
            x: mouse.x,
            y: mouse.y
        } = {
            x: -Infinity,
            y: -Infinity
        }));

        // == DRAW HELPERS ==
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

        // == PHYSICS ==
        function updateParticles(dt) {
            particles.forEach(p => {
                // repulsion
                const dxm = p.x - mouse.x,
                    dym = p.y - mouse.y;
                const distm = Math.hypot(dxm, dym);
                if (distm < CONFIG.CONST.HOVER_RADIUS) {
                    const strength = (CONFIG.CONST.HOVER_RADIUS - distm) / CONFIG.CONST.HOVER_RADIUS;
                    p.dx += dxm / distm * strength * 0.8;
                    p.dy += dym / distm * strength * 0.8;
                }
                // move + parallax
                p.x += p.dx * p.depth;
                p.y += p.dy * p.depth;
                // speed clamp
                const speed = Math.hypot(p.dx, p.dy);
                if (speed > CONFIG.MAX_SPEED) {
                    p.dx = p.dx / speed * CONFIG.MAX_SPEED;
                    p.dy = p.dy / speed * CONFIG.MAX_SPEED;
                } else if (speed < CONFIG.MIN_SPEED) {
                    p.dx = p.dx / speed * CONFIG.MIN_SPEED;
                    p.dy = p.dy / speed * CONFIG.MIN_SPEED;
                }
                // bounce
                if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
            });
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

        // == CONSTELLATION DRAWING ==
        function drawConstellations() {
            // spatial hash
            const hover = particles.filter(p => distanceSq(p, mouse) < CONFIG.CONST.HOVER_RADIUS ** 2);
            const grid = new Map();
            hover.forEach(p => {
                const gx = Math.floor(p.x / CONFIG.CELL_SIZE),
                    gy = Math.floor(p.y / CONFIG.CELL_SIZE);
                const key = gx + ',' + gy;
                if (!grid.has(key)) grid.set(key, []);
                grid.get(key).push(p);
            });
            ctx.strokeStyle = 'rgba(80,180,255,0.3)';
            ctx.lineWidth = 1;
            hover.forEach(a => {
                let c = 0;
                const gx = Math.floor(a.x / CONFIG.CELL_SIZE),
                    gy = Math.floor(a.y / CONFIG.CELL_SIZE);
                for (let ox = -1; ox <= 1 && c < CONFIG.CONST.MAX_CONNECTIONS; ox++) {
                    for (let oy = -1; oy <= 1 && c < CONFIG.CONST.MAX_CONNECTIONS; oy++) {
                        const cell = grid.get((gx + ox) + ',' + (gy + oy));
                        if (!cell) continue;
                        for (const b of cell) {
                            if (b === a) continue;
                            if (distanceSq(a, b) < CONFIG.CONST.THRESHOLD_SQ) {
                                ctx.beginPath();
                                ctx.moveTo(a.x, a.y);
                                ctx.lineTo(b.x, b.y);
                                ctx.stroke();
                                c++;
                                if (c >= CONFIG.CONST.MAX_CONNECTIONS) break;
                            }
                        }
                    }
                }
            });
        }

        function drawShootingStars(dt) {
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
                if (s.life <= 0 || s.x < -50 || s.x > canvas.width + 50 || s.y < -50 || s.y > canvas.height + 50)
                    shootingStars.splice(i, 1);
            }
        }

        // == MAIN LOOP ==
        let lastTime = performance.now();

        function animate(time) {
            const dt = time - lastTime;
            lastTime = time;
            requestAnimationFrame(animate);

            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = 'rgba(0,0,35,0.25)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // physics + spawn
            updateParticles(dt);
            if (time > nextShootAt) {
                spawnShootingStar();
                nextShootAt = time + randRange(CONFIG.SHOOT_INTERVAL_MIN, CONFIG.SHOOT_INTERVAL_MAX);
            }

            // draw
            ctx.filter = 'blur(1px)';
            ctx.fillStyle = 'rgb(50,160,255)';
            particles.forEach(p => {
                const base = 0.6 + 0.4 * Math.sin(time / 1000 * p.twinkleSpeed + p.twinkleOffset);
                ctx.globalAlpha = base * p.depth;
                drawStar(ctx, p.x, p.y, p.r);
            });
            ctx.globalAlpha = 1;
            ctx.filter = 'none';

            drawConstellations();
            drawShootingStars(dt);
        }
        requestAnimationFrame(animate);
    </script>
</body>

</html>