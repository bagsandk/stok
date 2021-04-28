<?php
class Gedung_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_gedung($id)
    {
        return $this->db->get_where('gedung', array('id' => $id))->row_array();
    }
    function get_all_gedung()
    {
        return $this->db->get('gedung')->result_array();
    }
    function add_gedung($params, $text)
    {
        $r = $this->db->insert('gedung', $params);
        history('Insert', $text);
        return $r;
    }
    function update_gedung($id, $params, $text)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('gedung', $params);
        history('Update', $text);
        return $r;
    }
    function delete_gedung($id, $text)
    {
        $r =  $this->db->delete('gedung', array('nameShort' => $id));
        history('Delete', $text);
        return $r;
    }
}
