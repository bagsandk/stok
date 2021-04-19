<?php

class Global_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function get_data($table, $where = [], $tipeResultArray = true, $order_by = null, $or = 'DESC')
    {
        if ($tipeResultArray == true) {
            if ($order_by == null) {
                $in = $this->db->get_where($table, $where)->result_array();
                // history('Select', $this->db->last_query());
                return $in;
            } else {
                $in = $this->db->order_by($order_by, $or)->get_where($table, $where)->result_array();
                // history('Select', $this->db->last_query());
                return $in;
            }
        } else {
            $in = $this->db->get_where($table, $where)->row_array();
            // history('Select', $this->db->last_query());
            return $in;
        }
    }

    function insert($table, $params)
    {
        $in = $this->db->insert($table, $params);
        history('Insert', $this->db->last_query());
        return $in;
    }

    function insert_history($table, $params)
    {
        $in = $this->db->insert($table, $params);
        return $in;
    }

    function update($table, $params, $where)
    {
        $this->db->where($where);
        $in = $this->db->update($table, $params);
        history('Update', $this->db->last_query());
        return $in;
    }

    function delete($table, $where)
    {
        $in = $this->db->delete($table, $where);
        history('Delete', $this->db->last_query());
        return $in;
    }
}
