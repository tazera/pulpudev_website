<?php
$logo = [
	'image-path' => '/images/logo.png',
	'alt' => 'Company Logo',
	'href' => '/pages/home/home.php',
	'height-in-px' => '50',
	'border-radius' => '10px',
	'border' => '0px',
];
$anchors = [
	// [
	// 	'phrase' => $_SESSION['phrases']['navbar-news'],
	// 	'href' => '/pages/news/news.php'
	// ],
	[
		'phrase' => $_SESSION['phrases']['navbar-about-us'],
		'href' => '/pages/about_us/about_us.php'
	],
	[
		'phrase' => $_SESSION['phrases']['navbar-design'],
		'href' => '/pages/powdercoating/powdercoating.php',
		// 'highlight-color' => 'orange'
	],
	[
		'phrase' => $_SESSION['phrases']['navbar-services'],
		'href' => '#services',
		'dropdown-anchors' => [
			[
				'phrase' => $_SESSION['phrases']['navbar-services-website-building'],
				'href' => '/pages/powdercoating/powdercoating.php'
			],
			[
				'phrase' => $_SESSION['phrases']['navbar-services-hardware-maintenance'],
				'href' => '/pages/diecasting/diecasting.php'
			],
		]
	],
	[
		'phrase' => $_SESSION['phrases']['navbar-contacts'],
		'href' => '/pages/contact_us/contact_us.php'
	]
];
$font_size = '18px';

navbar($logo, $anchors, $font_size, $_SESSION['languages']);