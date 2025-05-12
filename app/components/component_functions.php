<?php

function init($page, $default_theme)
{
	require("{$_SERVER['DOCUMENT_ROOT']}/components/init/init.php");
}

function navbar($logo, $anchors, $font_size, $languages)
{
	require("{$_SERVER['DOCUMENT_ROOT']}/components/navbar/navbar.php");
}

function footer($copyright_phrase, $links)
{
	require("{$_SERVER['DOCUMENT_ROOT']}/components/footer/footer.php");
}

function project($customProjects = null)
{
	// Pass customProjects to the scope of the included file
	require("{$_SERVER['DOCUMENT_ROOT']}/components/project/project.php");
}
