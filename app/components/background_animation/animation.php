<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Starry Particles – interactive v11</title>
    <style>
        html,
        body {
            margin: 0;
            min-height: 100%;
            background: #000023;
            color: #fff;
            font-family: system-ui, sans-serif
        }

        #background {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            display: block
        }
    </style>
</head>

<body>
    <canvas id="background"></canvas>
    <div id="content-wrapper" style="position:relative;z-index:10;"></div>

    <script>
        /*
      Starfield – interactive edition (v11)
      • Keeps the original base speed (0.3 – 1.5) at all times.
      • Pointer steers stars away (or toward — set SIGN) without changing their speed.
      • No friction / drift → same velocity magnitude before & after interaction.
    */
        (() => {
            const cvs = document.getElementById('background');
            const ctx = cvs.getContext('2d');
            const DPR = window.devicePixelRatio || 1;

            const SIGN = -1; // -1 = repel (flee);  +1 = attract (follow) – flip if you prefer

            /* ---------- resize ---------- */
            function resize() {
                cvs.width = innerWidth * DPR;
                cvs.height = innerHeight * DPR;
                cvs.style.width = innerWidth + 'px';
                cvs.style.height = innerHeight + 'px';
                ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
            }
            addEventListener('resize', resize, {
                passive: true
            });
            resize();

            /* ---------- config ---------- */
            const BASE_NUM = 200;
            const isMobile = matchMedia('(pointer: coarse)').matches || innerWidth < 768;
            const NUM = isMobile ? BASE_NUM / 2 : BASE_NUM;
            const SPEED_MIN = .3,
                SPEED_MAX = 1.5; // ← original speeds
            const R_MIN = 2.5,
                R_MAX = 5;
            const LINK_DIST = isMobile ? 70 : 90;
            const POINTER_DIST = 120; // steering radius
            const POINTER_STEER = .06; // steering factor per frame

            /* ---------- sprite ---------- */
            const starCache = document.createElement('canvas');
            const sCtx = starCache.getContext('2d');
            starCache.width = starCache.height = R_MAX * 4;
            const PATH = new Path2D();
            (function buildStar(r = R_MAX, spikes = 5) {
                let rot = -Math.PI / 2;
                const step = Math.PI / spikes,
                    inner = r * .45;
                PATH.moveTo(r, 0);
                for (let i = 0; i < spikes; i++) {
                    PATH.lineTo(r * Math.cos(rot), r * Math.sin(rot));
                    rot += step;
                    PATH.lineTo(inner * Math.cos(rot), inner * Math.sin(rot));
                    rot += step;
                }
                PATH.closePath();
            })();
            sCtx.translate(starCache.width / 2, starCache.height / 2);
            sCtx.fillStyle = '#32a0ff';
            sCtx.fill(PATH);

            /* ---------- helpers ---------- */
            const rand = (a, b) => Math.random() * (b - a) + a;

            function createStar() {
                return {
                    x: rand(0, innerWidth),
                    y: rand(0, innerHeight),
                    dx: rand(-1, 1) * rand(SPEED_MIN, SPEED_MAX),
                    dy: rand(-1, 1) * rand(SPEED_MIN, SPEED_MAX),
                    r: rand(R_MIN, R_MAX),
                    tw: rand(0, Math.PI * 2),
                    ts: rand(.8, 2.5)
                };
            }
            const stars = Array.from({
                length: NUM
            }, createStar);

            function resetStar(s, w, h) {
                s.x = rand(0, w);
                s.y = rand(0, h);
                s.dx = rand(-1, 1) * rand(SPEED_MIN, SPEED_MAX);
                s.dy = rand(-1, 1) * rand(SPEED_MIN, SPEED_MAX);
            }

            /* ---------- pointer ---------- */
            let pointerX = null,
                pointerY = null,
                pointerActive = false;

            function setPointer(e) {
                const p = e.touches ? e.touches[0] : e;
                pointerX = p.clientX;
                pointerY = p.clientY;
                pointerActive = true;
            }
            const clearPointer = () => pointerActive = false;
            addEventListener('mousemove', setPointer, {
                passive: true
            });
            addEventListener('touchmove', setPointer, {
                passive: true
            });
            addEventListener('mouseleave', clearPointer);
            addEventListener('touchend', clearPointer);

            /* ---------- visibility reset ---------- */
            let last = performance.now();
            document.addEventListener('visibilitychange', () => {
                if (document.visibilityState === 'visible') {
                    for (const s of stars) resetStar(s, innerWidth, innerHeight);
                    last = performance.now();
                }
            });

            /* ---------- animation loop ---------- */
            function frame(now) {
                const dt = now - last;
                last = now;
                const w = innerWidth,
                    h = innerHeight;

                ctx.clearRect(0, 0, w, h);
                ctx.globalCompositeOperation = 'lighter';

                for (const s of stars) {
                    /* steer while pointer active */
                    if (pointerActive) {
                        const vx = s.x - pointerX,
                            vy = s.y - pointerY;
                        const dist2 = vx * vx + vy * vy;
                        if (dist2 < POINTER_DIST * POINTER_DIST && dist2 > 1) {
                            const dist = Math.sqrt(dist2);
                            const steerMag = (1 - dist / POINTER_DIST) * POINTER_STEER * SIGN; // stronger near pointer
                            // apply steering perpendicular to radius (repel/attract)
                            s.dx += (vx / dist) * steerMag;
                            s.dy += (vy / dist) * steerMag;
                        }
                    }

                    /* preserve original speed magnitude */
                    const speed = Math.hypot(s.dx, s.dy) || 0.0001;
                    const targetSpeed = Math.min(Math.max(speed, SPEED_MIN), SPEED_MAX);
                    // Renormalise to targetSpeed
                    s.dx = s.dx / speed * targetSpeed;
                    s.dy = s.dy / speed * targetSpeed;

                    /* move & wrap */
                    s.x += s.dx * dt * .06;
                    s.y += s.dy * dt * .06;
                    if (s.x < -s.r) s.x = w + s.r;
                    else if (s.x > w + s.r) s.x = -s.r;
                    if (s.y < -s.r) s.y = h + s.r;
                    else if (s.y > h + s.r) s.y = -s.r;

                    /* draw */
                    ctx.globalAlpha = .5 + .5 * Math.sin(now * .001 * s.ts + s.tw);
                    const sz = s.r * 4;
                    ctx.drawImage(starCache, s.x - sz / 2, s.y - sz / 2, sz, sz);
                }

                ctx.globalAlpha = 1;

                /* constellations */
                ctx.beginPath();
                const maxLines = 120;
                let lineCount = 0;
                for (let i = 0; i < NUM - 1 && lineCount < maxLines; i++) {
                    const si = stars[i];
                    for (let j = i + 1; j < NUM && lineCount < maxLines; j++) {
                        const sj = stars[j];
                        const dx = si.x - sj.x,
                            dy = si.y - sj.y;
                        const dist2 = dx * dx + dy * dy;
                        if (dist2 < LINK_DIST * LINK_DIST) {
                            ctx.moveTo(si.x, si.y);
                            ctx.lineTo(sj.x, sj.y);
                            lineCount++;
                        }
                    }
                }
                ctx.strokeStyle = 'rgba(50,160,255,0.22)';
                ctx.lineWidth = .5;
                ctx.stroke();

                ctx.globalCompositeOperation = 'source-over';
                requestAnimationFrame(frame);
            }
            requestAnimationFrame(frame);
        })();
    </script>
</body>

</html>