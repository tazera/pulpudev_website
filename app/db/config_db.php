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
	'CREATE TABLE IF NOT EXISTS "PROJECTS" (
		"ID" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
		"IMAGE" VARCHAR(255) NOT NULL,
		"TAGS" TEXT NOT NULL, /* Stored as JSON array */
		"TITLE_KEY" VARCHAR(100) NOT NULL, /* Reference to PHRASES table key */
		"DESCRIPTION_KEY" VARCHAR(100) NOT NULL, /* Reference to PHRASES table key */
		"CHALLENGE_KEY" VARCHAR(100) NOT NULL, /* Reference to PHRASES table key */
		"SOLUTION_KEY" VARCHAR(100) NOT NULL, /* Reference to PHRASES table key */
		"RESULT_KEY" VARCHAR(100) NOT NULL, /* Reference to PHRASES table key */
		"METRICS" TEXT NOT NULL, /* Stored as JSON array */
		"MEDIA" TEXT NOT NULL, /* Stored as JSON array */
		"FEATURED" BOOLEAN DEFAULT 0 /* To mark featured projects */
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

// Add the project data to be inserted
$projects = [
	[
		'IMAGE' => '/images/projects/plamen1.webp',
		'TAGS' => json_encode(['Desktop App', 'SaaS']),
		'TITLE_KEY' => 'projects1-h2', // Reference to existing phrase
		'DESCRIPTION_KEY' => 'projects1-description',
		'CHALLENGE_KEY' => 'projects1-challenge',
		'SOLUTION_KEY' => 'projects1-solution',
		'RESULT_KEY' => 'projects1-result',
		'METRICS' => json_encode(['50% work optimization']),
		'MEDIA' => json_encode(['/images/projects/plamen1.webp', '/images/projects/plamen1.webp', '/images/projects/plamen1.webp']),
		'FEATURED' => 1
	],
	[
		'IMAGE' => '/images/projects/laki.webp',
		'TAGS' => json_encode(['WebSite', 'Corporate Website', 'Web App']),
		'TITLE_KEY' => 'projects2-h2',
		'DESCRIPTION_KEY' => 'projects2-description',
		'CHALLENGE_KEY' => 'projects2-challenge',
		'SOLUTION_KEY' => 'projects2-solution',
		'RESULT_KEY' => 'projects2-result',
		'METRICS' => json_encode(['10k visits', '99% uptime']),
		'MEDIA' => json_encode(['/images/projects/laki.webp', '/images/projects/laki-powdercoationg.webp']),
		'FEATURED' => 1
	],
	// [
	// 	'IMAGE' => '/images/projects/project1.webp',
	// 	'TAGS' => json_encode(['Data Analytics', 'Dashboard']),
	// 	'TITLE_KEY' => 'projects3-h2',
	// 	'DESCRIPTION_KEY' => 'projects3-description',
	// 	'CHALLENGE_KEY' => 'projects3-challenge',
	// 	'SOLUTION_KEY' => 'projects3-solution',
	// 	'RESULT_KEY' => 'projects3-result',
	// 	'METRICS' => json_encode(['1.5 days shorter stays', '$2.4M annual savings']),
	// 	'MEDIA' => json_encode(['/images/projects/project1.webp', '/images/projects/project1.webp']),
	// 	'FEATURED' => 1
	// ]
];

