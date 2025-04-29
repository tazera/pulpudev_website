<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/components/component_functions.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/components/functions.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/config.php");

init(basename($_SERVER['PHP_SELF']), $default_theme);
?>

<!DOCTYPE HTML>
<html lang="<?php echo $_SESSION['language']; ?>" data-bs-theme="<?php echo $_SESSION['theme']; ?>">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo "$business_name"; ?></title>
	<link rel="icon" type="image/webp" href="/images/tab_logo.webp">
	<link rel="stylesheet" href="/pages/styles/global_styles.css">
	<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/bootstrap/bootstrap_head.php"); ?>
	<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/bootstrap/bootstrap_body.php"); ?>
</head>

<body class='bg-<?php echo $_SESSION['theme']; ?>'>
	<?php
	require_once("{$_SERVER['DOCUMENT_ROOT']}/pages/global_modules/m_navbar.php");
	require_once('m_carousel.php');
	require_once('m_content1.php');
	?>



	<div class='container-fluid d-flex justify-content-center pt-5 pb-5 mt-0 mb-0' style="background-image: url('/images/about_us/about_us_background_office_photo.webp'); background-size: cover; background-position: center; background-attachment: fixed; height: 600px;">
		<div class='col-3 rounded bg-<?php echo $_SESSION['theme']; ?>'>
			<?php
			$content_info = [
				'id' => '',
				'header' => $_SESSION['phrases']['about-office'],
				'classes' => 'justify-content-center text-center pt-4 mb-2',
				'contents' => [
					[
						'type' => 'text', # text or function
						'classes' => 'text-center col-md-10',
						'content' => $_SESSION['phrases']['environment-paragraph'],
						'function_name' => '',
						'arguments' => []
					],
				]
			];
			content($content_info);
			?>
		</div>
	</div>

	<?php
	require_once('m_introduction.php');
	require_once("{$_SERVER['DOCUMENT_ROOT']}/pages/global_modules/m_contact.php");
	require_once("{$_SERVER['DOCUMENT_ROOT']}/pages/global_modules/m_footer.php");
	?>
</body>

</html>