<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {
    function __construct() {
        parent::__construct();

        $this->load->helper('response');
    }

    public $view_table = 'view_total_data';

    /**
     *  getTotalData method
     *  get total data
     */
    public function getTotalData()
    {
        $column    = $this->_getColumn($this->view_table);
        $protected = ['id'];

        $check  = $this->_getCount($this->view_table);
        $query  = $this->db->select($column)->get($this->view_table);
        $result = json_decode(json_encode($query->row()), true);

        return responseSuccess($result, $check);
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