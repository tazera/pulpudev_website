<?php
	$color = 'orange';
	$copyright_phrase = $_SESSION['phrases']['footer-copyright'];
	$links = [
		[
			'href' => 'https://www.jobs.bg/company/71461',
			'image' => '/images/jobs.webp',
			'alt' => 'Jobs BG'
		],
	];
	footer(
		$copyright_phrase,
		$links
	);