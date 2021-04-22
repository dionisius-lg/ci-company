<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Composer autoload
require FCPATH.'/vendor/autoload.php';

use ElephantIO\Client as Elephant;
use ElephantIO\Engine\SocketIO\Version2X;

if (!function_exists('socketEmit')) {
	function socketEmit($event = false, $data = [], $nameserver = false, $namespace = false) {
		if ($event) {
			if (is_array($data)) {
				$server = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") . "://" . @$_SERVER['HTTP_HOST'] . ":62001";

				$socket_server = ($nameserver) ? $nameserver : $server;
				$parse = parse_url($socket_server);

				if (!array_key_exists('host', $parse) || !array_key_exists('port', $parse)) {
					return false;
				}

				$client = new Elephant(new Version2X($socket_server));
				$client->initialize();
				if ($namespace) $client->of('/' . $namespace);
				$client->emit($event, $data);
				$client->close();

				return true;
			}
		}

		return false;
	}
}
