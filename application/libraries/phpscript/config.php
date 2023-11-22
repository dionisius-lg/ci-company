<?php

ini_set('date.timezone', 'Asia/Jakarta');

require __DIR__ . '../../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../..');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_USER', 'DB_PASS', 'DB_NAME']);

$config = [
    'database' => [
        'host'     => getenv('DB_HOST') !== false ? getenv('DB_HOST') : 'localhost',
        'username' => getenv('DB_USER') !== false ? getenv('DB_USER') : 'root',
        'password' => getenv('DB_PASS') !== false ? getenv('DB_PASS') : '',
        'dbname'   => getenv('DB_NAME') !== false ? getenv('DB_NAME') : '',
    ],
    'socket_url' => ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http') . '://' . @$_SERVER['HTTP_HOST'] . (getenv('WS_PORT') !== false ? ':' . getenv('WS_PORT') : ''),
    'log' => [
        'dir'     => './application/logs/',
        'error'   => 'error_log_'.date('Ymd').'.log',
        'success' => 'success_log_'.date('Ymd').'.log',
    ],
    'working_hour' => [
        'start' => 1,
        'end'   => 25,
    ],
    'phpscript_dir' => './application/libraries/phpscript/',
    'ftp' => [
        'protocol'   => getenv('FT_PROTOCOL') !== false ? getenv('FT_PROTOCOL') : 'ftp',
        'encryption' => getenv('FT_ENCRYPTION') !== false ? getenv('FT_ENCRYPTION') : '',
        'host'       => getenv('FT_HOST') !== false ? getenv('FT_HOST') : '',
        'port'       => getenv('FT_PORT') !== false ? getenv('FT_PORT') : '',
        'username'   => getenv('FT_USER') !== false ? getenv('FT_USER') : '',
        'password'   => getenv('FT_PASS') !== false ? getenv('FT_PASS') : '',
        'dir'        => getenv('FT_PATH') !== false ? getenv('FT_PATH') : '/',
    ],
    'email_status' => [
        'unread'  => 7,
        'read'    => 8,
        'queued'  => 9,
        'sent'    => 10,
        'error'   => 11,
        'process' => 33,
    ],
];
