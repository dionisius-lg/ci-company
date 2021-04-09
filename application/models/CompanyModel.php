<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyModel extends CI_Model {
	function __construct() {
		parent::__construct();

		$this->load->helper('response');
	}

	public $table = 'company';
	public $view_table = 'view_company';

	/**
	 *  getDetail method
	 *  get detail data
	 */
	public function getDetail()
	{
		$column		= $this->_getColumn($this->view_table);
		$protected	= ['id'];
		$id			= 1;

		if (in_array('id', $column)) {
			$column = array_diff($column, ['id']);
		}

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

	/**
	 *  update method
	 *  update existing data by id
	 */
	public function update($data_temp = [])
	{
		$column		= $this->_getColumn($this->table);
		$protected	= ['id'];
		$data		= [];
		$id			= 1;

		if (in_array('id', $column)) {
			$column = array_diff($column, ['id']);
		}

		if (empty($id)) {
			return responseBadRequest('Id is required');
		}

		if (!is_numeric($id)) {
			return responseBadRequest('Id is invalid');
		}

		if (!empty($data_temp) && is_array($data_temp)) {
			foreach ($data_temp as $key => $val) {
				if (!in_array($key, $column) || in_array($key, $protected)) {
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

		$check = $this->_getCount($this->table, ['id' => $id]);

		if ($check == 0) {
			return responseNotFound();
		}

		$updated = $this->db->update($this->table, $data, ['id' => $id]);

		if ($updated) {
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
}