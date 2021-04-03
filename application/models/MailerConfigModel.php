<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MailerConfigModel extends CI_Model {
	function __construct() {
		parent::__construct();

		$this->load->helper('response');
	}

	public $table = 'mailer_config';
	public $view_table = 'mailer_config';

	/**
	 *  get method
	 *  get detail data
	 */
	public function get()
	{
		$column		= $this->_getColumn($this->view_table);
		$protected	= ['id'];

		$check = $this->_getCount($this->view_table);

		if ($check == 0) {
			return responseNotFound();
		}

		$query = $this->db->select($column)->limit(1)->get($this->view_table);
		$result	= json_decode(json_encode($query->row()), true);

		return responseSuccess($result, $check);
	}

	/**
	 *  update method
	 *  update existing data
	 */
	public function update($data_temp = [])
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
						$data[$key] = $val;
					} else {
						if (in_array($key, ['is_active']) && $val === '0') {
							$data[$key] = '0';
						}
					}
				}
			}
		}

		if (empty($data)) {
			return responseBadRequest('Empty data');
		}

		$check = $this->_getCount($this->view_table);

		if ($check == 0) {
			return responseNotFound();
		}

		$updated = $this->db->update($this->table, $data);

		if ($updated) {
			return responseSuccess();
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
}