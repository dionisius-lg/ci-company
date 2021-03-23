<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	 
if (!function_exists('dateIndo')) {
	function dateIndo($tanggal) {
		$tanggal	= gmdate($tanggal, time()+60*60*8);
		$split		= explode('-', $tanggal);
		$date		= $split[2];
		$month		= monthIndo($split[1]);
		$year		= $split[0];
		return		$date . ' ' . $month . ' ' . $year;
	}
}

if (!function_exists('dateIndoShort')) {
	function dateIndoShort($tanggal) {
		$tanggal	= gmdate($tanggal, time()+60*60*8);
		$split		= explode('-', $tanggal);
		$date		= $split[2];
		$month		= monthIndoShort($split[1]);
		$year		= $split[0];
		return		$date . ' ' . $month . ' ' . $year;
	}
}
	
if (!function_exists('dateIndoLong')) {
	function dateIndoLong($tanggal) {
		$tanggal	= gmdate($tanggal, time()+60*60*8);
		$split		= explode('-', $tanggal);
		$date		= $split[2];
		$month		= $split[1];
		$year		= $split[0];
		$get_day	= date('l', mktime(0, 0, 0, $date, $month, $year));
		return		dayIndo($get_day) . ', ' . $date . ' ' . monthIndo($month) . ' ' . $year;
	}
}

if (!function_exists('monthIndo')) {
	function monthIndo($bulan) {
		switch ($bulan) {
			case 1:
				return 'Januari';
				break;
			case 2:
				return 'Februari';
				break;
			case 3:
				return 'Maret';
				break;
			case 4:
				return 'April';
				break;
			case 5:
				return 'Mei';
				break;
			case 6:
				return 'Juni';
				break;
			case 7:
				return 'Juli';
				break;
			case 8:
				return 'Agustus';
				break;
			case 9:
				return 'September';
				break;
			case 10:
				return 'Oktober';
				break;
			case 11:
				return 'November';
				break;
			case 12:
				return 'Desember';
				break;
			default:
				return $bulan;
		}
	}
}

if (!function_exists('monthIndoShort')) {
	function monthIndoShort($bulan) {
		switch ($bulan) {
			case 1:
				return 'Jan';
				break;
			case 2:
				return 'Feb';
				break;
			case 3:
				return 'Mar';
				break;
			case 4:
				return 'Apr';
				break;
			case 5:
				return 'Mei';
				break;
			case 6:
				return 'Jun';
				break;
			case 7:
				return 'Jul';
				break;
			case 8:
				return 'Ags';
				break;
			case 9:
				return 'Sep';
				break;
			case 10:
				return 'Okt';
				break;
			case 11:
				return 'Nov';
				break;
			case 12:
				return 'Des';
				break;
			default:
				return $bulan;
		}
	}
}

if (!function_exists('dayIndo')) {
	function dayIndo($hari) {
		switch ($hari) {
			case 'Sunday':
				return 'Minggu';
				break;
			case 'Monday':
				return 'Senin';
				break;
			case 'Tuesday':
				return 'Selasa';
				break;
			case 'Wednesday':
				return 'Rabu';
				break;
			case 'Thursday':
				return 'Kamis';
				break;
			case 'Friday':
				return 'Jumat';
				break;
			case 'Saturday':
				return 'Sabtu';
				break;
			default:
				return $hari;
		}
	}
}