<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		setReferrer(current_url());

		sitelang();
		$this->config->set_item('language', sitelang());

		// if (!$this->session->has_userdata('site_lang')) {
		// 	$this->session->set_userdata('site_lang', 'english');
		// }

		// $this->config->set_item('language', $this->session->userdata('site_lang'));

		// if (!$this->session->has_userdata('AuthUser')) {
		// 	setFlashError('Please login first', 'auth');
		// 	redirect('auth');
		// }

		// if ($this->session->userdata('AuthUser')['user_level_id'] != 1) {
		// 	hasReferrer() == true ? redirect(Referrer(), 'refresh') : redirect(base_url(), 'refresh');
		// }
		
		$this->template->set_template('layouts/front');

		// $this->load->library('user_agent');

		$this->load->model('CompanyModel');
	}

	public function index()
	{
/*
		// Set the title
		$this->template->title = 'Welcome!';
		
		// Dynamically add a css stylesheet
		$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');
		
		// Load a view in the content partial
		$this->template->content->view('hero', array('title' => 'Hello, world!'));

		$news = array(); // load from model (but using a dummy array here)
		$this->template->content->view('news', $news);
		
		// Set a partial's content
		$this->template->footer = 'Made with Twitter Bootstrap';
		
		// Publish the template
		$this->template->publish();
*/

		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		$this->load->model('SlidersModel');
		$this->load->model('CompanyAdvantagesModel');

		$request = [
			'company' => $this->CompanyModel->getDetail(),
			'advantages' => $this->CompanyAdvantagesModel->getAll(['limit' => 12]),
			'sliders' => $this->SlidersModel->getAll(['limit' => 10, 'order' => 'order_number', 'sort' => 'asc']),
		];

		foreach ($request as $key => $val) {
			$result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$result[$key] = $val['data'];
				}
			}
		}

		$this->template->content->view('templates/front/home', $result);

		$this->template->publish();
	}
}
