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
    function add_golongan($params, $text)
    {
        $r = $this->db->insert('golongan', $params);
        history('Insert', $text);
        return $r;
    }
    function update_golongan($id, $params, $text)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('golongan', $params);
        history('Update', $text);
        return $r;
    }
    function delete_golongan($id, $text)
    {
        $r =  $this->db->delete('golongan', array('id' => $id));
        history('Delete', $text);
        return $r;
    }
}
