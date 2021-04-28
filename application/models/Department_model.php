<?php
class Department_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_department($id)
    {
        return $this->db->get_where('department', array('nameShort' => $id))->row_array();
    }
    function get_all_department()
    {
        return $this->db->get('department')->result_array();
    }
    function add_department($params, $text)
    {
        $r = $this->db->insert('department', $params);
        history('Insert', $text);
        return $r;
    }
    function update_department($id, $params, $text)
    {
        $this->db->where('nameShort', $id);
        $r =  $this->db->update('department', $params);
        history('Update', $text);
        return $r;
    }
    function delete_department($id, $text)
    {
        $r =  $this->db->delete('department', array('nameShort' => $id));
        history('Delete', $text);
        return $r;
    }
}
