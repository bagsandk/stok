<?php
class Produk_kendaraan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_produk_kendaraan($id)
    {
        return $this->db->get_where('product_kendaraan', array('id' => $id))->row_array();
    }
    function get_all_produk_kendaraan_()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('product_kendaraan')->result_array();
    }
    function add_produk_kendaraan($params)
    {
        $r = $this->db->insert('product_kendaraan', $params);
        history('Insert', $this->db->last_query());
        return $r;
    }
    function update_produk_kendaraan($id, $params)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('product_kendaraan', $params);
        history('Update', $this->db->last_query());
        return $r;
    }
    function delete_produk_kendaraan($id)
    {
        $r =  $this->db->delete('product_kendaraan', array('id' => $id));
        history('Delete', $this->db->last_query());
        return $r;
    }
}
