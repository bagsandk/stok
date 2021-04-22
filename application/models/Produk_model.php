<?php
class Produk_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_produk($id)
    {
        return $this->db->get_where('product', array('id' => $id))->row_array();
    }
    function get_all_produk_()
    {
        $this->db->order_by('createdAt', 'desc');
        return $this->db->get('product')->result_array();
    }
    function add_produk($params, $text)
    {
        $r = $this->db->insert('product', $params);
        history('Insert', $text);
        return $this->db->order_by('createdAt', 'desc')->get('product', 1)->row_array()['id'];
    }
    function update_produk($id, $params, $text)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('product', $params);
        history('Update', $text);
        return $r;
    }
    function delete_produk($id, $text)
    {
        $r =  $this->db->delete('product', array('id' => $id));
        history('Delete', $text);
        return $r;
    }
}
