<?php

ini_set('date.timezone', 'Asia/Jakarta');

$config = [
	'database' => [
		'host'		=> 'localhost',
		// local
		'username'	=> 'root',
		'password'	=> '',
		'dbname'	=> 'ci_company'
		// ptarj.com
		// 'dbname'	=> 'ptarjcom_database',
		// 'username'	=> 'ptarjcom_administrator',
		// 'password'	=> 'ptarjcom102030'
	],
	'socket_url' => ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . ":62542",
	'log' => [
		'dir'		=> './application/logs/',
		'error'		=> 'error_log_'.date('Ymd').'.log',
		'success'	=> 'success_log_'.date('Ymd').'.log',
	],
	'working_hour' => [
		'start'	=> 1,
		'end'	=> 25,
	],
	'phpscript_dir' => './application/libraries/phpscript/',
	'ftp' => [
		'protocol'		=> 'ftp',
		'encryption'	=> '',
		'host'			=> '139.162.6.196',
		'port'			=> '21',
		'username'		=> 'ptarjcom',
		'password'		=> '6ja:YQ0a9Pf(9D',
		'dir'			=> '/public_html',
	],
	'email_status' => [
		'unread'	=> 7,
		'read'		=> 8,
		'queued'	=> 9,
		'sent'		=> 10,
		'error'		=> 11,
		'process'	=> 33,
	],
];
