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

    function get_all_barang_aset()
    {
        return $this->db
            ->select('barang.id as id, namaBarang')
            ->join('sub_kelompok', 'sub_kelompok.id=barang.kodeSub')
            ->join('kelompok', 'kelompok.id=sub_kelompok.kodeKelompok')
            ->join('golongan', 'golongan.id=kelompok.kodeGol')->get_where('barang', ['namaGolongan' => 'Aset'])->result_array();
    }
    function add_barang($params, $text)
    {
        $r = $this->db->insert('barang', $params);
        history('Insert', $text);
        return $r;
    }
    function update_barang($id, $params, $text)
    {
        $this->db->where('id', $id);
        $r =  $this->db->update('barang', $params);
        history('Update', $text);
        return $r;
    }
    function delete_barang($id, $text)
    {
        $r =  $this->db->delete('barang', array('id' => $id));
        history('Delete', $text);
        return $r;
    }
}
