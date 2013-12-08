<?php

	use RelationField\App;

	define('DOCROOT', rtrim(dirname(dirname(dirname(__DIR__))), '\\/'));
	define('PATH_INFO', isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : null);
	define('DOMAIN_PATH', dirname(rtrim($_SERVER['PHP_SELF'], PATH_INFO)));
	define('DOMAIN', rtrim(rtrim($_SERVER['HTTP_HOST'], '\\/') . DOMAIN_PATH, '\\/'));

	// include parts of Symphony
	require_once(DOCROOT . '/symphony/lib/boot/bundle.php');

	require_once(CORE . '/class.configuration.php');
	require_once(TOOLKIT . '/class.field.php');
	require_once(TOOLKIT . '/class.general.php');

	require_once __DIR__ . '/App.php';
	require_once __DIR__ . '/Database.php';
	require_once __DIR__ . '/EntryManager.php';
	require_once __DIR__ . '/FieldManager.php';
	require_once __DIR__ . '/Services.php';
	require_once __DIR__ . '/Utils.php';

	App::init();
