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
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Products'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Продукти'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Produkte'],
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
	[
		'KEY' => 'introduction-hero-title',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'A better way to build <span class="hero-gradient">products</span>'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'По-добър начин за изграждане на <span class="hero-gradient">продукти</span>'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Eine bessere Art, <span class="hero-gradient">Produkte</span> zu erstellen'],
		]
	],
	[
		'KEY' => 'introduction-hero-subtitle',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => ' • Digitalization • Websites • B2B & Custom Systems • Hardware Care
			<br> From sleek websites to enterprise B2B systems and hardware maintenance, we bring your projects to life. '],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => ' • Дигитализация • Уебсайтове • B2B и персонализирани системи • Поддръжка на хардуер
			 <br>От елегантни уебсайтове до корпоративни B2B системи и поддръжка на хардуер, ние реализираме вашите проекти.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => ' • Digitalisierung • Websites • B2B- und maßgeschneiderte Systeme • Hardwarepflege
			 <br>Von eleganten Websites bis hin zu Unternehmens-B2B-Systemen und Hardwarewartung bringen wir Ihre Projekte zum Leben.'],
		]
	],
	[
		'KEY' => 'introduction-hero-button',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Start Your Project'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Започнете проекта си'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Projekt starten'],
		]
	],
	[
		'KEY' => 'services-title',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Our Services'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Нашите услуги'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Unsere Dienstleistungen'],
		]
	],
	[
		'KEY' => 'services-subtitle',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'We help ambitious companies drive growth and efficiency with fast, reliable digital solutions—from full-scale digitalization and responsive websites to B2B platforms, custom software, and proactive hardware maintenance.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Помагаме на амбициозни компании да стимулират растежа и ефективността с бързи, надеждни дигитални решения - от цялостна дигитализация и отзивчиви уебсайтове до B2B платформи, персонализиран софтуер и проактивна поддръжка на хардуер.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Wir helfen ehrgeizigen Unternehmen, Wachstum und Effizienz mit schnellen, zuverlässigen digitalen Lösungen voranzutreiben – von der umfassenden Digitalisierung und responsiven Websites bis hin zu B2B-Plattformen, maßgeschneiderter Software und proaktiver Hardwarewartung.'],
		]
	],
	[
		'KEY' => 'services-box-title1',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Website Building'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изграждане на уебсайтове'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Webseitenbau'],
		]
	],
	[
		'KEY' => 'services1',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Website Design & Development'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Дизайн и разработка на уебсайтове'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Webdesign und -entwicklung'],
		]
	],
	[
		'KEY' => 'services2',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'B2B Solutions'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'B2B решения'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'B2B-Lösungen'],
		]
	],
	[
		'KEY' => 'services3',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Hardware Maintenance & Support'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Поддръжка и поддръжка на хардуер'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Hardwarewartung und -support'],
		]
	],


];
