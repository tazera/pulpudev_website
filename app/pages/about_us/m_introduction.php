<?php
$color = '#944D04';
if ($_SESSION['theme'] == 'light') $color = '#FCD299';
?>
<div class='container-fluid pt-5 pb-5 mt-0 mb-0' style='background: linear-gradient(135deg, rgba(0,0,0,0), <?php echo $color; ?>);'>

	<?php
	$child_content_info = [
		'id' => '',
		'header' => $_SESSION['phrases']['about-people'],
		'classes' => 'text-start',
		'contents' => [
			[
				'type' => 'text', # text or function                                                                                                                         
				'classes' => 'justify-content-center',
				'content' => $_SESSION['phrases']['machines-paragraph'],
				'function_name' => '',
				'arguments' => []
			],
		]
	];
	$parent_content_info = [
		'id' => 'machines',
		'classes' => 'text-center',
		'header' => '',
		'contents' => [
			[
				'type' => 'function', # text or function                                                                                                                     
				'classes' => 'col-md-5 text-md-start',
				'content' => '',
				'function_name' => 'content',
				'arguments' => [$child_content_info]
			],
			[
				'type' => 'html', # text or function                                                                                                                         
				'classes' => 'col-md-5',
				'content' => '',
				'function_name' => '',
				'arguments' => [],
				'html' => '<img src="/images/about_us/about_us_introduction_picture.webp" class="w-100 rounded-5" alt="Machine">',
			],
		]
	];
	content($parent_content_info);
	?>
</div>