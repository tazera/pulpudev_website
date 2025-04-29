<?php
require "config_db.php";
$db = new SQLite3("../db.sqlite", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
$db->enableExceptions(true);

foreach($tables as $table)
	$db->query($table);

$db->exec("BEGIN");

$db->query("DELETE FROM 'LANGUAGES'");
$db->query("DELETE FROM 'PHRASES'");

foreach($languages as $language)
	$db->query("INSERT INTO 'LANGUAGES' ('ISO_CODE', 'NAME') VALUES ('{$language['ISO_CODE']}', '{$language['NAME']}')");

foreach($phrases as $phrase)
	foreach($phrase['TRANSLATIONS'] as $translation)
		$db->query("INSERT INTO 'PHRASES' ('LANGUAGE_ISO_CODE', 'KEY', 'VALUE') VALUES ('{$translation['LANGUAGE_ISO_CODE']}', '{$phrase['KEY']}', '{$translation['VALUE']}')")
;

$db->exec("COMMIT");
