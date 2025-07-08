<div class="container">
    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-4 py-5 my-5 border-top">
        <!-- Logo Column -->
        <div class="col mb-3 ps-3 ps-sm-4">
            <a href="#" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
                <img src="/images/logo.webp" alt="logo" width="50" height="50" style="height: 44px; border-radius: 10px;">
                <h3 class="ms-2 fw-bold text-body-emphasis"><?php echo $_SESSION['phrases']['footer-company'] ?></h3>
            </a>
            <p class="text-body-secondary"><?php echo $_SESSION['phrases']['footer-copyright'] ?></p>
        </div>

        <!-- Contact Column -->
        <div class="col mb-3 ps-3 ps-sm-4">
            <h3><?php echo $_SESSION['phrases']['footer-contact-info'] ?></h3>
            <ul class="nav flex-column mt-3">
                <li class="nav-item mb-2"><a class="nav-link p-0 text-body-secondary"><strong><?php echo $_SESSION['phrases']['footer-email'] ?></strong>
                        info@pulpudev.com</a></li>
                <li class="nav-item mb-2"><a class="nav-link p-0 text-body-secondary"><strong><?php echo $_SESSION['phrases']['footer-phone'] ?></strong> +359 887
                        636 311</a></li>
                <li class="nav-item mb-2"><a class="nav-link p-0 text-body-secondary"><strong><?php echo $_SESSION['phrases']['footer-phone'] ?></strong> +359 878 818 575
                    </a></li>
            </ul>
        </div>

        <!-- Services Column -->
        <div class="col mb-3 ps-3 ps-sm-4">
            <h3><?php echo $_SESSION['phrases']['footer-services'] ?></h3>
            <ul class="nav flex-column mt-3">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary"><?php echo $_SESSION['phrases']['footer-website-building'] ?></a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary"><?php echo $_SESSION['phrases']['footer-hardware-maintenance'] ?></a>
                </li>
            </ul>
        </div>

        <!-- Social Media Column -->
        <div class="col mb-3 ps-3 ps-sm-4">
            <h3><?php echo $_SESSION['phrases']['footer-connect'] ?></h3>
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