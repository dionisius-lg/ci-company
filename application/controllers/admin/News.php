<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->template->set_template('layouts/back');
		/*if(!$this->session->userdata('logged_id')) {
			// jika belum login redirect ke login
			redirect(site_url('auth/admin'));
		}*/
		/*--- load model -----------------------------------*/
		/*$this->load->model('admin_m');
		$this->load->model('news_m');
		$this->load->model('about_m');
		$this->load->model('academic_m');
		$this->load->model('log_m');*/
	}
	
	function index() {
		$this->template->content->view('templates/back/home/dashboard');

		$this->template->publish();
	}

	function dashboard() {
		if($this->session->userdata('logged_avatar') != 'null') {
			$user_image = $this->session->userdata('logged_avatar');
		} else {
			$user_image = 'default-avatar.jpg';
		}
		$data = array(
			'user_image' => base_url('files/img/'.$user_image),
			'user_thumbnail' => base_url('files/thumb/'.$user_image)
		);
		$this->load->view('admin/dashboard_v',$data);
	}

/*--- profil -------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------------*/

	function profile() {
		$data_user = $this->admin_m->get_id($this->session->userdata('logged_id'))->row();
		if($this->session->userdata('logged_avatar') != 'null') {
			$avatar = $this->session->userdata('logged_avatar');
		} else {
			$avatar = 'default-avatar.jpg';
		}
		$data = array(
			'user_img' => base_url('files/img/'.$avatar),
			'user_thumb' => base_url('files/thumb/'.$avatar),
			'data_user' => $data_user,
			'tgl' => date('Y-m-d H:i:s')
		);

		$this->load->view('admin/profile_v',$data);
	}

	function profile_edit() {
		$data = $this->admin_m->get_id($this->session->userdata('logged_id'))->row();
		echo json_encode($data);
	}

	private function profile_valid() {
		$data = array();
		$data['error_input'] = array();
		$data['error_string'] = array();
		$data['status'] = true;
		if(!preg_match('/^[a-zA-Z ]{3,35}$/',trim($this->input->post('firstname')))) {
			$data['error_input'][] = 'firstname';
			$data['error_string'][] = 'Nama min 3 max 35 alfabet.';
			$data['status'] = false;
		}
		if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',trim($this->input->post('username')))) {
			$data['error_input'][] = 'username';
			$data['error_string'][] = 'Username min 3 max 35 alfabet atau angka.';
			$data['status'] = false;
		}
		if(trim($this->input->post('gender')) == '') {
			$data['error_input'][] = 'gender';
			$data['error_string'][] = 'Jenis kelamin belum dipilih.';
			$data['status'] = false;
		}
		if(!preg_match('/^[a-zA-Z ]{3,20}$/',trim($this->input->post('birthplace')))) {
			$data['error_input'][] = 'birthplace';
			$data['error_string'][] = 'Tempat lahir min 3 max 20 alfabet.';
			$data['status'] = false;
		}
		if(!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',trim($this->input->post('birthdate')))) {
			$data['error_input'][] = 'birthdate';
			$data['error_string'][] = 'Tanggal lahir tidak valid.';
			$data['status'] = false;
		}
		if(!preg_match('/^[a-zA-Z0-9 -.,]{10,120}$/',trim($this->input->post('address')))) {
			$data['error_input'][] = 'address';
			$data['error_string'][] = 'Alamat min 10 max 120 alfabet, angka, titik atau koma.';
			$data['status'] = false;
		}
		if(!preg_match('/^[a-zA-Z ]{3,20}$/',trim($this->input->post('city')))) {
			$data['error_input'][] = 'city';
			$data['error_string'][] = 'Kota alamat max 3 min 20 alfabet.';
			$data['status'] = false;
		}
		if(!preg_match('/^[0-9]{0,16}$/',trim($this->input->post('phone')))) {
			$data['error_input'][] = 'phone';
			$data['error_string'][] = 'Nomor telepon max 16 angka (kosongkan bila tidak perlu).';
			$data['status'] = false;
		}
		if($data['status'] === false) {
			echo json_encode($data);
			exit();
		}
	}

	function profile_update() {
		$this->profile_valid();
		$where = array(
			'admin_id' => $this->session->userdata('logged_id')
		);
		$data = array(
			'firstname' => $this->security->xss_clean(trim($this->input->post('firstname'))),
			'lastname' => $this->security->xss_clean(trim($this->input->post('lastname'))),
			'gender' => $this->security->xss_clean(trim($this->input->post('gender'))),
			'birthplace' => $this->security->xss_clean(trim($this->input->post('birthplace'))),
			'birthdate' => $this->security->xss_clean(trim($this->input->post('birthdate'))),
			'address' => $this->security->xss_clean(trim($this->input->post('address'))),
			'city' => $this->security->xss_clean(trim($this->input->post('city'))),
			'phone' => $this->security->xss_clean(trim($this->input->post('phone'))),
			'username' => $this->security->xss_clean(trim($this->input->post('username')))
		);
		$this->admin_m->get_update($where,$data);
		$result = $this->admin_m->get_id($this->session->userdata('logged_id'))->row();
		$this->session->set_userdata(array('logged_name' => $result->firstname));
		echo json_encode(array('status' => true, 'result' => $result));
	}

	function profile_update_password() {
		$respon = array('status' => false, 'error' => array());
		$valid_password = array(
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|xss_clean|min_length[3]|max_length[10]|alpha_numeric',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
					'min_length' => '%s min 3 karakter.',
					'max_length' => '%s max 10 karakter.',
					'alpha_numeric' => '%s hanya boleh alfabet angka tanpa spasi.',
				)
            ),
            array(
                'field' => 'password_confirm',
                'label' => 'Konfirmasi Password',
                'rules' => 'trim|required|xss_clean|matches[password]',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
					'matches' => '%s tidak cocok.',
				)
            )
        );

		$this->form_validation->set_rules($valid_password);
		$this->form_validation->set_error_delimiters('','');
		if ($this->form_validation->run() == false ) {
			foreach ($_POST as $key => $value) {
				$respon['error'][$key] = form_error($key);
			}
		} else {
			$where = array(
				'admin_id' => $this->session->userdata('logged_id')
			);
			$data = array(
				'password' => md5($this->input->post('password'))
			);
			$this->admin_m->get_update($where,$data);
			$respon['status'] = true;
		}
		echo json_encode($respon);
	}

	function profile_upload_photo() {
		$row_user = $this->admin_m->get_id($this->session->userdata('logged_id'))->row();
		if($row_user->photo != 'null') {
			$photo_old = $row_user->photo;
		} else {
			$photo_old = 'default-avatar.jpg';
		}
		$url_img = base_url('files/img').'/';
		$dir_img = './files/img/';
		if(!is_dir($dir_img)) {
			mkdir($dir_img);
		}
		$url_thumb = base_url('files/thumb').'/';
		$dir_thumb = './files/thumb/';
		if(!is_dir($dir_thumb)) {
			mkdir($dir_thumb);
		}
		$config_upload = array(
			'upload_path' => $dir_img,
			'allowed_types' => 'gif|jpg|png',
			'max_size' => '150',
			'max_width' => '1024',
			'max_height' => '768',
			'file_name' => 'admin_'.time()
		);
		$this->load->library('upload', $config_upload);
		if (!$this->upload->do_upload('upload_photo')) {
			$respon = array(
				'status' => false,
				'img' => $url_img.$photo_old,
				'thumb' => $url_thumb.$photo_old,
				'error' => $this->upload->display_errors('','')
			);
		} else {
			$upload_data = $this->upload->data();
			$photo_new = $upload_data['file_name'];
			$respon = array(
				'status' => true,
				'img' => $url_img.$photo_new,
				'thumb' => $url_thumb.$photo_new
			);
			$config_resize = array(
				'image_library' => 'gd2',
				'source_image' => $upload_data['full_path'],
				'new_image' => $dir_thumb,
				'maintain_ratio' => true,
				'width' => 180,
				'height' => 180
			);
			$this->load->library('image_lib', $config_resize);
			$this->image_lib->resize();
			$where = array(
				'admin_id' => $this->session->userdata('logged_id')
			);
			$data = array(
				'photo' => $photo_new
			);
			$this->admin_m->get_update($where,$data);
			if($photo_old != 'default-avatar.jpg') {
				unlink($dir_img.$photo_old);
				unlink($dir_thumb.$photo_old);
			}
			$this->session->set_userdata(array('logged_avatar' => $photo_new));
		}
		echo json_encode($respon);
	}

	function profile_unload_photo() {
		$url_img = base_url('files/img').'/';
		$dir_img = './files/img/';
		$url_thumb = base_url('files/thumb').'/';
		$dir_thumb = './files/thumb/';
		$row_user = $this->admin_m->get_id($this->session->userdata('logged_id'))->row();
		unlink($dir_img.$row_user->photo);
		unlink($dir_thumb.$row_user->photo);
		$where = array(
			'admin_id' => $row_user->admin_id
		);
		$data = array(
			'photo' => 'null'
		);
		$this->admin_m->get_update($where,$data);
		$respon = array(
			'status' => true,
			'img' => $url_img.'default-avatar.jpg',
			'thumb' => $url_thumb.'default-avatar.jpg'
		);
		$this->session->set_userdata(array('logged_avatar' => 'null'));
		echo json_encode($respon);
	}

