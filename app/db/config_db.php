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
		'KEY' => 'h2-services',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'List of our services:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Списък с нашите услуги:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Liste unserer Dienstleistungen:'],
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
	[
		'KEY' => 'services3',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Hardware Maintenance & Support'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Поддръжка и поддръжка на хардуер'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Hardwarewartung und -support'],
		]
	],
	[
		'KEY' => 'services-box-title1',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Full-Cycle Digital Solutions'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Цялостни дигитални решения'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Full-Cycle-Digital-Lösungen'],
		]
	],
	[
		'KEY' => 'services-box-text1',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Stay informed at every step with transparent timelines, clear milestones, and proactive communication throughout the project lifecycle.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Бъдете информирани на всяка стъпка с прозрачни срокове, ясни етапи и проактивна комуникация през целия жизнен цикъл на проекта.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Bleiben Sie bei jedem Schritt informiert mit transparenten Zeitplänen, klaren Meilensteinen und proaktiver Kommunikation während des gesamten Projektlebenszyklus.'],
		]
	],
	[
		'KEY' => 'services-box-title2',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Real-Time Project Tracking'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Проследяване на проекта в реално време'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Echtzeit-Projektverfolgung'],
		]
	],
	[
		'KEY' => 'services-box-text2',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Choosing PulpuDEV means full visibility into your project’s progress at every stage. Our collaborative platform allows you to monitor real-time updates, track task statuses'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изборът на PulpuDEV означава пълна видимост за напредъка на вашия проект на всеки етап. Нашата съвместна платформа ви позволява да наблюдавате актуализации в реално време'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Die Wahl von PulpuDEV bedeutet volle Sichtbarkeit des Fortschritts Ihres Projekts in jeder Phase.'],
		]
	],
	[
		'KEY' => 'services-website-building-h2',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Website Building'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изграждане на уебсайтове'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Webseitenbau'],
		]
	],
	[
		'KEY' => 'services-website-building-p',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'We build modern, responsive websites tailored to your business goals. From clean landing pages to complex web platforms, our solutions are fast, secure, and fully optimized for all devices. Every site we create is designed for performance, scalability, and a seamless user experience.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изграждаме модерни, отзивчиви уебсайтове, съобразени с бизнес целите ви. От чисти целеви страници до сложни уеб платформи, нашите решения са бързи, сигурни и напълно оптимизирани за всички устройства. '],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Wir erstellen moderne, responsive Websites, die auf Ihre Geschäftsziele zugeschnitten sind. Von klaren Landing Pages bis hin zu komplexen Webplattformen sind unsere Lösungen schnell, sicher und vollständig für alle Geräte optimiert.'],
		]
	],
	[
		'KEY' => 'services-b2b-h2',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'B2B Solutions'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'B2B решения'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'B2B-Lösungen'],
		]
	],
	[
		'KEY' => 'services-b2b-text',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'We provide tailored B2B digital solutions that help streamline operations and improve collaboration between partners. Our platforms are built for scalability, security, and long-term growth. '],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Предоставяме персонализирани B2B цифрови решения, които помагат за оптимизиране на операциите и подобряване на сътрудничеството между партньорите. Нашите платформи са изградени за мащабируемост, сигурност и дългосрочен растеж. '],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Wir bieten maßgeschneiderte B2B-Digitallösungen, die helfen, Abläufe zu optimieren und die Zusammenarbeit zwischen Partnern zu verbessern.'],
		]
	],
	[
		'KEY' => 'services-hardware-h2',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Hardware Maintenance & Support'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Поддръжка и поддръжка на хардуер'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Hardwarewartung und -support'],
		]
	],
	[
		'KEY' => 'services-hardware-text',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'We offer reliable hardware maintenance and technical support to keep your systems running smoothly. Our team ensures timely diagnostics, repairs, and component replacements when needed. '],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Предлагаме надеждна поддръжка на хардуер и техническа поддръжка, за да поддържате системите си в добро състояние. Нашият екип осигурява навременна диагностика, ремонти и подмяна на компоненти при необходимост.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Wir bieten zuverlässige Hardwarewartung und technischen Support, um Ihre Systeme reibungslos am Laufen zu halten.'],
		]
	],
	[
		'KEY' => 'projects-h1',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Our Products'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Нашите продукти'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Unsere Produkte'],
		]
	],
	[
		'KEY' => 'projects-h2-text',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Explore our range of products designed to meet your needs. From cutting-edge software solutions to reliable hardware, we have everything you need to succeed.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Разгледайте нашата гама от продукти, проектирани да отговорят на вашите нужди. От иновационни софтуерни решения до надежден хардуер, ние имаме всичко необходимо за вашия успех.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Entdecken Sie unser Sortiment an Produkten, die auf Ihre Bedürfnisse zugeschnitten sind. Von innovativen Softwarelösungen bis hin zu zuverlässiger Hardware haben wir alles, was Sie für Ihren Erfolg benötigen.'],
		]
	],
	[
		'KEY' => 'projects1-h2',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Enterprise Shop Management System'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Система за управление на корпоративен магазин'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Enterprise-Shop-Management-System'],
		]
	],



];
