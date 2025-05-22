<?php /* components/background_animation/starry_background.php  */ ?>
<canvas id="background"></canvas>

<style>
    html,
    body {
        margin: 0;
        min-height: 100%;
        background: #000023;
        color: #fff;
        font-family: system-ui, sans-serif;
        overflow-x: hidden
    }

    #background {
        position: fixed;
        inset: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .btn,
    [data-z-top] {
        position: relative;
        z-index: 1
    }

    /* keep buttons above canvas */
</style>

<script>
    (() => {

        /* ---------- helpers & constants ---------- */
        const cvs = document.getElementById('background'),
            ctx = cvs.getContext('2d'),
            DPR = window.devicePixelRatio || 1,
            COUNT = 200,
            VMIN = .3,
            VMAX = 1.8,
            RMIN = 2.5,
            RMAX = 5,
            stars = [],
            rand = (a, b) => Math.random() * (b - a) + a;

        /* ---------- build one star sprite ---------- */
        const sprite = document.createElement('canvas'),
            spx = sprite.getContext('2d');
        sprite.width = sprite.height = RMAX * 4;
        const path = new Path2D();
        (function build(r = RMAX, spikes = 5) {
            let rot = -Math.PI / 2,
                step = Math.PI / spikes,
                inner = r * 0.45;
            path.moveTo(r, 0);
            for (let i = 0; i < spikes; i++) {
                path.lineTo(r * Math.cos(rot), r * Math.sin(rot));
                rot += step;
                path.lineTo(inner * Math.cos(rot), inner * Math.sin(rot));
                rot += step;
            }
            path.closePath();
        })();
        spx.translate(sprite.width / 2, sprite.height / 2);
        spx.fillStyle = '#32a0ff';
        spx.fill(path);

        /* ---------- (re)size canvas & spawn stars ---------- */
        function spawnStar(w, h) {
            return {
                x: rand(0, w),
                y: rand(0, h),
                dx: rand(-1, 1) * rand(VMIN, VMAX),
                dy: rand(-1, 1) * rand(VMIN, VMAX),
                r: rand(RMIN, RMAX),
                tw: rand(0, Math.PI * 2), // twinkle phase
                ts: rand(0.8, 2.5) // twinkle speed
            };
        }

        function resize() {
            const w = innerWidth,
                h = innerHeight;
            cvs.width = w * DPR;
            cvs.height = h * DPR;
            ctx.setTransform(DPR, 0, 0, DPR, 0, 0);

            /* first resize → create the whole field */
            if (!stars.length) {
                for (let i = 0; i < COUNT; i++) stars.push(spawnStar(w, h));
            }
            /* later resizes → move any stragglers back inside */
            else {
                for (const s of stars) {
                    if (s.x > w) s.x = rand(0, w);
                    if (s.y > h) s.y = rand(0, h);
                }
            }
        }
        addEventListener('resize', resize, {
            passive: true
        });
        resize(); // run once on load

        /* ---------- render loop ---------- */
        let last = performance.now();

        function loop(now) {
            const dt = now - last;
            last = now;
            const w = cvs.width / DPR,
                h = cvs.height / DPR;

            ctx.clearRect(0, 0, w, h);
            ctx.globalCompositeOperation = 'lighter';

            for (const s of stars) {
                /* move + screen-wrap */
                s.x += s.dx * dt * 0.06;
                s.y += s.dy * dt * 0.06;
                if (s.x < -s.r) s.x = w + s.r;
                else if (s.x > w + s.r) s.x = -s.r;
                if (s.y < -s.r) s.y = h + s.r;
                else if (s.y > h + s.r) s.y = -s.r;

                /* twinkle & draw */
                ctx.globalAlpha = 0.5 + 0.5 * Math.sin(now * 0.001 * s.ts + s.tw);
                const sz = s.r * 4;
                ctx.drawImage(sprite, s.x - sz / 2, s.y - sz / 2, sz, sz);
            }

            ctx.globalAlpha = 1;
            ctx.globalCompositeOperation = 'source-over';
            requestAnimationFrame(loop);
        }
        requestAnimationFrame(loop);

    })();
</script>