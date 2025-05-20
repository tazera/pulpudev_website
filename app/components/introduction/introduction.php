<style>
    .hero-gradient {
        background: linear-gradient(90deg, #ff8800 0%, #ff5722 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.4rem;
        color: #b0b0b0;
        margin-bottom: 2.5rem;
        font-weight: 400;
    }

    .animated-btn {
        transition: all 0.6s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }

    .animated-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    .custom-btn {
        background: linear-gradient(90deg, #ff8800, #d33d10);
        border: none;
        border-radius: 50px;
        color: #fff;
        padding: 12px 30px;
    }
</style>
<section class="d-flex align-items-center justify-content-center text-center"
    style="min-height:45vh; background:transparent;">
    <div class="container py-5">

        <h1 class="display-4 fw-bold mb-3">
            <?php echo $_SESSION['phrases']['introduction-hero-title'] ?>
        </h1>
        <p class="hero-subtitle">
            <?php echo $_SESSION['phrases']['introduction-hero-subtitle'] ?>
        </p>
        <a href="/pages/home/home.php#services-button-go-to"
            class="btn btn-lg rounded-pill animated-btn custom-btn"><?php echo $_SESSION['phrases']['introduction-hero-button'] ?></a>
    </div>
</section>