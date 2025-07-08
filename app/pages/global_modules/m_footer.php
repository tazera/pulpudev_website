<?php
$color = 'orange';
$copyright_phrase = $_SESSION['phrases']['footer-copyright'];
$links = [
	[
		'href' => 'https://www.linkedin.com/company/pulpudev/',
		'image' => '/images/footer/LinkedIn.webp',
		'alt' => 'LinkedIn',
	],
];
footer(
	$copyright_phrase,
	$links
);
