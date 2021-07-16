<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('strClean')) {
	function strClean($str) {
		// return htmlentities(trim($str), ENT_QUOTES, 'UTF-8');
		return addslashes(htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8'));
	}
}

if (!function_exists('unStrClean')) {
	function unStrClean($str) {
		return stripslashes(html_entity_decode($str, ENT_QUOTES, 'UTF-8'));
	}
}

if (!function_exists('nl2space')) {
	function nl2space($str) {
		return preg_replace('/\s+/', ' ', trim($str));
	}
}

if (!function_exists('base64url_encode')) {
	function base64url_encode($str) {
		// kalo php 5 ajg dia jalan

		// if ($str) {
		// 	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		// 	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		// 	$mcrypt_encrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, '**dionisius_lg**', $str, MCRYPT_MODE_ECB, $iv);
		// 	$base64_encode = strtr(base64_encode($mcrypt_encrypt), '+/', '-_');

		// 	return rtrim($base64_encode, '=');
		// }

		// return false;
		return str_replace('=', '', base64_encode('ptarj.com' . $str)); // ini buat php ver brapapun bisa
	}
}

if (!function_exists('base64url_decode')) {
	function base64url_decode($str) {
		// kalo php 5 ajg dia jalan

		// if ($str) {
		// 	$base64_decode = base64_decode(str_pad(strtr($str, '-_', '+/'), strlen($str) % 4, '=', STR_PAD_RIGHT));
		// 	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		// 	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		// 	$mcrypt_decrypt = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, '**dionisius_lg**', $base64_decode, MCRYPT_MODE_ECB, $iv);

		// 	return trim($mcrypt_decrypt);
		// }

		// return false;
		return str_replace('ptarj.com', '', base64_decode($str . "=")); // ini buat php ver brapapun bisa
	}
}

if (!function_exists('strRandom')) {
	function strRandom($length = '') {
		if (is_numeric($length)) {
			$result    = "";
			$chars     = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$charArray = str_split($chars);

			for ($i = 0; $i < $length; $i++) {
				$randItem = array_rand($charArray);
				$result  .= "". $charArray[$randItem];
			}

			return $result;
		}
		
		return false;
	}
}

// if (!function_exists('sitelang')) {
// 	function sitelang($lang = null) {
// 		$ci = &get_instance();
// 		$ci->load->library('session');
// 		$ci->load->helper('language');

// 		$allowed_lang = [
// 			'english',
// 			'indonesian',
// 			'japanese',
// 			'korean',
// 			'mandarin'
// 		];

// 		if (!empty($lang) && in_array($lang, $allowed_lang)) {
// 			$ci->session->set_userdata('SiteLang', $lang);
// 		} else {
//             if (!$ci->session->has_userdata('SiteLang')) {
//                 $ci->session->set_userdata('SiteLang', $allowed_lang['0']);
//             }
// 		}

// 		$ci->lang->load('content', $ci->session->userdata('SiteLang'));

// 		return $ci->session->userdata('SiteLang');
// 	}
// }

if (!function_exists('siteLang')) {
	function siteLang($key = 0) {
		$ci = &get_instance();
		$ci->load->library('session');
		$ci->load->helper('language');

		$lang = [
			'en' => [
				'key'    => 'en',
				'name'  => 'english',
				'alias' => 'english'
			],
			'id' => [
				'key'    => 'id',
				'name'  => 'indonesian',
				'alias' => 'bahasa'
			],
			'ja' => [
				'key'    => 'ja',
				'name'  => 'japanese',
				'alias' => '日本語'
			],
			'ko' => [
				'key'    => 'ko',
				'name'  => 'korean',
				'alias' => '한국어'
			],
			'zh-TW' => [
				'key'    => 'zh-TW',
				'name'  => 'mandarin',
				'alias' => '繁體中文'
			],
			'zh-TW' => [
				'key'    => 'zh-TW',
				'name'  => 'mandarin',
				'alias' => '繁體中文'
			],
		];

		if (!empty($key) && array_key_exists($key, $lang)) {
			$ci->session->set_userdata('SiteLang', $lang[$key]);
		} else {
			if (!$ci->session->has_userdata('SiteLang')) {
                $ci->session->set_userdata('SiteLang', $lang['en']);
            }
		}

		// $ci->lang->load('content', $ci->session->userdata('SiteLang')['name']);

		return $ci->session->userdata('SiteLang');
	}
}

if (!function_exists('bs4pagination')) {
	function bs4pagination($url = null, $total = 0, $limit = 0, $params = []) {
		$ci = &get_instance();
		$ci->load->library('pagination');

		$base_url	= base_url($url);
		$suffix		= [];

		if (is_array($params)) {
			if (count($params) > 0) {
				foreach ($params as $key => $val) {
					if (!empty($val) && $key != 'page') {
						$suffix[] = $key . '=' . $val;
					}
				}
			}
		}

		if (count($suffix) > 0) {
			$base_url .= '?' . implode(addslashes('&'), $suffix);
		}

		$config = [
			'full_tag_open'			=> '<ul class="pagination pagination-ci3-bs4">',
			'full_tag_close'		=> '</ul>',
			'num_tag_open'			=> '<li class="page-item">',
			'num_tag_close'			=> '</li>',
			'cur_tag_open'			=> '<li class="page-item active"><span>',
			'cur_tag_close'			=> '</span></li>',
			'next_tag_open'			=> '<li class="page-item">',
			'next_tagl_close'		=> '</li>',
			'prev_tag_open'			=> '<li class="page-item">',
			'prev_tagl_close'		=> '</li>',
			'first_tag_open'		=> '<li><li class="page-item">',
			'first_tagl_close'		=> '</li>',
			'last_tag_open'			=> '<li class="page-item">',
			'last_tagl_close'		=> '</li>',
			'prev_link'				=> 'Prev',
			'next_link'				=> 'Next',
			'first_link'			=> 'First',
			'last_link'				=> 'Last',

			'base_url'				=> $base_url,
			'total_rows'			=> $total,
			'per_page'				=> !empty($limit) ? $limit : 20,
			'page_query_string'		=> true,
			'use_page_numbers'		=> true,
			'query_string_segment'	=> 'page'
		];

		$ci->pagination->initialize($config);

		return $ci->pagination->create_links();
	}
}

if (!function_exists('slugify')) {
	function slugify($str = false, $table = null, $except = []) {
		$ci = &get_instance();
		$i = 0;
		$conditions = [];

		if ($str) {
			$slug = url_title($str);
			$slug = strtolower($slug);

			if ($table) {
				$conditions['slug'] = $slug;

				if (!empty($except) && is_array($except)) {
					foreach ($except as $key => $val) {
						$conditions[$key . ' !='] = $val;
					}
				}

				$query = $ci->db->where($conditions)->get($table);

				while ($query->num_rows()) {
					if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
						$slug .= '-' . ++$i;
					} else {
						$slug = preg_replace('/[0-9]+$/', ++$i, $slug);
					}

					$conditions['slug'] = $slug;
				}
			}

			return $slug;
		}

		return false;
	}
}
