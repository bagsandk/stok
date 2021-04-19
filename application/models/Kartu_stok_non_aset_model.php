<?php
class Kartu_stok_non_aset_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_kartu_stok_non_aset($id)
    {
        return $this->db->get_where('kartu_stok_non_aset', array('id' => $id))->row_array();
    }
    function get_all_kartu_stok_non_aset_()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('kartu_stok_non_aset')->result_array();
    }
    function add_kartu_stok_non_aset($params)
    {
        $r = $this->db->insert('kartu_stok_non_aset', $params);
        history('Insert', $this->db->last_query());
        return $r;
    }
    function update_kartu_stok_non_aset($id, $params)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('kartu_stok_non_aset', $params);
        history('Update', $this->db->last_query());
        return $r;
    }
    function delete_kartu_stok_non_aset($id)
    {
        $r =  $this->db->delete('kartu_stok_non_aset', array('id' => $id));
        history('Delete', $this->db->last_query());
        return $r;
    }
}
