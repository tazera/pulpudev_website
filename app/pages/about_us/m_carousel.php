<?php
$coursel_height_percent = 60;
$time_auto_next_ms = 2000;
$slides = [
	[
		'image_src' => '/images/about_us/about_us_corousel_pic1.webp',
		'alt' => 'Powdercoating',
		'phrase-heading' => $_SESSION['phrases']['label-slide1-heading'],
		'phrase-paragraph' => $_SESSION['phrases']['label-slide1-paragraph'],
		'position' => 'left',
		'opacity' => true,
		'htext' => 'left',
		'ptext' => 'left',
		'position_top' => true,
		'line' => true,
		'character_outline' => true,
	],
	[
		'image_src' => '/images/about_us/about_us_corousel_pic2.webp',
		'alt' => 'Powdercoating',
		'phrase-heading' => $_SESSION['phrases']['label-slide1-heading'],
		'phrase-paragraph' => $_SESSION['phrases']['label-slide1-paragraph'],
		'position' => 'left',
		'opacity' => true,
		'htext' => 'left',
		'ptext' => 'left',
		'position_top' => true,
		'line' => true,
		'character_outline' => true,
	],
	[
		'image_src' => '/images/about_us/about_us_corousel_pic3.webp',
		'alt' => 'Powdercoating',
		'phrase-heading' => $_SESSION['phrases']['label-slide1-heading'],
		'phrase-paragraph' => $_SESSION['phrases']['label-slide1-paragraph'],
		'position' => 'left',
		'opacity' => true,
		'htext' => 'left',
		'ptext' => 'left',
		'position_top' => true,
		'line' => true,
		'character_outline' => true,
	],
];
$strip = [
	'hide' => true,
	'phrase' => $_SESSION['phrases']['strip-heading'],
	'color-light' => '#EACD99',
	'degree-light' => 0,
	'color-dark' => '#3B3B3B',
	'degree-dark' => 0,
];
carousel(
	$coursel_height_percent,
	$time_auto_next_ms,
	$slides,
	$strip
);
