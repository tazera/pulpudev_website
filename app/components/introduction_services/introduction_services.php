<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Project Management Section</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #0E0E10;
            color: #F7F8F8;
            font-family: 'Inter', sans-serif;
        }

        .section-padding {
            padding: 100px 0;
        }

        .card {
            background-color: #1A1A1A;
            border: none;
            border-radius: 12px;
            color: #F7F8F8;
        }

        .card-img-right {
            width: 260px;
            height: 260px;
            object-fit: contain;
            border-radius: 12px;
            margin-left: 2.5rem;
            background: #232323;
            padding: 18px;
        }

        .top-card-title {
            font-size: 2rem;
            font-weight: 700;
        }

        .top-card-text {
            font-size: 1.05rem;
        }

        .top-card {
            padding: 64px 48px;
            min-height: 420px;
        }

        .bottom-card-title {
            font-size: 1.8rem;
            font-weight: 700;
        }

        /* Make the description text smaller */
        #content-description.bottom-card-text {
            font-size: 1.05rem;
        }

        .bottom-card-text {
            font-size: 1.35rem;
        }

        .bottom-card-image img {
            max-width: 100%;
            border-radius: 12px;
            height: auto;
            width: auto;
        }

        .bottom-card-content {
            display: flex;
            align-items: flex-start;
            margin-left: 40px;
            padding-top: 10px;
            /* Adjusted to align to the top */
        }

        /* Enhanced responsiveness for bottom card image */
        @media (max-width: 991px) {
            .bottom-card-image {
                margin-top: 30px;
                text-align: center;
                /* Center image on smaller screens */
            }

            .bottom-card-image img {
                max-width: 90%;
                /* Prevent image from touching edges */
                margin: 0 auto;
                /* Center the image */
            }
        }

        /* Additional optimization for very small screens */
        @media (max-width: 576px) {
            .bottom-card-image img {
                max-width: 100%;
                /* Use full width on very small screens */
            }

            .top-card {
                padding: 30px 20px;
                /* Reduce padding on small screens */
                min-height: auto;
                /* Allow height to adjust to content */
            }

            /* Responsive adjustments for projects section */
            .projects-section {
                padding: 3rem 0;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .section-subtitle {
                font-size: 1rem;
            }

            .top-card-title {
                font-size: 1.6rem;
                /* Smaller font on mobile */
            }

            .bottom-card-title {
                font-size: 1.8rem;
                /* Smaller font on mobile */
            }

            .bottom-card-text {
                font-size: 1.1rem;
                /* Smaller font on mobile */
            }
        }

        .rotary-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-right: 32px;
            width: max-content;
        }

        .rotary-btn-row {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            white-space: nowrap;
        }

        /* Remove underline on hover and set default gray for inactive rows */
        .rotary-btn-label-link {
            text-decoration: none;
            color: #B0B0B0;
        }

        .rotary-btn-label-link:hover {
            text-decoration: none;
            /* no underline on hover */
        }

        .rotary-btn-row .vertical-line {
            display: inline-block;
            width: 3px;
            height: 20px;
            background: #3a3a3a;
            margin-right: 6px;
            vertical-align: middle;
        }

        /* Active row: filled line & white text */
        .rotary-btn-row.selected .vertical-line {
            background: #6EC6F6;
        }

        .rotary-btn-row.selected .rotary-btn-label-link {
            color: #FFF;
        }

        /* Projects Section Styling */
        .projects-section {
            padding: 6rem 0;
            background-color: transparent;
            color: var(--bs-light);
            position: relative;
            z-index: 1;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #b0b0b0;
            margin-bottom: 3rem;
            font-weight: 400;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .project-cta-btn {
            background: linear-gradient(90deg, rgba(255, 136, 0, 0.1) 0%, rgba(211, 61, 16, 0.1) 100%);
            border: 1px solid rgba(255, 136, 0, 0.3);
            transition: all 0.3s ease;
        }

        .project-cta-btn:hover {
            background: linear-gradient(90deg, rgba(255, 136, 0, 0.2) 0%, rgba(211, 61, 16, 0.2) 100%);
            border: 1px solid rgba(255, 136, 0, 0.5);
            transform: translateY(-2px);
        }

        @media (max-width: 991px) {
            .bottom-card-content {
                margin-left: 0;
                flex-direction: column;
                align-items: flex-start;
            }

            .rotary-buttons-wrapper {
                flex-direction: row;
                align-items: flex-start;
                width: 100%;
                /* Ensure full width */
            }

            .rotary-buttons-separator {
                height: 80px;
                margin-left: 12px;
                margin-right: 0;
            }

            .rotary-buttons {
                flex-direction: column;
                margin-bottom: 16px;
                margin-right: 0;
                width: 100%;
                /* Use full width on mobile */
            }

            #rotary-content {
                margin-top: 20px;
                /* Add space between buttons and content */
            }

            .rotary-btn-row {
                flex-direction: row;
                align-items: center;
                gap: 8px;
            }
        }
    </style>
</head>

