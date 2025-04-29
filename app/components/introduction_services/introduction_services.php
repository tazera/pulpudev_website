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
        font-size: 2.2rem;
        font-weight: 700;
    }

    .bottom-card-text {
        font-size: 1.35rem;
    }

    .bottom-card-image img {
        max-width: 100%;
        border-radius: 12px;
    }

    .bottom-card-content {
        display: flex;
        align-items: center;
        margin-left: 40px;
        /* Move text closer to image */
    }

    .rotary-buttons {
        display: flex;
        flex-direction: column;
        gap: 18px;
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

    @media (max-width: 991px) {
        .bottom-card-content {
            margin-left: 0;
            flex-direction: column;
            align-items: flex-start;
        }

        .rotary-buttons-wrapper {
            flex-direction: row;
            align-items: flex-start;
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
    <section class="section-padding">
        <div class="container">
            <!-- Top two cards -->
            <div class="row g-4 mb-4 align-items-stretch">
                <div class="col-12 col-lg-6 d-flex">
                    <div class="card flex-row align-items-center top-card w-100">
                        <div class="flex-grow-1">
                            <h3 class="top-card-title mb-3">Manage projects end-to-end</h3>
                            <p class="mb-0 top-card-text">Consolidate specs, milestones, tasks, and other documentation
                                in one centralized location.</p>
                        </div>
                        <img src="/images/screenshot.png" alt="Specs" class="card-img-right d-none d-md-block" />
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex">
                    <div class="card flex-row align-items-center top-card w-100">
                        <div class="flex-grow-1">
                            <h3 class="top-card-title mb-3">Project updates</h3>
                            <p class="mb-0 top-card-text">Communicate progress and project health with built-in project
                                updates.</p>
                        </div>
                        <img src="/images/screenshot.png" alt="Updates" class="card-img-right d-none d-md-block" />
                    </div>
                </div>
            </div>
            <!-- Bottom wide card -->
            <div class="row g-0 align-items-center card p-4 flex-row">
                <div class="col-md-6 order-1 order-md-1">
                    <div class="bottom-card-content">
                        <div class="rotary-buttons-wrapper">
                            <div class="rotary-buttons">
                                <div class="rotary-btn-row">
                                    <a href="#" class="rotary-btn-label-link" aria-label="Collaborative documents">
                                        <span class="rotary-btn"><span class="vertical-line"></span></span>
                                        Collaborative documents
                                    </a>
                                </div>
                                <div class="rotary-btn-row">
                                    <a href="#" class="rotary-btn-label-link" aria-label="Inline comments">
                                        <span class="rotary-btn"><span class="vertical-line"></span></span>
                                        Inline comments
                                    </a>
                                </div>
                                <div class="rotary-btn-row">
                                    <a href="#" class="rotary-btn-label-link" aria-label="Text-to-issue commands">
                                        <span class="rotary-btn"><span class="vertical-line"></span></span>
                                        Text-to-issue commands
                                    </a>
                                </div>
                            </div>
                            <div class="rotary-buttons-separator"></div>
                        </div>
                        <div>
                            <h3 class="bottom-card-title mb-3">Project and long-term planning</h3>
                            <p class="bottom-card-text">
                                Align your team around a unified product timeline. Plan, manage, and track all product
                                initiatives with visual planning tools inspired by Linear.
                            </p>
                            <a href="https://linear.app/" target="_blank" rel="noopener noreferrer"
                                style="color:#6EC6F6;">
                                Learn more at Linear
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bottom-card-image text-end order-2 order-md-2">
                    <img src="/images/screenshot.png" alt="Project Overview Screenshot" />
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.rotary-btn-row');
        rows[0].classList.add('selected'); // first row active on load

        rows.forEach(row => {
            row.addEventListener('click', () => {
                rows.forEach(r => r.classList.remove('selected'));
                row.classList.add('selected');
            });
        });
    });
    </script>
</body>

</html>