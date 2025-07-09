<?php
require "config_db.php";
$db = new SQLite3("../db.sqlite", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
$db->enableExceptions(true);

foreach($tables as $table)
	$db->query($table);

$db->exec("BEGIN");

// Drop and recreate the PROJECTS table to apply schema changes
$db->query("DROP TABLE IF EXISTS 'PROJECTS'");
// Re-run the PROJECTS table creation
$db->query($tables[2]);

$db->query("DELETE FROM 'LANGUAGES'");
$db->query("DELETE FROM 'PHRASES'");

foreach($languages as $language)
	$db->query("INSERT INTO 'LANGUAGES' ('ISO_CODE', 'NAME') VALUES ('{$language['ISO_CODE']}', '{$language['NAME']}')");

foreach($phrases as $phrase)
	foreach($phrase['TRANSLATIONS'] as $translation)
		$db->query("INSERT INTO 'PHRASES' ('LANGUAGE_ISO_CODE', 'KEY', 'VALUE') VALUES ('{$translation['LANGUAGE_ISO_CODE']}', '{$phrase['KEY']}', '{$translation['VALUE']}')")
;

// Insert the project data
foreach($projects as $project) {
    $stmt = $db->prepare("INSERT INTO 'PROJECTS' ('IMAGE', 'TAGS', 'TITLE_KEY', 'DESCRIPTION_KEY', 'CHALLENGE_KEY', 'SOLUTION_KEY', 'RESULT_KEY', 'METRICS', 'MEDIA', 'FEATURED') VALUES (:image, :tags, :title_key, :description_key, :challenge_key, :solution_key, :result_key, :metrics, :media, :featured)");
    
    $stmt->bindValue(':image', $project['IMAGE']);
    $stmt->bindValue(':tags', $project['TAGS']);
    $stmt->bindValue(':title_key', $project['TITLE_KEY']);
    $stmt->bindValue(':description_key', $project['DESCRIPTION_KEY']);
    $stmt->bindValue(':challenge_key', $project['CHALLENGE_KEY']);
    $stmt->bindValue(':solution_key', $project['SOLUTION_KEY']);
    $stmt->bindValue(':result_key', $project['RESULT_KEY']);
    $stmt->bindValue(':metrics', $project['METRICS']);
    $stmt->bindValue(':media', $project['MEDIA']);
    $stmt->bindValue(':featured', $project['FEATURED']);
    
    $stmt->execute();
}

$db->exec("COMMIT");
