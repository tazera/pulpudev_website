<div class="container">
    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-4 py-5 my-5 border-top">
        <!-- Logo Column -->
        <div class="col mb-3 ps-3 ps-sm-4">
            <a href="#" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
                <img src="/images/logo.png" alt="logo" width="50" height="50" style="height: 44px; border-radius: 10px;">
                <h3 class="ms-2 fw-bold text-body-emphasis">Pulpudev</h3>
            </a>
            <p class="text-body-secondary">© Copyright 2025.<br> All Rights Reserved.</p>
        </div>

        <!-- Contact Column -->
        <div class="col mb-3 ps-3 ps-sm-4">
            <h3>Contact info:</h3>
            <ul class="nav flex-column mt-3">
                <li class="nav-item mb-2"><a class="nav-link p-0 text-body-secondary"><strong>Email:</strong>
                        info@pulpudev.com</a></li>
                <li class="nav-item mb-2"><a class="nav-link p-0 text-body-secondary"><strong>Phone:</strong> +359 887
                        6363 11</a></li>
            </ul>
        </div>

        <!-- Services Column -->
        <div class="col mb-3 ps-3 ps-sm-4">
            <h3>Services:</h3>
            <ul class="nav flex-column mt-3">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Website Building</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Hardware Maintenance</a>
                </li>
            </ul>
        </div>

        <!-- Social Media Column -->
        <div class="col mb-3 ps-3 ps-sm-4">
            <h3>Connect with us!</h3>
            <ul class='nav flex-column'>
                <?php foreach ($links as $link): ?>
                    <li class='ms-0 ms-md-3'>
                        <a class='text-body-secondary' href='<?= $link['href'] ?>' target='_blank'>
                            <img src='<?= $link['image'] ?>' alt='<?= $link['alt'] ?>' width="370" height="110" class='rounded mt-3 img-fluid'
                                style='height: 60px; border: 1px solid black;'>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </footer>
</div>