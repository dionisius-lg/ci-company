<?php

ini_set('date.timezone', 'Asia/Jakarta');

$config = [
	'database' => [
		'host'		=> 'localhost',
		'dbname'	=> 'ci_company', // local
		// 'dbname'	=> 'ptarjcom_database', // ptarj.com
		'username'	=> 'root', // local
		// 'username'	=> 'ptarjcom_administrator', // ptarj.com
		'password'	=> '',
		// 'password'	=> 'ptarjcom102030', // ptarj.com
	],
	'socket_url' => 'http://127.0.0.1:8001',
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
