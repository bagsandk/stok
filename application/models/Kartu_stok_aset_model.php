<?php
class Kartu_stok_aset_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_kartu_stok_aset($id)
    {
        return $this->db->get_where('kartu_stok_aset', array('noInventaris' => $id))->row_array();
    }
    function get_kartu_garansi($id)
    {
        return $this->db->get_where('kartu_garansi', array('noInventaris' => $id))->row_array();
    }
    function get_ksa_nomor($id)
    {
        return $this->db->get_where('ksa_nomor', array('ksa' => $id))->result_array();
    }
    function get_ksa_kendaraan($id)
    {
        return $this->db->get_where('ksa_kendaraan', array('ksa' => $id))->row_array();
    }
    function get_all_kartu_stok_aset_()
    {
        $this->db->order_by('noInventaris', 'desc');
        return $this->db->get('kartu_stok_aset')->result_array();
    }
    function add_kartu_stok_aset($params)
    {
        $r = $this->db->insert('kartu_stok_aset', $params);
        history('Insert', $this->db->last_query());
        return $r;
    }
    function add_kartu_garansi($params)
    {
        $r = $this->db->insert('kartu_garansi', $params);
        history('Insert', $this->db->last_query());
        return $r;
    }
    function add_ksa_nomor($params)
    {
        $r = $this->db->insert('ksa_nomor', $params);
        history('Insert', $this->db->last_query());
        return $r;
    }
    function add_ksa_kendaraan($params)
    {
        $r = $this->db->insert('ksa_kendaraan', $params);
        history('Insert', $this->db->last_query());
        return $r;
    }
    function update_kartu_stok_aset($id, $params)
    {
        $this->db->where('noInventaris', $id);
        $r =  $this->db->update('kartu_stok_aset', $params);
        history('Update', $this->db->last_query());
        return $r;
    }
    function update_kartu_garansi($id, $params)
    {
        $this->db->where('noInventaris', $id);
        $r =  $this->db->update('kartu_garansi', $params);
        history('Update', $this->db->last_query());
        return $r;
    }
    function update_ksa_kendaraan($id, $params)
    {
        $this->db->where('ksa', $id);
        $r =  $this->db->update('ksa_kendaraan', $params);
        history('Update', $this->db->last_query());
        return $r;
    }
    function update_ksa_nomor($id, $params)
    {
        $this->db->where('kode', $id);
        $r =  $this->db->update('ksa_nomor', $params);
        history('Update', $this->db->last_query());
        return $r;
    }
    function delete_kartu_stok_aset($id)
    {
        $r =  $this->db->delete('kartu_stok_aset', array('noInventaris' => $id));
        history('Delete', $this->db->last_query());
        return $r;
    }
}
