<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		/*--- load library & helper -------------*/
		$this->load->library('form_validation');
		$this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
		$this->load->helper('security');
		/*--- load model ------------------------*/
		$this->load->model('admin_m');
	}

	function index() {
        $this->load->view('error404_v');
	}

	function admin() {
		$data = array(
			'style' => 'style.css',
			'form_action' => base_url('auth/login/admin'),
		);
		$this->load->view('login_v',$data);
	}
	
	function login($user) {
		$username = trim($this->input->post('username'));
		$password = trim(xss_clean($this->input->post('password')));
		$error = '<div class="alert alert-warning" role="alert">
				  <button class="close" type="button"  title="Tutup" data-dismiss="alert" aria-label="Close">
				  <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
				  </button>
				  <strong>Error!</strong>&nbsp;';
		if($user == 'admin') {
			$check = $this->admin_m->get_check_login($username,md5($password))->num_rows();
			if ($check > 0) {
				$data_user = $this->admin_m->get_check_login($username,md5($password))->row();
				$data = array(
					'logged_id' => $data_user->admin_id,
					'logged_name' => $data_user->firstname,
					'logged_avatar' => $data_user->photo
				);
				$this->session->set_userdata($data);
				redirect(site_url($user));
			} else {
				$error .= 'Invalid Username or Password';
				$this->session->set_flashdata('error',$error);
				redirect(base_url('auth/'.$user));
			}
		} elseif($user == 'siswa') {
			$check = $this->siswa_m->get_check_login($username,md5($password))->num_rows();
			if ($check == 1) {
				$data_user = $this->siswa_m->get_check_login($username,md5($password))->row();
				$data = array(
					'logged_'.$user.'_id' => $data_user->nis,
					'logged_'.$user.'_name' => $data_user->nam_siswa,
					'logged_'.$user.'_image' => $data_user->gbr_siswa
				);
				$this->session->set_userdata($data);
				redirect(site_url($user));
			} else {
				$error .= 'NIS / password salah.</div>';
				$this->session->set_flashdata('error',$error);
				redirect(base_url('auth/'.$user));
			}
		} elseif($user == 'guru') {
			$check = $this->guru_m->get_check_login($username,md5($password))->num_rows();
			if ($check == 1) {
				$data_user = $this->guru_m->get_check_login($username,md5($password))->row();
				$data = array(
					'logged_'.$user.'_id' => $data_user->nuptk,
					'logged_'.$user.'_name' => $data_user->nam_guru,
					'logged_'.$user.'_image' => $data_user->gbr_guru
				);
				$this->session->set_userdata($data);
				redirect(site_url($user));
			} else {
				$error .= 'NUPTK / password salah.</div>';
				$this->session->set_flashdata('error',$error);
				redirect(base_url('auth/'.$user));
			}
		} else {
			$this->index();
		}
	}

	function logout($user) {
		$data = array(
			'logged_'.$user.'_id',
			'logged_'.$user.'_name',
			'logged_'.$user.'_image'
		);
		$this->session->unset_userdata($data);
		//$this->session->sess_destroy();
		redirect(site_url('auth/'.$user));
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */