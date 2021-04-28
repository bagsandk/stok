<?php
class Ruangan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_ruangan($id)
    {
        return $this->db->get_where('ruangan', array('id' => $id))->row_array();
    }
    function get_all_ruangan()
    {
        return $this->db->get('ruangan')->result_array();
    }
    function add_ruangan($params, $text)
    {
        $r = $this->db->insert('ruangan', $params);
        history('Insert', $text);
        return $r;
    }
    function update_ruangan($id, $params, $text)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('ruangan', $params);
        history('Update', $text);
        return $r;
    }
    function delete_ruangan($id, $text)
    {
        $r =  $this->db->delete('ruangan', array('nameShort' => $id));
        history('Delete', $text);
        return $r;
    }
}
