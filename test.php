<?php
$server = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") . "://socket." . @$_SERVER['HTTP_HOST'];

echo $server;

?>