<?php
$tables = [
	'CREATE TABLE IF NOT EXISTS "LANGUAGES" (
		"ISO_CODE" VARCHAR(2) PRIMARY KEY NOT NULL,
		"NAME" VARCHAR(50) NOT NULL UNIQUE
	)',
	'CREATE TABLE IF NOT EXISTS "PHRASES" (
		"ID" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
		"LANGUAGE_ISO_CODE" VARCHAR(2) NOT NULL,
		"KEY" VARCHAR(100) NOT NULL,
		"VALUE" TEXT NOT NULL,

		FOREIGN KEY (LANGUAGE_ISO_CODE) REFERENCES LANGUAGES(ISO_CODE)
	)',
	'CREATE TABLE IF NOT EXISTS "VISITS" (
		"ID" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
		"PAGE" VARCHAR(100),
		"IP_HASH" VARCHAR(256),
		"VISIT_DATETIME" DATETIME DEFAULT CURRENT_TIMESTAMP,
		"COUNTRY" VARCHAR(100),
		"CITY" VARCHAR(100),
		"CONTINENT" VARCHAR(100),
		"LATITUDE" VARCHAR(100),
		"LONGITUDE" VARCHAR(100),
		"CURRENCY_SYMBOL" VARCHAR(100),
		"CURRENCY_CODE" VARCHAR(100),
		"TIMEZONE" VARCHAR(100)
	)'
];

$languages = [
	['ISO_CODE' => 'EN', 'NAME' => 'English'],
	['ISO_CODE' => 'BG', 'NAME' => 'Български'],
	['ISO_CODE' => 'DE', 'NAME' => 'Deutsch']
];

$phrases = [
	[
		'KEY' => 'navbar-news',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'News'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Новини'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Nachrichten'],
		]
	],
	[
		'KEY' => 'navbar-about-us',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'About Us'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'За нас'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Über uns'],
		]
	],
	[
		'KEY' => 'navbar-design',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Design'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Дизайн'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Design'],
		]
	],
	[
		'KEY' => 'navbar-services',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Services'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Услуги'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Dienstleistungen'],
		]
	],
	[
		'KEY' => 'navbar-services-website-building',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Website Building'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изграждане на уебсайтове'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Webseitenbau'],
		]
	],
	[
		'KEY' => 'navbar-services-hardware-maintenance',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Hardware Maintenance'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Поддръжка на хардуер'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Hardware-Wartung'],
		]
	],
	[
		'KEY' => 'navbar-contacts',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Contacts'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Контакти'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Kontakte'],
		]
	],


];