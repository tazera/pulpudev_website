<?php
$logo = [
	'image-path' => '/images/logo.webp',
	'alt' => 'Company Logo',
	'companyName' => 'PulpuDEV',
	'href' => '/',
	'height-in-px' => '50',
	'border-radius' => '10px',
	'border' => '0px',
];
$anchors = [
	// [
	// 	'phrase' => $_SESSION['phrases']['navbar-news'],
	// 	'href' => '/pages/news/news.php'
	// ],
	// [
	// 	'phrase' => $_SESSION['phrases']['navbar-about-us'],
	// 	'href' => '/pages/about_us/about_us.php'
	// ],
	[
		'phrase' => $_SESSION['phrases']['navbar-design'],
		'href' => '#projects',
		// 'highlight-color' => 'orange'
	],
	[
		'phrase' => $_SESSION['phrases']['navbar-services'],
		'href' => '#services',
		'dropdown-anchors' => [
			[
				'phrase' => $_SESSION['phrases']['navbar-services-website-building'],
				'href' => '#services'
			],
			[
				'phrase' => $_SESSION['phrases']['navbar-services-hardware-maintenance'],
				'href' => '#services'
			],
		]
	],
	[
		'phrase' => $_SESSION['phrases']['navbar-contacts'],
		'href' => '#contact'
	]
];
$font_size = '18px';

navbar($logo, $anchors, $font_size, $_SESSION['languages']);
