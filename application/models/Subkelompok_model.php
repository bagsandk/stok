<?php
class Subkelompok_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_subkelompok($id)
    {
        return $this->db->get_where('sub_kelompok', array('id' => $id))->row_array();
    }
    function get_all_subkelompok_()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('sub_kelompok')->result_array();
    }
    function add_subkelompok($params, $text)
    {
        $r = $this->db->insert('sub_kelompok', $params);
        history('Insert', $text);
        return $r;
    }
    function update_subkelompok($id, $params, $text)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('sub_kelompok', $params);
        history('Update', $text);
        return $r;
    }
    function delete_subkelompok($id, $text)
    {
        $r =  $this->db->delete('sub_kelompok', array('id' => $id));
        history('Delete', $text);
        return $r;
    }
}
