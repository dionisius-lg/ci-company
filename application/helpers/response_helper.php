<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('responseSuccess')) {
	function responseSuccess($data = [], $total = null, $paging = []) {
		$result = [
			'request_time'	=> $_SERVER['REQUEST_TIME'],
			'status'		=> 'success'
		];

		if (is_numeric($total)) {
			$result['total_data'] = $total;
		}

		$result['data'] = (is_array($data) && !empty($data)) ? $data : [];

		if (is_array($paging) && !empty($paging)) {
			$result['paging'] = $paging;
		}

		return $result;
	}
}

if (!function_exists('responseError')) {
	function responseError($message = null) {
		$result = [
			'request_time'	=> $_SERVER['REQUEST_TIME'],
			'status'		=> 'fail',
			'message'		=> 'Internal server error'
		];

		return $result;
	}
}

if (!function_exists('responseNotFound')) {
	function responseNotFound($message = null) {
		$result = [
			'request_time'	=> $_SERVER['REQUEST_TIME'],
			'status'		=> 'error',
			'message'		=> (empty($message)) ? 'Not found' : 'Not found. '.$message
		];

		return $result;
	}
}

if (!function_exists('responseNotAllowed')) {
	function responseNotAllowed($message = null) {
		$result = [
			'request_time'	=> $_SERVER['REQUEST_TIME'],
			'status'		=> 'error',
			'message'		=> (empty($message)) ? 'Not allowed' : 'Not allowed. '.$message
		];

		return $result;
	}
}

if (!function_exists('responseBadRequest')) {
	function responseBadRequest($message = null) {
		$result = [
			'request_time'	=> $_SERVER['REQUEST_TIME'],
			'status'		=> 'error',
			'message'		=> (empty($message)) ? 'Bad request' : 'Bad request. '.$message
		];

		return $result;
	}
}

if (!function_exists('responseUnauthorized')) {
	function responseUnauthorized($message = null) {
		$result = [
			'request_time'	=> $_SERVER['REQUEST_TIME'],
			'status'		=> 'error',
			'message'		=> (empty($message)) ? 'Unauthorized' : 'Unauthorized. '.$message
		];

		return $result;
	}
}

if (!function_exists('responseForbidden')) {
	function responseForbidden($message = null) {
		$result = [
			'request_time'	=> $_SERVER['REQUEST_TIME'],
			'status'		=> 'error',
			'message'		=> (empty($message)) ? 'Forbidden' : 'Forbidden. '.$message
		];

		return $result;
	}
}