$phrases = [
	// Navbar phrases
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

	// Service phrases
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
	// Project titles and descriptions
	[
		'KEY' => 'projects1-h2',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Enterprise Chain Management System'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Система за управление на верига магазини'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Unternehmenskettenmanagementsystem'],
		]
	],
	[
		'KEY' => 'projects2-h2',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Company Website'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Корпоративен уебсайт'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Unternehmenswebsite'],
		]
	],
	[
		'KEY' => 'projects3-h2',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Healthcare Analytics Platform'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Платформа за здравни анализи'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Healthcare-Analyseplattform'],
		]
	],
	// Project 1 content translations
	[
		'KEY' => 'projects1-description',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'A comprehensive platform for managing small, medium, and large enterprises with accounting and sales management features.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Цялостна платформа за управление на малки, средни и големи предприятия с функции осчетоводство и управление на продажби.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Eine umfassende Plattform für die Verwaltung von kleinen, mittleren und großen Unternehmen mit Buchhaltungs- und Verkaufsmanagementfunktionen.'],
		]
	],
	[
		'KEY' => 'projects1-challenge',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'The client needed to unify their task management across 12 departments with varying workflows and compliance requirements.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Клиентът трябваше да унифицира управлението на задачите си в 12 отдела с различни работни потоци и изисквания за съответствие.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Der Kunde musste seine Aufgabenverwaltung in 12 Abteilungen mit unterschiedlichen Arbeitsabläufen und Compliance-Anforderungen vereinheitlichen.'],
		]
	],
	[
		'KEY' => 'projects1-solution',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'We developed a flexible system with customizable workflows, role-based permissions, and detailed audit logs for compliance tracking.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Разработихме гъвкава система с персонализируеми работни потоци, разрешения, базирани на роли, и подробни одитни логове за проследяване на съответствието.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Wir haben ein flexibles System mit anpassbaren Workflows, rollenbasierten Berechtigungen und detaillierten Prüfprotokollen für die Compliance-Verfolgung entwickelt.'],
		]
	],
	[
		'KEY' => 'projects1-result',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Reduced task handoff time by 42% and improved cross-department visibility by implementing shared dashboards.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Намалено време за предаване на задачи с 42% и подобрена видимост между отделите чрез внедряване на споделени табла.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Die Übergabezeit für Aufgaben wurde um 42 % reduziert und die abteilungsübergreifende Sichtbarkeit durch die Implementierung gemeinsamer Dashboards verbessert.'],
		]
	],
	// Project 2 content translations
	[
		'KEY' => 'projects2-description',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'An elegant corporate website for a large client showcasing their services and portfolio.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Елегантен уебсайт за голям корпоративен клиент, който демонстрира техните услуги и портфолио.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Eine elegante Unternehmenswebsite für einen großen Kunden, die dessen Dienstleistungen und Portfolio präsentiert.'],
		]
	],
	[
		'KEY' => 'projects2-challenge',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'The retail chain was losing market share to competitors with better digital presence and needed a mobile-first approach.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Търговската верига губеше пазарен дял в полза на конкуренти с по-добро дигитално присъствие и се нуждаеше от подход, ориентиран към мобилни устройства.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Die Einzelhandelskette verlor Marktanteile an Wettbewerber mit besserer digitaler Präsenz und benötigte einen mobilen Ansatz.'],
		]
	],
	[
		'KEY' => 'projects2-solution',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'We created a native mobile app with AR product previews, personalized recommendations, and seamless checkout process.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Създадохме нативно мобилно приложение с AR визуализации на продукти, персонализирани препоръки и безпроблемен процес на плащане.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Wir haben eine native mobile App mit AR-Produktvorschauen, personalisierten Empfehlungen und einem nahtlosen Checkout-Prozess erstellt.'],
		]
	],
	[
		'KEY' => 'projects2-result',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'The application achieved 230,000 downloads in the first quarter and increased mobile conversions by 28%.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Приложението постигна 230 000 изтегляния през първото тримесечие и увеличи мобилните конверсии с 28%.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Die Anwendung erreichte im ersten Quartal 230.000 Downloads und steigerte die mobilen Conversions um 28 %.'],
		]
	],
	// Project 3 content translations
	[
		'KEY' => 'projects3-description',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Data visualization and analytics dashboard for healthcare providers tracking patient outcomes.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Табло за визуализация на данни и анализ за здравни доставчици, проследяващо резултатите на пациентите.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Datenvisualisierungs- und Analysedashboard für Gesundheitsdienstleister zur Verfolgung von Patientenergebnissen.'],
		]
	],
	[
		'KEY' => 'projects3-challenge',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Healthcare providers struggled with disconnected data systems and lacked insights for improving patient care.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Здравните доставчици се бореха с несвързани системи за данни и им липсваше информация за подобряване на грижите за пациентите.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Gesundheitsdienstleister kämpften mit nicht vernetzten Datensystemen und fehlten Erkenntnisse zur Verbesserung der Patientenversorgung.'],
		]
	],
	[
		'KEY' => 'projects3-solution',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'We built a HIPAA-compliant analytics platform that unified patient data from multiple sources with customizable dashboards.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изградихме аналитична платформа, съответстваща на HIPAA, която обединява данни за пациенти от множество източници с персонализируеми табла.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Wir haben eine HIPAA-konforme Analyseplattform aufgebaut, die Patientendaten aus mehreren Quellen mit anpassbaren Dashboards vereint.'],
		]
	],
	[
		'KEY' => 'projects3-result',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Enabled data-driven decisions that reduced average hospital stay duration by 1.5 days and improved resource allocation.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Позволихме решения, основани на данни, които намалиха средната продължителност на болничния престой с 1,5 дни и подобриха разпределението на ресурсите.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Ermöglichte datengesteuerte Entscheidungen, die die durchschnittliche Krankenhausaufenthaltsdauer um 1,5 Tage verkürzten und die Ressourcenzuweisung verbesserten.'],
		]
	],


	// Contact Page Phrases
	[
		'KEY' => 'contact-title',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Contact us'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Свържете се с нас'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Kontaktieren Sie uns'],
		]
	],
	[
		'KEY' => 'contact-description',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Get in touch with our team to discuss your project requirements or learn more about our services.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Свържете се с нашия екип, за да обсъдите вашите проектни изисквания или да научите повече за нашите услуги.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Kontaktieren Sie unser Team, um Ihre Projektanforderungen zu besprechen oder mehr über unsere Dienstleistungen zu erfahren.'],
		]
	],
	[
		'KEY' => 'contact-email',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Email:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Имейл:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'E-Mail:'],
		]
	],
	[
		'KEY' => 'contact-phone',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Phone:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Телефон:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Telefon:'],
		]
	],
	[
		'KEY' => 'contact-send-message',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Send us a message'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изпратете ни съобщение'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Senden Sie uns eine Nachricht'],
		]
	],
	[
		'KEY' => 'contact-full-name',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Full Name'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Пълно име'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Vollständiger Name'],
		]
	],
	[
		'KEY' => 'contact-company-name',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Company Name'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Име на компанията'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Firmenname'],
		]
	],
	[
		'KEY' => 'contact-work-email',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Work Email'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Служебен имейл'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Geschäftliche E-Mail'],
		]
	],
	[
		'KEY' => 'contact-phone-optional',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Phone Number (optional)'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Телефонен номер (по избор)'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Telefonnummer (optional)'],
		]
	],
	[
		'KEY' => 'contact-select-service',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Select a service'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изберете услуга'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Wählen Sie einen Service'],
		]
	],
	[
		'KEY' => 'contact-digitalization',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Digitalization'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Дигитализация'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Digitalisierung'],
		]
	],
	[
		'KEY' => 'contact-website-building',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Website Building'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изграждане на уебсайтове'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Webseitenbau'],
		]
	],
	[
		'KEY' => 'contact-hardware-maintenance',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Hardware Maintenance'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Поддръжка на хардуер'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Hardwarewartung'],
		]
	],
	[
		'KEY' => 'contact-b2b-software',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'B2B Software'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'B2B Софтуер'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'B2B-Software'],
		]
	],
	[
		'KEY' => 'contact-custom-software',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Custom Software/System Development'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Разработка на персонализиран софтуер/система'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Individuelle Software-/Systementwicklung'],
		]
	],
	[
		'KEY' => 'contact-other',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Other'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Друго'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Andere'],
		]
	],
	[
		'KEY' => 'contact-service-interest',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Service of Interest'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Интересуваща услуга'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Interessierender Service'],
		]
	],
	[
		'KEY' => 'contact-please-specify',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Please specify'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Моля, уточнете'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Bitte angeben'],
		]
	],
	[
		'KEY' => 'contact-title',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Contact us'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Свържете се с нас'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Kontaktieren Sie uns'],
		]
	],
	[
		'KEY' => 'contact-description',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Get in touch with our team to discuss your project requirements or learn more about our services.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Свържете се с нашия екип, за да обсъдите вашите проектни изисквания или да научите повече за нашите услуги.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Kontaktieren Sie unser Team, um Ihre Projektanforderungen zu besprechen oder mehr über unsere Dienstleistungen zu erfahren.'],
		]
	],
	[
		'KEY' => 'contact-email',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Email:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Имейл:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'E-Mail:'],
		]
	],
	[
		'KEY' => 'contact-phone',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Phone:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Телефон:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Telefon:'],
		]
	],
	[
		'KEY' => 'contact-send-message',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Send us a message'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изпратете ни съобщение'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Senden Sie uns eine Nachricht'],
		]
	],
	[
		'KEY' => 'contact-full-name',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Full Name'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Пълно име'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Vollständiger Name'],
		]
	],
	[
		'KEY' => 'contact-company-name',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Company Name'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Име на компанията'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Firmenname'],
		]
	],
	[
		'KEY' => 'contact-work-email',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Work Email'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Служебен имейл'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Geschäftliche E-Mail'],
		]
	],
	[
		'KEY' => 'contact-phone-optional',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Phone Number (optional)'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Телефонен номер (по избор)'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Telefonnummer (optional)'],
		]
	],
	[
		'KEY' => 'contact-select-service',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Select a service'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изберете услуга'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Wählen Sie einen Service'],
		]
	],
	[
		'KEY' => 'contact-digitalization',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Digitalization'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Дигитализация'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Digitalisierung'],
		]
	],
	[
		'KEY' => 'contact-website-building',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Website Building'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изграждане на уебсайтове'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Webseitenbau'],
		]
	],
	[
		'KEY' => 'contact-hardware-maintenance',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Hardware Maintenance'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Поддръжка на хардуер'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Hardwarewartung'],
		]
	],
	[
		'KEY' => 'contact-b2b-software',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'B2B Software'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'B2B Софтуер'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'B2B-Software'],
		]
	],
	[
		'KEY' => 'contact-custom-software',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Custom Software/System Development'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Разработка на персонализиран софтуер/система'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Individuelle Software-/Systementwicklung'],
		]
	],
	[
		'KEY' => 'contact-other',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Other'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Друго'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Andere'],
		]
	],
	[
		'KEY' => 'contact-service-interest',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Service of Interest'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Интересуваща услуга'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Interessierender Service'],
		]
	],
	[
		'KEY' => 'contact-please-specify',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Please specify'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Моля, уточнете'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Bitte angeben'],
		]
	],

	// Footer Phrases
	[
		'KEY' => 'footer-contact-info',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Contact info:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Контактна информация:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Kontaktinformationen:'],
		]
	],
	[
		'KEY' => 'footer-email',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Email:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Имейл:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'E-Mail:'],
		]
	],
	[
		'KEY' => 'footer-phone',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Phone:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Телефон:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Telefon:'],
		]
	],
	[
		'KEY' => 'footer-services',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Services:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Услуги:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Dienstleistungen:'],
		]
	],
	[
		'KEY' => 'footer-website-building',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Website Building'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изграждане на уебсайтове'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Webseitenbau'],
		]
	],
	[
		'KEY' => 'footer-hardware-maintenance',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Hardware Maintenance'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Поддръжка на хардуер'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Hardwarewartung'],
		]
	],
	[
		'KEY' => 'footer-connect',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Connect with us!'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Свържете се с нас!'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Verbinden Sie sich mit uns!'],
		]
	],
	[
		'KEY' => 'footer-company',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'PulpuDEV'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'ПулпуДЕВ'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'PulpuDEV'],
		]
	],
	[
		'KEY' => 'footer-copyright',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => '© Copyright 2025.<br> All Rights Reserved.'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => '© Копирайт 2025.<br> Всички права запазени.'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => '© Copyright 2025.<br> Alle Rechte vorbehalten.'],
		]
	],
	[
		'KEY' => 'footer-contact-info',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Contact info:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Контактна информация:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Kontaktinformationen:'],
		]
	],
	[
		'KEY' => 'footer-email',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Email:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Имейл:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'E-Mail:'],
		]
	],
	[
		'KEY' => 'footer-phone',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Phone:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Телефон:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Telefon:'],
		]
	],
	[
		'KEY' => 'footer-services',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Services:'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Услуги:'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Dienstleistungen:'],
		]
	],
	[
		'KEY' => 'footer-website-building',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Website Building'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Изграждане на уебсайтове'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Webseitenbau'],
		]
	],
	[
		'KEY' => 'footer-hardware-maintenance',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Hardware Maintenance'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Поддръжка на хардуер'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Hardwarewartung'],
		]
	],
	[
		'KEY' => 'footer-connect',
		'TRANSLATIONS' => [
			['LANGUAGE_ISO_CODE' => 'EN', 'VALUE' => 'Connect with us!'],
			['LANGUAGE_ISO_CODE' => 'BG', 'VALUE' => 'Свържете се с нас!'],
			['LANGUAGE_ISO_CODE' => 'DE', 'VALUE' => 'Verbinden Sie sich mit uns!'],
		]
	],
];