/*--- function news -------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/

	function news() {
		if($this->session->userdata('logged_avatar') != 'null') {
			$avatar = $this->session->userdata('logged_avatar');
		} else {
			$avatar = 'default-avatar.jpg';
		}
		$data = array(
			'user_thumb' => base_url('files/thumb/'.$avatar),
		);
		$this->load->view('admin/news_list_v',$data);
	}

	function news_list() {
		$list = $this->news_m->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $col) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $col->title;
			$row[] = strip_tags(stripslashes(substr($col->content,0,100)))."...";
			$row[] = $col->image;
			$row[] = $col->createdate;
			$row[] = $col->firstname;
			$row[] = '<div class="text-center row">
					  <a href="javascript:void(0)" class="btn btn-xs btn-warning" title="Ubah Data" onclick="data_edit('."'".$col->news_id."'".')"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					  <a href="javascript:void(0)" class="btn btn-xs btn-danger" title="Hapus Data" onclick="data_delete('."'".$col->news_id."'".')"><i class="fa fa-trash" aria-hidden="true"></i></a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->news_m->count_all(),
			"recordsFiltered" => $this->news_m->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	private $upload_errors = array();

	function check_upload_news($str) {
		if(isset($this->upload_errors['image'])) {
			$this->form_validation->set_message('check_upload_news', $this->upload_errors['image']);
			return false;
		}
		return true;
	}

	function custom_alpha($str) {
        if (!preg_match('/^[a-z0-9 .,\-\/\(\)\&]+$/i',$str)) {
            $this->form_validation->set_message('custom_alpha', 'Penulisan %s tidak valid.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

	function news_add() {
		if($this->session->userdata('logged_avatar') != 'null') {
			$user_image = $this->session->userdata('logged_avatar');
		} else {
			$user_image = 'default-avatar.jpg';
		}
		$data = array(
			'user_image' => base_url('files/img/'.$user_image),
			'user_thumbnail' => base_url('files/thumb/'.$user_image),
		);
		$this->load->view('admin/news_add_v',$data);
	}

	function news_create() {
		$img_dir = './files/img/';
		if(!is_dir($img_dir)) {
			mkdir($img_dir);
		}
		$thumb_dir = './files/thumb/';
		if(!is_dir($thumb_dir)) {
			mkdir($thumb_dir);
		}
		if(!empty($_FILES['image']['name'])) {
			$config_upload = array(
				'upload_path' => $img_dir,
				'allowed_types' => 'jpg|jpeg|png',
				'max_size' => '200',
				'max_width' => '1024',
				'max_height' => '614',
				'file_name' => 'news_'.time()
			);
			$this->load->library('upload', $config_upload);
			if ($this->upload->do_upload('image')) {
				$upload_data = $this->upload->data();
			} else {
				$this->upload_errors['image'] = $this->upload->display_errors('','');
				$upload_data = 'null';
			}
		} else {
			$this->upload_errors['image'] = 'Gambar berita tidak boleh kosong';
			$upload_data = 'null';
		}
		$news_valid = array(
            array(
				'field' => 'title',
				'label' => 'Judul',
				'rules' => 'trim|xss_clean|required|callback_custom_alpha|max_length[200]',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
					'max_length' => '%s max 200 karakter.',
				)
            ),
			array(
				'field' => 'content',
				'label' => 'Kontent',
				'rules' => 'trim'
			),
			array(
				'field' => 'image',
				'label' => 'Gambar',
				'rules' => 'trim|xss_clean|callback_check_upload_news'
			)
		);
		$this->form_validation->set_rules($news_valid);
		$this->form_validation->set_error_delimiters('','');
		$respon = array('status' => false, 'error' => array());
		if($this->form_validation->run() == false) {
			if($upload_data != 'null') {
				unlink($img_dir.$upload_data['file_name']);
			}
			$array_errors = array(
				'title' => form_error('title'),
				'content' => form_error('content'),
				'image' => form_error('image'),
			);
			foreach ($array_errors as $key => $value) {
				$respon['error'][$key] = form_error($key);
			}
        } else {
			$data = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'image' => $upload_data['file_name'],
				'createdate' => date('Y-m-d H:i:s'),
				'admin_id' => $this->session->userdata('logged_id')
			);
			$config_resize = array(
				'image_library' => 'gd2',
				'source_image' => $upload_data['full_path'],
				'new_image' => $thumb_dir,
				'maintain_ratio' => true,
				'width' => 200,
				'height' => 200
			);
			$this->load->library('image_lib', $config_resize);
			$this->image_lib->resize();
			$this->news_m->get_insert($data);
			$respon['status'] = true;
		}
		echo json_encode($respon);
	}

	function news_edit($id) {
		if($this->session->userdata('logged_avatar') != 'null') {
			$user_image = $this->session->userdata('logged_avatar');
		} else {
			$user_image = 'default-avatar.jpg';
		}
		$data = array(
			'user_image' => base_url('files/img/'.$user_image),
			'user_thumbnail' => base_url('files/thumb/'.$user_image),
			'data_news' => $this->news_m->get_id_cust($id)->row(),
		);
		$this->load->view('admin/news_edit_v',$data);
	}

	function news_update() {
		$data_news = $this->news_m->get_id_cust($this->input->post('id'))->row();
		$img_dir = './files/img/';
		if(!is_dir($img_dir)) {
			mkdir($img_dir);
		}
		$thumb_dir = './files/thumb/';
		if(!is_dir($thumb_dir)) {
			mkdir($thumb_dir);
		}
		if(!empty($_FILES['image']['name'])) {
			$config_upload = array(
				'upload_path' => $img_dir,
				'allowed_types' => 'jpg|jpeg|png',
				'max_size' => '200',
				'max_width' => '1024',
				'max_height' => '614',
				'file_name' => 'news_'.time()
			);
			$this->load->library('upload', $config_upload);
			if ($this->upload->do_upload('image')) {
				$upload_data = $this->upload->data();
				$img_name = $upload_data['file_name'];
			} else {
				$this->upload_errors['image'] = $this->upload->display_errors('','');
				$img_name = $data_news->image;
			}
		} else {
			$img_name = $data_news->image;
		}
		$news_valid = array(
            array(
				'field' => 'title',
				'label' => 'Judul',
				'rules' => 'trim|xss_clean|required|callback_custom_alpha|max_length[200]',
				'errors' => array(
					'required' => '%s tidak boleh kosong.',
					'max_length' => '%s max 200 karakter.',
				)
            ),
			array(
				'field' => 'content',
				'label' => 'Kontent',
				'rules' => 'trim'
			),
			array(
				'field' => 'image',
				'label' => 'Gambar',
				'rules' => 'trim|xss_clean|callback_check_upload_news'
			)
		);
		$this->form_validation->set_rules($news_valid);
		$this->form_validation->set_error_delimiters('','');
		$respon = array('status' => false, 'error' => array());
		if($this->form_validation->run() == false) {
			if($img_name != $data_news->image) {
				unlink($img_dir.$img_name);
			}
			$array_errors = array(
				'title' => form_error('title'),
				'content' => form_error('content'),
				'image' => form_error('image'),
			);
			foreach ($array_errors as $key => $value) {
				$respon['error'][$key] = form_error($key);
			}
        } else {
			$id = array(
				'news_id' => $data_news->news_id
			);
			$data = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'image' => $img_name,
				'admin_id' => $this->session->userdata('logged_id')
			);
			if($img_name != $data_news->image) {
				unlink($img_dir.$data_news->image);
				unlink($thumb_dir.$data_news->image);
				$config_resize = array(
					'image_library' => 'gd2',
					'source_image' => $upload_data['full_path'],
					'new_image' => $thumb_dir,
					'maintain_ratio' => true,
					'width' => 200,
					'height' => 200
				);
				$this->load->library('image_lib', $config_resize);
				$this->image_lib->resize();
			}
			$this->news_m->get_update($id,$data);
			$respon['status'] = true;
		}
		echo json_encode($respon);
	}

	function news_delete($id) {
		$data_news = $this->news_m->get_id_cust($id)->row();
		$img_dir = './files/img/';
		$thumb_dir = './files/thumb/';
		unlink($img_dir.$data_news->image);
		unlink($thumb_dir.$data_news->image);
		$this->news_m->get_delete($id);
		echo json_encode(array('status' => true));
	}

/*--- function about ------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/

	function about($param) {
		$data_about = $this->about_m->get_label($param,'ind')->row();
		if($this->session->userdata('logged_avatar') != 'null') {
			$user_image = $this->session->userdata('logged_avatar');
		} else {
			$user_image = 'default-avatar.jpg';
		}
		$data = array(
			'user_image' => base_url('files/img/'.$user_image),
			'user_thumbnail' => base_url('files/thumb/'.$user_image),
			'data_id' => $data_about->id,
			'data_content' => $data_about->content,
			'data_label' => ucwords($data_about->label),
			'data_submit' => base_url('admin/about_update/'.$param),
		);
		$this->load->view('admin/about_v',$data);
	}

	function about_update($param) {
		$data_about = $this->about_m->get_label($param,'ind')->row();
		$about_valid = array(
			array(
				'field' => 'content',
				'label' => 'Konten',
				'rules' => 'trim'
			)
		);
		$this->form_validation->set_rules($about_valid);
		$this->form_validation->set_error_delimiters('','');
		$respon = array('status' => false, 'error' => array());
		if($this->form_validation->run() == false) {
			$array_errors = array(
				'content' => form_error('content')
			);
			foreach ($array_errors as $key => $value) {
				$respon['error'][$key] = form_error($key);
			}
        } else {
			$id = array(
				'about_id' => $data_about->id
			);
			$data = array(
				'content' => $this->input->post('content'),
				'createdate' => date('Y-m-d H:i:s'),
				'admin_id' => $this->session->userdata('logged_id')
			);
			$this->about_m->get_update($id,$data);
			$respon['status'] = true;
		}
		echo json_encode($respon);
	}

/*--- function academic - faculty -----------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/

	function faculty() {
		if($this->session->userdata('logged_avatar') != 'null') {
			$avatar = $this->session->userdata('logged_avatar');
		} else {
			$avatar = 'default-avatar.jpg';
		}
		$data = array(
			'user_thumb' => base_url('files/thumb/'.$avatar),
		);
		$this->load->view('admin/faculty_list_v',$data);
	}

	function faculty_list() {
		$list = $this->academic_m->get_dt('faculty');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $col) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucwords($col->fac_name_ind);
			$row[] = ucwords($col->fac_name_eng);
			$row[] = strip_tags(stripslashes(substr($col->fac_descript,0,50)))."...";
			$row[] = date('d M Y H:i:s', strtotime($col->fac_timestamp));
			$row[] = ucwords($col->adm_firstname.' '.$col->adm_lastname);
			$row[] = '<div class="text-center row">
					  <a href="javascript:void(0)" class="btn btn-xs btn-warning" title="Ubah Data" onclick="data_edit('."'".$col->fac_id."'".')"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					  <a href="javascript:void(0)" class="btn btn-xs btn-danger" title="Hapus Data" onclick="data_delete('."'".$col->fac_id."'".')"><i class="fa fa-trash" aria-hidden="true"></i></a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->academic_m->count_all('faculty'),
			"recordsFiltered" => $this->academic_m->count_filtered('faculty'),
			"data" => $data,
		);
		echo json_encode($output);
	}

	function faculty_add() {
		if($this->session->userdata('logged_avatar') != 'null') {
			$user_image = $this->session->userdata('logged_avatar');
		} else {
			$user_image = 'default-avatar.jpg';
		}
		$data = array(
			'user_image' => base_url('files/img/'.$user_image),
			'user_thumb' => base_url('files/thumb/'.$user_image),
		);
		$this->load->view('admin/faculty_add_v',$data);
	}

	function faculty_create() {
		$rules = array(
            array(
				'field' => 'name_ind',
				'label' => 'Nama Fakultas (Ind)',
				'rules' => 'trim|xss_clean|required|callback_custom_alpha|max_length[200]'
            ),
			array(
				'field' => 'name_eng',
				'label' => 'Nama Fakultas (Eng)',
				'rules' => 'trim|xss_clean|required|callback_custom_alpha|max_length[200]'
            ),
			array(
				'field' => 'descript',
				'label' => 'Deskripsi',
				'rules' => 'trim|required'
			)
		);
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('','');
		$respon = array('status' => false, 'error' => array());
		if($this->form_validation->run() == false) {
			$array_errors = array(
				'name_ind' => form_error('name_ind'),
				'name_eng' => form_error('name_eng'),
				'descript' => form_error('descript')
			);
			foreach ($array_errors as $key => $value) {
				$respon['error'][$key] = form_error($key);
			}
        } else {
			$data = array(
				'name_ind' => strtolower($this->input->post('name_ind')),
				'name_eng' => strtolower($this->input->post('name_eng')),
				'descript' => $this->input->post('descript'),
				'timestamp' => date('Y-m-d H:i:s'),
				'admin_id' => $this->session->userdata('logged_id')
			);
			$this->academic_m->get_insert('faculty',$data);
			$respon['status'] = true;
		}
		echo json_encode($respon);
	}

	function faculty_edit($param) {
		if($this->session->userdata('logged_avatar') != 'null') {
			$user_image = $this->session->userdata('logged_avatar');
		} else {
			$user_image = 'default-avatar.jpg';
		}
		$data = array(
			'user_image' => base_url('files/img/'.$user_image),
			'user_thumb' => base_url('files/thumb/'.$user_image),
			'data' => $this->academic_m->get_faculty_id($param)->row(),
		);
		$this->load->view('admin/faculty_edit_v',$data);
	}

	function faculty_update() {
		$rules = array(
            array(
				'field' => 'name_ind',
				'label' => 'Nama Fakultas (Ind)',
				'rules' => 'trim|xss_clean|required|callback_custom_alpha|max_length[200]'
            ),
			array(
				'field' => 'name_eng',
				'label' => 'Nama Fakultas (Eng)',
				'rules' => 'trim|xss_clean|required|callback_custom_alpha|max_length[200]'
            ),
			array(
				'field' => 'descript',
				'label' => 'Deskripsi',
				'rules' => 'trim'
			)
		);
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('','');
		$respon = array('status' => false, 'error' => array());
		if($this->form_validation->run() == false) {
			$array_errors = array(
				'name_ind' => form_error('name_ind'),
				'name_eng' => form_error('name_eng')
			);
			foreach ($array_errors as $key => $value) {
				$respon['error'][$key] = form_error($key);
			}
        } else {
			$where = array(
				'faculty_id' => $this->input->post('id')
			);
			$data = array(
				'name_ind' => strtolower($this->input->post('name_ind')),
				'name_eng' => strtolower($this->input->post('name_eng')),
				'descript' => $this->input->post('descript'),
				'timestamp' => date('Y-m-d H:i:s'),
				'admin_id' => $this->session->userdata('logged_id')
			);
			$this->academic_m->get_update('faculty',$where,$data);
			$respon['status'] = true;
		}
		echo json_encode($respon);
	}

	function faculty_delete($param) {
		$this->academic_m->get_delete('faculty',$param);
		echo json_encode(array('status' => true));
	}

/*--- function academic - major -----------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/

	function major() {
		if($this->session->userdata('logged_avatar') != 'null') {
			$avatar = $this->session->userdata('logged_avatar');
		} else {
			$avatar = 'default-avatar.jpg';
		}
		$data = array(
			'user_thumb' => base_url('files/thumb/'.$avatar),
		);
		$this->load->view('admin/major_list_v',$data);
	}

	function major_list() {
		$list = $this->academic_m->get_dt('major');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $col) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucwords($col->maj_name_ind);
			$row[] = ucwords($col->maj_name_eng);
			$row[] = ucwords($col->deg_alias);
			$row[] = strip_tags(stripslashes(substr($col->maj_descript,0,250)))."...";
			$row[] = date('d M Y H:i:s', strtotime($col->maj_timestamp));
			$row[] = ucwords($col->adm_firstname.' '.$col->adm_lastname);
			$row[] = '<div class="text-center row">
					  <a href="javascript:void(0)" class="btn btn-xs btn-warning" title="Ubah Data" onclick="data_edit('."'".$col->maj_major_id."'".')"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					  <a href="javascript:void(0)" class="btn btn-xs btn-danger" title="Hapus Data" onclick="data_delete('."'".$col->maj_major_id."'".')"><i class="fa fa-trash" aria-hidden="true"></i></a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->academic_m->count_all('major'),
			"recordsFiltered" => $this->academic_m->count_filtered('major'),
			"data" => $data,
		);
		echo json_encode($output);
	}

	function major_add() {
		if($this->session->userdata('logged_avatar') != 'null') {
			$user_image = $this->session->userdata('logged_avatar');
		} else {
			$user_image = 'default-avatar.jpg';
		}
		$data = array(
			'user_image' => base_url('files/img/'.$user_image),
			'user_thumb' => base_url('files/thumb/'.$user_image),
			'data_degree' => $this->academic_m->get_degree_list()->result(),
			'data_faculty' => $this->academic_m->get_faculty_list()->result(),
		);
		$this->load->view('admin/major_add_v',$data);
	}

	function major_create() {
		$rules = array(
            array(
				'field' => 'name_ind',
				'label' => 'Nama Prodi (Ind)',
				'rules' => 'trim|xss_clean|required|callback_custom_alpha|max_length[200]'
            ),
			array(
				'field' => 'name_eng',
				'label' => 'Nama Prodi (Eng)',
				'rules' => 'trim|xss_clean|required|callback_custom_alpha|max_length[200]'
            ),
			array(
				'field' => 'degree',
				'label' => 'Jenjang Studi',
				'rules' => 'trim|xss_clean|required'
            ),
			array(
				'field' => 'faculty',
				'label' => 'Fakultas',
				'rules' => 'trim|xss_clean|required'
            ),
			array(
				'field' => 'descript',
				'label' => 'Deskripsi',
				'rules' => 'trim'
			)
		);
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('','');
		$respon = array('status' => false, 'error' => array());
		if($this->form_validation->run() == false) {
			$array_errors = array(
				'name_ind' => form_error('name_ind'),
				'name_eng' => form_error('name_eng'),
				'degree' => form_error('degree'),
				'faculty' => form_error('faculty')
			);
			foreach ($array_errors as $key => $value) {
				$respon['error'][$key] = form_error($key);
			}
        } else {
			$data = array(
				'name_ind' => strtolower($this->input->post('name_ind')),
				'name_eng' => strtolower($this->input->post('name_eng')),
				'descript' => $this->input->post('descript'),
				'timestamp' => date('Y-m-d H:i:s'),
				'degree_id' => strtolower($this->input->post('degree')),
				'faculty_id' => strtolower($this->input->post('faculty')),
				'admin_id' => $this->session->userdata('logged_id')
			);
			$this->academic_m->get_insert('major',$data);
			$respon['status'] = true;
		}
		echo json_encode($respon);
	}

	function major_edit($param) {
		if($this->session->userdata('logged_avatar') != 'null') {
			$user_image = $this->session->userdata('logged_avatar');
		} else {
			$user_image = 'default-avatar.jpg';
		}
		$data = array(
			'user_image' => base_url('files/img/'.$user_image),
			'user_thumb' => base_url('files/thumb/'.$user_image),
			'data_major' => $this->academic_m->get_major_id($param)->row(),
			'data_degree' => $this->academic_m->get_list('degree')->result(),
			'data_faculty' => $this->academic_m->get_list('faculty')->result()
		);
		$this->load->view('admin/major_edit_v',$data);
	}

	function major_update() {
		$rules = array(
            array(
				'field' => 'name_ind',
				'label' => 'Nama Prodi (Ind)',
				'rules' => 'trim|xss_clean|required|callback_custom_alpha|max_length[200]'
            ),
			array(
				'field' => 'name_eng',
				'label' => 'Nama Prodi (Eng)',
				'rules' => 'trim|xss_clean|required|callback_custom_alpha|max_length[200]'
            ),
			array(
				'field' => 'degree',
				'label' => 'Jenjang Studi',
				'rules' => 'trim|xss_clean|required'
            ),
			array(
				'field' => 'faculty',
				'label' => 'Fakultas',
				'rules' => 'trim|xss_clean|required'
            ),
			array(
				'field' => 'descript',
				'label' => 'Deskripsi',
				'rules' => 'trim'
			)
		);
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('','');
		$respon = array('status' => false, 'error' => array());
		if($this->form_validation->run() == false) {
			$array_errors = array(
				'name_ind' => form_error('name_ind'),
				'name_eng' => form_error('name_eng'),
				'degree' => form_error('degree'),
				'faculty' => form_error('faculty')
			);
			foreach ($array_errors as $key => $value) {
				$respon['error'][$key] = form_error($key);
			}
        } else {
			$where = array(
				'major_id' => $this->input->post('id')
			);
			$data = array(
				'name_ind' => strtolower($this->input->post('name_ind')),
				'name_eng' => strtolower($this->input->post('name_eng')),
				'descript' => $this->input->post('descript'),
				'timestamp' => date('Y-m-d H:i:s'),
				'degree_id' => strtolower($this->input->post('degree')),
				'faculty_id' => strtolower($this->input->post('faculty')),
				'admin_id' => $this->session->userdata('logged_id')
			);
			$this->academic_m->get_update('major',$where,$data);
			$respon['status'] = true;
		}
		echo json_encode($respon);
	}

	function major_delete($param) {
		$this->academic_m->get_delete('major',$param);
		echo json_encode(array('status' => true));
	}

/*--- function log - download -----------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/

	function log_download() {
		if($this->session->userdata('logged_avatar') != 'null') {
				$avatar = $this->session->userdata('logged_avatar');
			} else {
				$avatar = 'default-avatar.jpg';
			}
		$data = array(
			'user_thumb' => base_url('files/thumb/'.$avatar),
		);
		$this->load->view('admin/log_download_v',$data);
	}

	function log_download_list() {
		$list = $this->log_m->get_dt('download');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $col) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = ucwords($col->filename);
			$row[] = ucwords($col->ip_address);
			$row[] = ucwords($col->browser);
			$row[] = ucwords($col->platform);
			$row[] = ucwords($col->user_agent);
			$row[] = date('d M Y H:i:s', strtotime($col->timestamp));
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->log_m->count_all('download'),
			"recordsFiltered" => $this->log_m->count_filtered('download'),
			"data" => $data,
		);
		echo json_encode($output);
	}



}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */