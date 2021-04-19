<?php
class Golongan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_golongan($id)
    {
        return $this->db->get_where('golongan', array('id' => $id))->row_array();
    }
    function get_all_golongan_()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('golongan')->result_array();
    }
    function add_golongan($params)
    {
        $r = $this->db->insert('golongan', $params);
        history('Insert', $this->db->last_query());
        return $r;
    }
    function update_golongan($id, $params)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('golongan', $params);
        history('Update', $this->db->last_query());
        return $r;
    }
    function delete_golongan($id)
    {
        $r =  $this->db->delete('golongan', array('id' => $id));
        history('Delete', $this->db->last_query());
        return $r;
    }
}
