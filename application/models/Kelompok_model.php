<?php
class Kelompok_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_kelompok($id)
    {
        return $this->db->get_where('kelompok', array('id' => $id))->row_array();
    }
    function get_all_kelompok_()
    {
        return $this->db->get('kelompok')->result_array();
    }
    function add_kelompok($params, $text)
    {
        $r = $this->db->insert('kelompok', $params);
        history('Insert', $text);
        return $r;
    }
    function update_kelompok($id, $params, $text)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('kelompok', $params);
        history('Update', $text);
        return $r;
    }
    function delete_kelompok($id, $text)
    {
        $r =  $this->db->delete('kelompok', array('id' => $id));
        history('Delete', $text);
        return $r;
    }
}
