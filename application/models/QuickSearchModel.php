<?php defined('BASEPATH') OR exit('No direct script access allowed');

class QuickSearchModel extends CI_Model {
	function __construct() {
		parent::__construct();

		$this->load->helper('response');
	}

	public $table = 'workers';
	public $view_table = 'view_workers';

	/**
	 *  getAll method
	 *  get all data
	 */
	public function getAll($data_temp = [])
	{
		$column		= $this->_getColumn($this->view_table);
		$protected	= ['id'];

		$sort				= ['ASC', 'DESC'];
		$clause				= ['order' => 'id', 'sort' => 'ASC', 'limit' => 10, 'page' => 1];
		$error				= [];
		$paging				= [];
		$condition			= [];
		$condition_like		= [];
		$condition_inset	= [];

		$column_like = [
			'like_nik',
			'like_fullname',
			'like_email',
			'like_phone_1',
			'like_phone_2',
			'like_birth_place'
		];

		$column_inset = [
			'inset_ready_placement_ids',
			'inset_experience_ids'
		];

		$column_date = [
			'create_date',
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
					} else {
						if (in_array($key, ['is_active']) && $val === '0') {
							$clause[$key] = '\'0\'';
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

		if (!array_key_exists('is_active', $clause)) {
			$condition['is_active'] = 1;
		}

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
				} elseif (in_array($key, $column_inset) && in_array(substr($key, 6), $column)) {
					$condition_inset[substr($key, 6)] = $val;
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

		if (!empty($condition_inset) && is_array($condition_inset)) {
			foreach ($condition_inset as $key => $val) {
				$this->db->where('FIND_IN_SET(' . $val . ', ' . $key . ')');
			}
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

		if (empty($id)) {
			return responseBadRequest('Id is required');
		}

		if (!is_numeric($id)) {
			return responseBadRequest('Id is invalid');
		}

		$check = $this->_getCount($this->view_table, ['id' => $id]);

		if ($check == 0) {
			return responseNotFound();
		}

		$query = $this->db->select($column)->where(['id' => $id])->get($this->view_table);
		$result	= json_decode(json_encode($query->row()), true);

		return responseSuccess($result, $check);
	}
}