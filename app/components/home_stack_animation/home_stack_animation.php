<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>3D Stack Test</title>
    <style>
    /* Updated 3D Stack Animation Styles v5 with detailed comments for rotation axes */
    :root {
        /* ==========================
     Tunable parameters
     ========================== */
        /* Card dimensions and perspective */
        --card-min-width: 380px;
        /* Minimum width of the card container */
        --card-max-width: 520px;
        /* Maximum width of the card container */
        --card-aspect-ratio: 16/9;
        /* Width-to-height ratio for cards */
        --perspective-strength: 1600px;
        /* Camera distance: higher = subtler depth */

        /* Animation timing */
        --pop-duration: 0.8s;
        --pop-ease: ease-out;

        /* ==========================
     Translation offsets (FINAL)
     Format: translate3d(x, y, z)
     x: horizontal movement (positive = right)
     y: vertical movement (positive = down)
     z: depth (positive = towards viewer)
     ========================== */
        --top-offset-x: 200px;
        --top-offset-y: -25px;
        --top-offset-z: 200px;
        --mid-offset-x: 60px;
        --mid-offset-y: 5px;
        --mid-offset-z: 120px;
        --bot-offset-x: -70px;
        --bot-offset-y: 30px;
        --bot-offset-z: 80px;

        /* ==========================
     Rotation angles (FINAL)
     rotateX: rotation around X-axis (horizontal axis through center)
       positive = tilt top edge away (card falls backward)
       negative = tilt top edge towards (card leans forward)
     rotateY: rotation around Y-axis (vertical axis through center)
       positive = tilt right edge away (card leans left)
       negative = tilt right edge towards (card leans right)
     ========================== */
        --rotateX-top: 15deg;
        --rotateY-top: 0deg;
        --rotateX-mid: 15deg;
        --rotateY-mid: 0deg;
        --rotateX-bot: 15deg;
        --rotateY-bot: 0deg;

        /* ==========================
     Scale factors (FINAL)
     scale >1 = larger, <1 = smaller
     ========================== */
        --scale-top: 1.25;
        --scale-mid: 1.1;
        --scale-bot: 1;
    }

    .stack-hero {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 60vh;
        overflow-x: hidden;
        overflow-y: visible;
    }

    .stack-wrapper {
        position: relative;
        width: clamp(var(--card-min-width), 85vw, var(--card-max-width));
        aspect-ratio: var(--card-aspect-ratio);
        perspective: var(--perspective-strength);
        transform-style: preserve-3d;
        overflow: visible;
    }

    .stack-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 24px 36px rgba(0, 0, 0, 0.25);
        opacity: 0;
        will-change: transform, opacity;
        animation-fill-mode: forwards;
        /* Center pivot for rotations */
        transform-origin: center center;
    }

    .img-top {
        z-index: 3;
        animation: popTop var(--pop-duration) var(--pop-ease) 0.1s both;
    }

    .img-mid {
        z-index: 2;
        animation: popMid var(--pop-duration) var(--pop-ease) 0.25s both;
    }

    .img-bottom {
        z-index: 1;
        animation: popBot var(--pop-duration) var(--pop-ease) 0.4s both;
    }

    /* Keyframes: initial (0%) uses exaggerated offsets & rotations; 100% uses tuned variables */
    @keyframes popTop {
        0% {
            opacity: 0;
            /* Start further down, deeper, and more tilted */
            transform: translate3d(0, calc(var(--top-offset-y) + 225px), calc(var(--top-offset-z) - 50px)) rotateX(calc(var(--rotateX-top) + 3deg)) rotateY(calc(var(--rotateY-top) + 2deg)) scale(0.8);
        }

        60% {
            opacity: 1;
        }

        100% {
            /* Final position/rotation/scale uses variables */
            opacity: 1;
            transform: translate3d(var(--top-offset-x), var(--top-offset-y), var(--top-offset-z)) rotateX(var(--rotateX-top)) rotateY(var(--rotateY-top)) scale(var(--scale-top));
        }
    }

    @keyframes popMid {
        0% {
            opacity: 0;
            transform: translate3d(0, calc(var(--mid-offset-y) + 235px), calc(var(--mid-offset-z) - 60px)) rotateX(calc(var(--rotateX-mid) + 4deg)) rotateY(calc(var(--rotateY-mid) + 2deg)) scale(0.9);
        }

        60% {
            opacity: 1;
        }

        100% {
            opacity: 1;
            transform: translate3d(var(--mid-offset-x), var(--mid-offset-y), var(--mid-offset-z)) rotateX(var(--rotateX-mid)) rotateY(var(--rotateY-mid)) scale(var(--scale-mid));
        }
    }

    @keyframes popBot {
        0% {
            opacity: 0;
            transform: translate3d(0, calc(var(--bot-offset-y) + 255px), calc(var(--bot-offset-z) - 70px)) rotateX(calc(var(--rotateX-bot) + 4deg)) rotateY(calc(var(--rotateY-bot) + 2deg)) scale(0.95);
        }

        60% {
            opacity: 1;
        }

        100% {
            opacity: 1;
            transform: translate3d(var(--bot-offset-x), var(--bot-offset-y), var(--bot-offset-z)) rotateX(var(--rotateX-bot)) rotateY(var(--rotateY-bot)) scale(var(--scale-bot));
        }
    }

    /* Responsive adjustments for small viewports */
    @media (max-width: 480px) {
        :root {
            --card-min-width: 260px;
            --card-max-width: 360px;
            --perspective-strength: 1000px;
            /* Reduce spacing & depth */
            --top-offset-x: 100px;
            --top-offset-z: 120px;
            --mid-offset-x: 30px;
            --mid-offset-z: 80px;
            --bot-offset-x: -30px;
            --bot-offset-z: 40px;
            /* Adjust scales for smaller screens */
            --scale-top: 1.1;
            --scale-mid: 1;
            --scale-bot: 0.95;
        }
    }
    </style>


</head>

<body>

    <section class="stack-hero" id="stackHero">
        <div class="stack-wrapper">
            <!-- replace these with your real images -->
            <img src="/images/home/image1.png" class="stack-img img-top" alt="Top">
            <img src="/images/home/image2.png" class="stack-img img-mid" alt="Middle">
            <img src="/images/home/image3.webp" class="stack-img img-bottom" alt="Bottom">
        </div>
    </section>

    <script>
    // IntersectionObserver to play once in view
    window.addEventListener('DOMContentLoaded', () => {
        const hero = document.getElementById('stackHero');
        const frames = hero.querySelectorAll('.stack-img');
        frames.forEach(f => f.style.animationPlayState = 'paused');

        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    frames.forEach(f => f.style.animationPlayState = 'running');
                    io.disconnect();
                }
            });
        }, {
            threshold: 0.3
        });

        io.observe(hero);
    });
    </script>

</body>

</html>