<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		// set timezone
		date_default_timezone_set('Asia/Jakarta');

		// set site languange
		$this->config->set_item('language', siteLang()['name']);

		// set template layout
		$this->template->set_template('layouts/front');

		// load default models
		$this->load->model('CompanyModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->get()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->get()['data'];
		}
	}

	/**
	 *  index method
	 *  index page
	 */
	public function index()
	{
		$session = $this->session->userdata('AuthUser');

		$this->template->content->view('templates/front/Contact/index', $this->result);
		$this->template->publish();
	}

	public function sendEmail() {
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_user' => 'arj.juta@gmail.com',
			'smtp_pass' => 'Ironman3!',
			'smtp_crypto' => 'ssl',
			'smtp_port'   => 465,
			'crlf'    => "\r\n",
			'newline' => "\r\n"	
		];
		
		$this->load->library('email', $config);
		$this->email->initialize($config);

		$to_email = $config['smtp_user'];
		$contact_name = $this->input->post('contact_name');
		$from_email = $this->input->post('contact_email');
		$subject = $this->input->post('contact_subject');
		$message = $this->input->post('contact_message');

		$this->email->from($from_email, $contact_name);
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			echo "<script> alert('Your message has been sent. Thank you!')</script>";
			$this->template->content->view('templates/front/Contact/index', $this->result);
			$this->template->publish();
		} else {
			echo "<script> alert('Message failed to send !')</script>";
			$this->template->content->view('templates/front/Contact/index', $this->result);
			$this->template->publish();
		}
	}
}
