<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Starry Particles – fast v7</title>
    <style>
        html,
        body {
            margin: 0;
            height: 100%;
            overflow: hidden;
            background: #000023;
            color: #fff;
            font-family: system-ui, sans-serif
        }

        #background {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none
        }
    </style>
</head>

<body>
    <canvas id="background"></canvas>
    <script>
        /*
  Starfield rewritten for speed:
  – one flat O(N) loop per frame (no nested loops)
  – star graphics pre‑rendered to off‑screen canvas (Path2D drawn once)
  – no expensive ctx.filter/blur; glow via lighter compositing
  – wrap‑around edges (cheaper than bounce)
  – respects devicePixelRatio for crispness without large canvases
*/
        (() => {
            const cvs = document.getElementById('background');
            const ctx = cvs.getContext('2d');
            const DPR = window.devicePixelRatio || 1;

            function resize() {
                cvs.width = innerWidth * DPR;
                cvs.height = innerHeight * DPR;
                ctx.setTransform(DPR, 0, 0, DPR, 0, 0); // reset + scale
            }
            addEventListener('resize', resize, {
                passive: true
            });
            resize();

            // CONFIG
            const NUM = 200; // total stars
            const SPEED_MIN = 0.3;
            const SPEED_MAX = 1.8;
            const R_MIN = 2.5;
            const R_MAX = 5;

            // pre-render one glowing star
            const starCache = document.createElement('canvas');
            const sCtx = starCache.getContext('2d');
            starCache.width = starCache.height = R_MAX * 4;
            const PATH = new Path2D();
            (function buildStar(r = R_MAX, spikes = 5) {
                let rot = -Math.PI / 2;
                const step = Math.PI / spikes,
                    inner = r * 0.45;
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
            sCtx.fillStyle = "#32a0ff";
            sCtx.fill(PATH);

            const rand = (a, b) => Math.random() * (b - a) + a;
            const stars = Array.from({
                length: NUM
            }, () => ({
                x: rand(0, innerWidth),
                y: rand(0, innerHeight),
                dx: rand(-1, 1) * rand(SPEED_MIN, SPEED_MAX),
                dy: rand(-1, 1) * rand(SPEED_MIN, SPEED_MAX),
                r: rand(R_MIN, R_MAX),
                tw: rand(0, Math.PI * 2), // twinkle phase
                ts: rand(0.8, 2.5) // twinkle speed
            }));

            let last = performance.now();

            function frame(now) {
                const dt = now - last;
                last = now;
                ctx.clearRect(0, 0, innerWidth, innerHeight);
                ctx.globalCompositeOperation = 'lighter';

                for (let i = 0; i < NUM; i++) {
                    const s = stars[i];
                    // move (wrap edges)
                    s.x += s.dx * dt * 0.06;
                    s.y += s.dy * dt * 0.06;
                    if (s.x < -s.r) s.x = innerWidth + s.r;
                    else if (s.x > innerWidth + s.r) s.x = -s.r;
                    if (s.y < -s.r) s.y = innerHeight + s.r;
                    else if (s.y > innerHeight + s.r) s.y = -s.r;
                    // draw with twinkle
                    ctx.globalAlpha = 0.5 + 0.5 * Math.sin(now * 0.001 * s.ts + s.tw);
                    const sz = s.r * 4;
                    ctx.drawImage(starCache, s.x - sz / 2, s.y - sz / 2, sz, sz);
                }

                ctx.globalAlpha = 1;
                ctx.globalCompositeOperation = 'source-over';
                requestAnimationFrame(frame);
            }
            requestAnimationFrame(frame);
        })();
    </script>
</body>

</html>