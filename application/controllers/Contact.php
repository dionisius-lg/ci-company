<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		setReferrer(current_url());

		sitelang();
		$this->config->set_item('language', sitelang());

		$this->template->set_template('layouts/front');

		$this->load->model('CompanyModel');
	}

	public function index()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		$request = [
			'company' => $this->CompanyModel->getDetail(),
		];

		foreach ($request as $key => $val) {
			$result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$result[$key] = $val['data'];
				}
			}
		}

		if (sitelang() == 'english') {
			$this->template->title = 'Contact Us';
		} else {
			$this->template->title = 'Hubungi Kami';
		}

		$this->template->content->view('templates/front/contact', $result);
		$this->template->publish();
	}
}
