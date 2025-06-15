<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/components/component_functions.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/components/functions.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/config.php");

init(basename($_SERVER['PHP_SELF']), $default_theme);
?>

<!DOCTYPE HTML>
<html lang="<?php echo $_SESSION['language']; ?>" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo "$business_name"; ?></title>
    <link rel="icon" type="image/png" href="/images/logo.webp" />
    <?php require_once("{$_SERVER['DOCUMENT_ROOT']}/bootstrap/bootstrap_head.php"); ?>
</head>

<body class='bg-black'>
    <?php if (isset($_GET['contact']) && $_GET['contact'] == 'success'): ?>
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index: 9999;" role="alert">
            Your message has been sent successfully! We'll get back to you soon.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif (isset($_GET['contact']) && $_GET['contact'] == 'failed'): ?>
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index: 9999;" role="alert">
            Sorry, there was a problem sending your message. Please try again later.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php require_once("{$_SERVER['DOCUMENT_ROOT']}/components/background_animation/starry_background.php"); ?>
    <?php require_once("{$_SERVER['DOCUMENT_ROOT']}/components/background_animation/animation.php"); ?>
    <?php require_once("{$_SERVER['DOCUMENT_ROOT']}/pages/global_modules/m_navbar.php"); ?>

    <!-- Bug fix for content starting from the top it ignores the navbar -->
    <div class="content" style="padding-top:70px;"></div>
    <?php require_once("{$_SERVER['DOCUMENT_ROOT']}/components/introduction/introduction.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/layered_image_view/layered_image_view.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/introduction_services/introduction_services.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/project/project.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/contact/contact.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/pages/global_modules/m_footer.php");
    ?>

    <?php require_once("{$_SERVER['DOCUMENT_ROOT']}/bootstrap/bootstrap_body.php"); ?>

    <!-- Smooth Scroll Script needs to be moved later -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.querySelector('a[href="/pages/home/home.php#services-button-go-to"]');
            if (btn) {
                btn.addEventListener('click', function(e) {
                    const target = document.getElementById('services-button-go-to');
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            }
        });
    </script>
</body>

</html>