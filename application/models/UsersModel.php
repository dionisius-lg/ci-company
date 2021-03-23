<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model {
	function __construct() {
		parent::__construct();

		$this->load->helper('response');
	}

	public $table = 'users';
	public $view_table = 'view_users';

	/**
	 *  getAll method
	 *  get all data
	 */
	public function getAll($data_temp = [])
	{
		$column		= $this->_getColumn($this->view_table);
		$protected	= ['id', 'password'];

		if (in_array('password', $column)) {
			$column = array_diff($column, ['password']);
		}

		$sort			= ['ASC', 'DESC'];
		$clause			= ['order' => 'id', 'sort' => 'ASC', 'limit' => 10, 'page' => 1];
		$error			= [];
		$paging			= [];
		$condition		= [];
		$condition_like	= [];

		$column_like = [
			'like_username',
			'like_user_level'
		];

		$column_date = [
			'request_date',
			'register_date',
			'update_date'
		];

		if (!empty($data_temp) && is_array($data_temp)) {
			foreach ($data_temp as $key => $val) {
				if (in_array($key, $protected)) {
					return responseBadRequest();
				} else {
					if (!empty($val)) {
						if (in_array($key, $column_date)) {
							$clause[$key] = DateTime::createFromFormat('Y-m-d', $val);
							$error[$key] = DateTime::getLastErrors();
						} else {
							$clause[$key] = $val;
						}
					}
				}
			}
		}

		if (!in_array($clause['order'], $column) || !is_numeric($clause['limit']) || !is_numeric($clause['page']) || !in_array(strtoupper($clause['sort']), $sort)) {
			return responseBadRequest();
		}

		if (!empty($error) && is_array($error)) {
			foreach ($error as $key => $val) {
				if ($val['warning_count'] > 0 || $val['val'] > 0) {
					return responseBadRequest('Invalid format column '.$key);
				}
			}
		}

		$this->db->select($column);

		$condition['is_active'] = 1;

		foreach ($clause as $key => $val) {
			if (!empty($val)) {
				if (in_array($key, $column)) {
					if (in_array($key, $column_date)) {
						$condition[$key] = $val->format('Y-m-d');
					} else {
						$condition[$key] = $val;
					}
				} elseif (in_array($key, $column_like) && in_array(substr($key, 5), $column)) {
					$condition_like[substr($key, 5)] = $val;
				} elseif ($key == 'not_id' && is_numeric($val)) {
					$condition['id !='] = $val;
				}
			}
		}

		if (!empty($condition) && is_array($condition)) {
			$this->db->where($condition);
		}

		if (!empty($condition_like) && is_array($condition_like)) {
			$this->db->like($condition_like);
		}

		$offset = ($clause['limit'] * $clause['page']) - $clause['limit'];

		if (is_numeric($offset) && $offset >= 0) {
			$this->db->limit($clause['limit'], $offset);
		} else {
			$this->db->limit($clause['limit']);
		}

		$query	= $this->db->order_by($clause['order'], strtoupper($clause['sort']))->get($this->view_table);
		$result	= json_decode(json_encode($query->result()), true);
		$total	= $this->_getCount($this->view_table, $condition, $condition_like);

		if (!empty($clause['limit'])) {
			$page_first		= 1;
			$page_last		= ceil($total / $clause['limit']);
			$page_current	= (int) $clause['page'];
			$page_next		= $page_current + 1;
			$page_previous	= $page_current - 1;

			$paging = [
				'current' => $page_current,
				'next' => ($page_next <= $page_last) ? $page_next : $page_current,
				'previous' => ($page_previous > 0) ? $page_previous : 1,
				'first' => $page_first,
				'last' => ($page_last > 0) ? $page_last : 1,
			];
		}

		return responseSuccess($result, $total, $paging);
	}

	/**
	 *  getDetail method
	 *  get detail data
	 */
	public function getDetail($id = null)
	{
		$column		= $this->_getColumn($this->view_table);
		$protected	= ['id'];

		if (in_array('password', $column)) {
			$column = array_diff($column, ['password']);
		}

		if (empty($id)) {
			return responseBadRequest();
		}

		if (!is_numeric($id)) {
			return responseBadRequest();
		}

		$check = $this->_getCount($this->view_table, ['id' => $id]);

		if ($check == 0) {
			return responseNotFound();
		}

		$query = $this->db->select($column)->where(['id' => $id])->get($this->view_table);
		$result	= json_decode(json_encode($query->row()), true);

		return responseSuccess($result, $check);
	}

	/**
	 *  insert method
	 *  insert new data
	 */
	public function insert($data_temp = [])
	{
		$column		= $this->_getColumn($this->table);
		$protected	= ['id'];
		$data		= [];

		if (!empty($data_temp) && is_array($data_temp)) {
			foreach ($data_temp as $key => $val) {
				if (!in_array($key, $column) || in_array($key, $protected)) {
					return responseBadRequest();
				} else {
					if (!empty($val)) {
						if ($key == 'password') {
							$data[$key] = password_hash($val, PASSWORD_DEFAULT);
						} else {
							$data[$key] = $val;
						}
					}
				}
			}
		}

		if (empty($data)) {
			return responseBadRequest('Empty data');
		}

		if (array_key_exists('username', $data)) {
			$check = $this->_getCount($this->table, ['username' => $data['username']]);

			if ($check > 0) {
				return responseBadRequest('Username already exist');
			}
		}

		if (!array_key_exists('password', $data)) {
			$data['password'] = password_hash('12345678', PASSWORD_DEFAULT);
		}

		$inserted = $this->db->insert($this->table, $data);

		if ($inserted) {
			return responseSuccess(['id' => $this->db->insert_id()]);
		}

		return responseError();
	}

	/**
	 *  update method
	 *  update existing data by id
	 */
	public function update($data_temp = [], $id = null)
	{
		$column		= $this->_getColumn($this->table);
		$protected	= ['id'];
		$data		= [];

		if (empty($id)) {
			return responseBadRequest();
		}

		if (!is_numeric($id)) {
			return responseBadRequest();
		}

		if (!empty($data_temp) && is_array($data_temp)) {
			foreach ($data_temp as $key => $val) {
				if (!in_array($key, $column) || in_array($key, $protected)) {
					return responseBadRequest();
				} else {
					if (!empty($val)) {
						if ($key == 'password') {
							$data[$key] = password_hash($val, PASSWORD_DEFAULT);
						} else {
							$data[$key] = $val;
						}
					} else {
						if (in_array($key, ['is_active', 'is_register']) && $val === '0') {
							$data[$key] = '0';
						}
					}
				}
			}
		}

		if (empty($data)) {
			return responseBadRequest('Empty data');
		}

		$check = $this->_getCount($this->table, ['id' => $id]);

		if ($check == 0) {
			return responseNotFound();
		}

		if (array_key_exists('username', $data)) {
			$check = $this->_getCount($this->table, ['username' => $data['username'], 'id !=' => $id]);

			if ($check > 0) {
				return responseBadRequest('Username already exist');
			}
		}

		$updated = $this->db->update($this->table, $data, ['id' => $id]);

		if ($updated) {
			return responseSuccess(['id' => $id]);
		}

		return responseError();
	}

	/**
	 *  delete method
	 *  delete existing data by id
	 */
	public function delete($id = null)
	{
		$column		= $this->_getColumn($this->table);
		$protected	= ['id'];

		if (empty($id)) {
			return responseBadRequest();
		}

		if (!is_numeric($id)) {
			return responseBadRequest();
		}

		$check = $this->_getCount($this->table, ['id' => $id]);

		if ($check == 0) {
			return responseNotFound();
		}

		$deleted = $this->db->where(['id' => $id])->delete($this->table);

		if ($deleted) {
			return responseSuccess(['id' => $id]);
		}

		return responseError();
	}

	/**
	 *  private _getColumn method
	 *  return array column
	 */
	private function _getColumn($table)
	{
		$result = $this->db->list_fields($table);

		return $result;
	}

	/**
	 *  private _getCount method
	 *  return interger
	 */
	public function _getCount($table = null, $condition = [], $condition_like = [])
	{
		if (!empty($table)) {
			$this->db->from($table);

			if (!empty($condition) && is_array($condition)) {
				$this->db->where($condition);
			}

			if (!empty($condition_like) && is_array($condition_like)) {
				$this->db->like($condition_like);
			}

			return $this->db->count_all_results();
		}

		return 0;
	}

	/**
	 *  login method
	 *  verify username & password
	 */
	public function login($data_temp = [])
	{
		$column		= ['username', 'password'];
		$data		= [];

		if (!empty($data_temp) && is_array($data_temp)) {
			foreach ($data_temp as $key => $val) {
				if (!in_array($key, $column)) {
					return responseBadRequest();
				} else {
					if (!empty($val)) {
						$data[$key] = $val;
					}
				}
			}
		}

		if (empty($data)) {
			return responseBadRequest('Empty data');
		}

		if (!array_key_exists('username', $data) || !array_key_exists('password', $data)) {
			return responseBadRequest();
		}

		$condition = [
			'username' => $data['username'],
			'is_active' => 1
		];

		$query = $this->db->where($condition)->get($this->table);

		if ($query->num_rows() == 0) {
			return responseNotFound();
		}

		if (password_verify($data['password'], $query->row()->password)) {
			return responseSuccess(['id' => $query->row()->id], $query->num_rows());
		}

		return responseUnauthorized();
	}

	/**
	 *  private _getDatatablesQuery method
	 *  return query
	 */
	private function _getDatatablesQuery() {
		$search	= ['username', 'user_level'];
		$order	= ['id', 'username', 'user_level', 'register_date', 'register_by', 'update_date', 'update_by', 'is_employees'];

		$this->db->from($this->view_table)->where(['is_active' => 1]);

		$i = 0;

		foreach ($search as $item) {
			if ($_POST['search']['value']) {
				if ($i===0) {
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($search) - 1 == $i) {
					$this->db->group_end();
				}
			}

			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
	}

	/**
	 *  getDatatables method
	 *  get all data for datatables
	 */
	public function getDatatables()
	{
		$this->_getDatatablesQuery();

		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$result = $this->db->get()->result();

		return json_decode(json_encode($result), true);
	}

	public function countDatatablesFilter()
	{
		$this->_getDatatablesQuery();
		$result = $this->db->get()->num_rows();

		return $result;
	}
}