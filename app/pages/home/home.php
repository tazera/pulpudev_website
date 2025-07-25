<?php

// First line of home.php - add redirection check
$current_url = $_SERVER['REQUEST_URI'];
$base_url = preg_replace('/[?#].*$/', '', $current_url);

// If accessed directly, redirect to root and preserve fragment
if ($base_url == '/pages/home/home.php') {
    $fragment = '';
    if (strpos($current_url, '#') !== false) {
        $fragment = substr($current_url, strpos($current_url, '#'));
    }
    header("Location: /" . $fragment);
    exit;
}

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
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JW8DSQVJ45"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-JW8DSQVJ45');
    </script>
    <?php require_once("{$_SERVER['DOCUMENT_ROOT']}/bootstrap/bootstrap_head.php"); ?>
</head>

<body class='bg-black'>
    <?php require_once("{$_SERVER['DOCUMENT_ROOT']}/components/contact/contact_message_send.php"); ?>
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
            const btn = document.querySelector('a[href="/#services-button-go-to"]');
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