<body>

    <section class="section-padding" id="services-button-go-to">

        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title" id="services"><?php echo $_SESSION['phrases']['services-title'] ?></h2>
                <p class="section-subtitle mx-auto"><?php echo $_SESSION['phrases']['services-subtitle'] ?></p>
            </div>
        </div>
        <div class="container">
            <!-- Top two cards -->
            <div class="row g-4 mb-4 align-items-stretch">
                <div class="col-12 col-lg-6 d-flex">
                    <div class="card flex-row align-items-center top-card w-100">
                        <div class="flex-grow-1">
                            <h3 id="manage-projects-end-to-end" class="top-card-title mb-3"><?php echo $_SESSION['phrases']['services-box-title1'] ?>
                            </h3>
                            <p class="mb-0 top-card-text"><?php echo $_SESSION['phrases']['services-box-text1'] ?></p>
                        </div>
                        <img src="/images/screenshot.png" alt="Specs" width="400" height="220" class="card-img-right d-none d-md-block" />
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex">
                    <div class="card flex-row align-items-center top-card w-100">
                        <div class="flex-grow-1">
                            <h3 class="top-card-title mb-3"><?php echo $_SESSION['phrases']['services-box-title2'] ?></h3>
                            <p class="mb-0 top-card-text"><?php echo $_SESSION['phrases']['services-box-text2'] ?></p>
                        </div>
                        <img src="/images/screenshot.png" alt="Updates" width="400" height="220" class="card-img-right d-none d-md-block" />
                    </div>
                </div>
            </div>
            <!-- Bottom wide card -->
            <div class="row g-0 align-items-center card p-4 flex-row">
                <div class="col-md-6 order-1 order-md-1">
                    <div class="bottom-card-content">
                        <div class="rotary-buttons-wrapper">
                            <!-- needs to take out the css not to be inline fix for now -->
                            <h2 style="margin-bottom: 15px; font-size: 1.8rem; font-weight: 700; color: #F7F8F8; "><?php echo $_SESSION['phrases']['h2-services'] ?></h2>
                            <div class="rotary-buttons">
                                <div class="rotary-btn-row" data-title="<?php echo $_SESSION['phrases']['services-website-building-h2'] ?>" data-description="<?php echo $_SESSION['phrases']['services-website-building-p'] ?>">
                                    <a href="#" class="rotary-btn-label-link" aria-label="Collaborative documents">
                                        <span class="rotary-btn"><span class="vertical-line"></span></span>
                                        <?php echo $_SESSION['phrases']['services1'] ?>
                                    </a>
                                </div>
                                <div class="rotary-btn-row" data-title="<?php echo $_SESSION['phrases']['services-b2b-h2'] ?>" data-description="<?php echo $_SESSION['phrases']['services-b2b-text'] ?>">
                                    <a href="#" class="rotary-btn-label-link" aria-label="Inline comments">
                                        <span class="rotary-btn"><span class="vertical-line"></span></span>
                                        <?php echo $_SESSION['phrases']['services2'] ?>
                                    </a>
                                </div>
                                <div class="rotary-btn-row" data-title="<?php echo $_SESSION['phrases']['services-hardware-h2'] ?>" data-description="<?php echo $_SESSION['phrases']['services-hardware-text'] ?>">
                                    <a href="#" class="rotary-btn-label-link" aria-label="Text-to-issue commands">
                                        <span class="rotary-btn"><span class="vertical-line"></span></span>
                                        <?php echo $_SESSION['phrases']['services3'] ?>
                                    </a>
                                </div>
                            </div>
                            <div class="rotary-buttons-separator"></div>
                        </div>
                        <!-- The template that is populated with data-title and data-description from above need refactor in the future -->
                        <div id="rotary-content" style="margin-top: -5px;">
                            <h3 id="content-title" class="bottom-card-title mb-3"></h3>
                            <p id="content-description" class="bottom-card-text">

                            </p>
                            <a href="https://linear.app/" target="_blank" rel="noopener noreferrer"
                                style="color:#6EC6F6;">

                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bottom-card-image text-end order-2 order-md-2">
                    <img id="content-image" src="/images/screenshot.png" alt="Project Overview Screenshot" width="400" height="220" data-default-src="/images/screenshot.png" data-collaborative-src="/images/home/image1.png" data-comments-src="/images/home/image2.png" data-commands-src="/images/home/image3.webp" />
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.rotary-btn-row');
            const contentTitle = document.getElementById('content-title');
            const contentDescription = document.getElementById('content-description');
            const contentImage = document.getElementById('content-image');

            // Set initial content to the first button (Collaborative documents)
            const firstRow = rows[0];
            const firstTitle = firstRow.getAttribute('data-title');
            const firstDescription = firstRow.getAttribute('data-description');
            contentTitle.textContent = firstTitle;
            contentDescription.textContent = firstDescription;
            contentImage.src = contentImage.getAttribute('data-collaborative-src');

            // Store default content for reset functionality
            const defaultContent = {
                title: firstTitle,
                description: firstDescription,
                image: contentImage.getAttribute('data-collaborative-src')
            };

            // Set first row as active on load
            rows[0].classList.add('selected');

            rows.forEach((row, index) => {
                row.addEventListener('click', (e) => {
                    e.preventDefault();

                    // Remove selected class from all rows
                    rows.forEach(r => r.classList.remove('selected'));

                    // Add selected class to clicked row
                    row.classList.add('selected');

                    // Get content from data attributes
                    const title = row.getAttribute('data-title');
                    const description = row.getAttribute('data-description');

                    // Change content based on which button was clicked
                    if (index === 0) { // Collaborative documents
                        contentImage.src = contentImage.getAttribute('data-collaborative-src');
                        contentTitle.textContent = title;
                        contentDescription.textContent = description;
                    } else if (index === 1) { // Inline comments
                        contentImage.src = contentImage.getAttribute('data-comments-src');
                        contentTitle.textContent = title;
                        contentDescription.textContent = description;
                    } else if (index === 2) { // Text-to-issue commands
                        contentImage.src = contentImage.getAttribute('data-commands-src');
                        contentTitle.textContent = title;
                        contentDescription.textContent = description;
                    } else {
                        // Reset to default if somehow another button is clicked
                        contentImage.src = defaultContent.image;
                        contentTitle.textContent = defaultContent.title;
                        contentDescription.textContent = defaultContent.description;
                    }
                });
            });
        });
    </script>


</body>

</html>