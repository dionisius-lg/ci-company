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
     *  get data
     */
    public function get()
    {
        $column    = $this->_getColumn($this->view_table);
        $protected = ['id'];

        $check = $this->_getCount($this->view_table);

        if ($check > 0) {
            $query  = $this->db->select($column)->limit(1)->get($this->view_table);
            $result = json_decode(json_encode($query->row()), true);
        } else {
            $result = [];

            foreach ($column as $column) {
                $result[$column] = '';
            }
        }

        return responseSuccess($result, $check);
    }

    /**
     *  update method
     *  update existing data
     */
    public function update($data_temp = [])
    {
        $column    = $this->_getColumn($this->table);
        $protected = ['id'];
        $data      = [];

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

        $check = $this->_getCount($this->table);

        if ($check > 0) {
            $updated = $this->db->update($this->table, $data);
        } else {
            $updated = $this->db->insert($this->table, $data);
        }

        if ($updated) {
            return responseSuccess();
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
    public function _getCount($table = null, $condition = [], $condition_like = [], $condition_inset = [], $condition_between = [])
    {
        if (!empty($table)) {
            $this->db->from($table);

            if (!empty($condition) && is_array($condition)) {
                $this->db->where($condition);
            }

            if (!empty($condition_like) && is_array($condition_like)) {
                $this->db->like($condition_like);
            }

            if (!empty($condition_inset) && is_array($condition_inset)) {
                foreach ($condition_inset as $key => $val) {
                    if (!empty($val) && is_array($val)) {
                        $term_inset = [];
    
                        foreach ($val as $val) {
                            $term_inset[] = 'FIND_IN_SET(' . $val . ', ' . $key . ')';
                        }
    
                        $term_inset = implode(' or ', $term_inset);
    
                        $this->db->where($term_inset);
                    } else {
                        $this->db->where('FIND_IN_SET(' . $val . ', ' . $key . ')');
                    }
                }
            }

            if (!empty($condition_between) && is_array($condition_between)) {
                foreach ($condition_between as $key => $val) {
                    if (!empty($val) && is_array($val) && count($val) === 2) {
                        if (!empty($val[0]) && !empty($val[1])) {
                            $term_between = $key . ' BETWEEN ' . implode(' AND ', $val);
    
                            $this->db->where($term_between);
                        }
                    }
                }
            }

            return $this->db->count_all_results();
        }

        return 0;
    }
}