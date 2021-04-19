<?php
class Barang_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_barang($id)
    {
        return $this->db->get_where('barang', array('id' => $id))->row_array();
    }
    function get_all_barang_()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('barang')->result_array();
    }
    function add_barang($params)
    {
        $r = $this->db->insert('barang', $params);
        history('Insert', $this->db->last_query());
        return $r;
    }
    function update_barang($id, $params)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('barang', $params);
        history('Update', $this->db->last_query());
        return $r;
    }
    function delete_barang($id)
    {
        $r =  $this->db->delete('barang', array('id' => $id));
        history('Delete', $this->db->last_query());
        return $r;
    }
}
