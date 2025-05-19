<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Carousel View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }

        .carousel-container {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 900px;
            margin: 0 auto;
        }

        .arrow {
            background: none;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            padding: 0 10px;
        }

        .carousel {
            display: flex;
            width: 100%;
        }

        .proj2-card {
            flex: 1;
            box-sizing: border-box;
            padding: 10px;
            cursor: pointer;
            text-align: center;
            transition: opacity 0.3s;
        }

        .proj2-card img {
            max-width: 100%;
            border-radius: 4px;
        }

        .proj2-card h3 {
            margin: 10px 0 5px;
            font-size: 1.1rem;
        }

        .proj2-card p {
            font-size: 0.9rem;
            color: #555;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: #fff;
            width: 80%;
            max-width: 1000px;
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .modal-body {
            display: flex;
            height: 500px;
        }

        .project-details {
            width: 40%;
            padding: 20px;
            overflow-y: auto;
        }

        .media-list {
            width: 60%;
            padding: 10px;
            overflow-y: auto;
            border-left: 1px solid #ddd;
        }

        .media-list img,
        .media-list video {
            width: 100%;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .close {
            align-self: flex-end;
            padding: 10px;
            font-size: 1.5rem;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="carousel-container">
        <button class="arrow left">&#8249;</button>
        <div class="carousel">
            <div class="proj2-card" data-pos="0"></div>
            <div class="proj2-card" data-pos="1"></div>
            <div class="proj2-card" data-pos="2"></div>
        </div>
        <button class="arrow right">&#8250;</button>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-body">
                <div class="project-details"></div>
                <div class="media-list"></div>
            </div>
        </div>
    </div>

    <script>
        // Static project data array
        const projects = [{
                title: 'Project Title 1',
                desc: 'Short description of project 1.',
                placeholder: 'image3.webp',
                media: ['image3.webp', 'project1-b.jpg']
            },
            {
                title: 'Project Title 2',
                desc: 'Short description of project 2.',
                placeholder: 'project2.jpg',
                media: ['project2-a.jpg', 'project2-b.mp4']
            },
            {
                title: 'Project Title 3',
                desc: 'Short description of project 3.',
                placeholder: 'project3.jpg',
                media: ['project3-a.jpg', 'project3-b.jpg']
            },
            {
                title: 'Project Title 4',
                desc: 'Short description of project 4.',
                placeholder: 'project4.jpg',
                media: ['project4-a.jpg', 'project4-b.jpg']
            } // add as many as needed
        ];
        let currentIndex = 0;

        const cardElems = document.querySelectorAll('.proj2-card');
        const leftBtn = document.querySelector('.arrow.left');
        const rightBtn = document.querySelector('.arrow.right');
        const modal = document.getElementById('modal');
        const detailsEl = modal.querySelector('.project-details');
        const mediaList = modal.querySelector('.media-list');
        const closeBtn = modal.querySelector('.close');

        function renderCarousel() {
            // show three cards starting at currentIndex
            for (let i = 0; i < 3; i++) {
                const proj = projects[(currentIndex + i) % projects.length];
                const card = cardElems[i];
                card.dataset.index = (currentIndex + i) % projects.length;
                card.innerHTML = `<img src="${proj.placeholder}" alt="${proj.title}"><h3>${proj.title}</h3><p>${proj.desc}</p>`;
            }
        }

        rightBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % projects.length;
            renderCarousel();
        });
        leftBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + projects.length) % projects.length;
            renderCarousel();
        });

        // Initial render
        renderCarousel();

        // Card click to open modal
        cardElems.forEach(card => {
            card.addEventListener('click', () => {
                const idx = parseInt(card.dataset.index, 10);
                const proj = projects[idx];
                detailsEl.innerHTML = `<h2>${proj.title}</h2><p>${proj.desc}</p>`;
                mediaList.innerHTML = '';
                proj.media.forEach(src => {
                    let el;
                    if (src.endsWith('.mp4')) {
                        el = document.createElement('video');
                        el.src = src;
                        el.controls = true;
                    } else {
                        el = document.createElement('img');
                        el.src = src;
                    }
                    mediaList.appendChild(el);
                });
                modal.style.display = 'flex';
            });
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
        modal.addEventListener('click', e => {
            if (e.target === modal) modal.style.display = 'none';
        });
    </script>
</body>

</html>