<?php
$logo = [
	'image-path' => '/images/logo.webp',
	'alt' => 'Company Logo',
	'href' => '/pages/home/home.php',
	'height-in-px' => '50',
	'border-radius' => '10px',
	'border' => '0px',
];
$anchors = [
	/*[*/
	/*	'phrase' => $_SESSION['phrases']['navbar-home'],*/
	/*	'href' => '#'*/
	/*],*/
	[
		'phrase' => $_SESSION['phrases']['navbar-about-us'],
		'href' => '/pages/about_us/about_us.php'
	],
	[
		'phrase' => $_SESSION['phrases']['navbar-powder-coating'],
		'href' => '/pages/powdercoating/powdercoating.php',
		'highlight-color' => 'orange'
	],
	[
		'phrase' => $_SESSION['phrases']['navbar-services'],
		'href' => '#services',
		'dropdown-anchors' => [
			[
				'phrase' => $_SESSION['phrases']['navbar-services-powdercoating'],
				'href' => '/pages/powdercoating/powdercoating.php'
			],
			[
				'phrase' => $_SESSION['phrases']['navbar-services-casting'],
				'href' => '#services'
			],
			[
				'phrase' => $_SESSION['phrases']['navbar-services-machining'],
				'href' => '#services'
			],
		]
	],
	[
		'phrase' => $_SESSION['phrases']['navbar-machine-park'],
		'href' => '#'
	],
	[
		'phrase' => $_SESSION['phrases']['navbar-find-us'],
		'href' => '#find-us'
	],
	[
		'phrase' => $_SESSION['phrases']['navbar-contacts'],
		'href' => '#contacts'
	]
];
$font_size = '18px';

navbar($logo, $anchors, $font_size, $_SESSION['languages']);
