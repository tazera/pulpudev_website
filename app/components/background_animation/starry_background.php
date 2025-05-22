<?php /* Starry background – keep it behind everything */ ?>
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
        /* <— changed back to −1 so stars stay behind */
    }

    /* optional: guarantee interactive elements are above */
    .btn,
    [data-z-top] {
        position: relative;
        z-index: 1
    }
</style>
<script>
    (() => {
        const cvs = document.getElementById('background');
        const ctx = cvs.getContext('2d');
        const DPR = window.devicePixelRatio || 1;

        function resize() {
            cvs.width = innerWidth * DPR;
            cvs.height = innerHeight * DPR;
            ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
        }
        addEventListener('resize', resize, {
            passive: true
        });
        resize();

        const N = 200,
            VMIN = 0.3,
            VMAX = 1.8,
            RMIN = 2.5,
            RMAX = 5;
        const sprite = document.createElement('canvas');
        const spx = sprite.getContext('2d');
        sprite.width = sprite.height = RMAX * 4;
        const starPath = new Path2D();
        (function build(r = RMAX, s = 5) {
            let rot = -Math.PI / 2,
                step = Math.PI / s,
                inner = r * 0.45;
            starPath.moveTo(r, 0);
            for (let i = 0; i < s; i++) {
                starPath.lineTo(r * Math.cos(rot), r * Math.sin(rot));
                rot += step;
                starPath.lineTo(inner * Math.cos(rot), inner * Math.sin(rot));
                rot += step;
            }
            starPath.closePath();
        })();
        spx.translate(sprite.width / 2, sprite.height / 2);
        spx.fillStyle = "#32a0ff";
        spx.fill(starPath);

        const rnd = (a, b) => Math.random() * (b - a) + a;
        const stars = Array.from({
            length: N
        }, () => ({
            x: rnd(0, innerWidth),
            y: rnd(0, innerHeight),
            dx: rnd(-1, 1) * rnd(VMIN, VMAX),
            dy: rnd(-1, 1) * rnd(VMIN, VMAX),
            r: rnd(RMIN, RMAX),
            tw: rnd(0, Math.PI * 2),
            ts: rnd(0.8, 2.5)
        }));
        let prev = performance.now();

        function loop(now) {
            const dt = now - prev;
            prev = now;
            ctx.clearRect(0, 0, innerWidth, innerHeight);
            ctx.globalCompositeOperation = 'lighter';
            for (let s of stars) {
                s.x += s.dx * dt * 0.06;
                s.y += s.dy * dt * 0.06;
                if (s.x < -s.r) s.x = innerWidth + s.r;
                else if (s.x > innerWidth + s.r) s.x = -s.r;
                if (s.y < -s.r) s.y = innerHeight + s.r;
                else if (s.y > innerHeight + s.r) s.y = -s.r;
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