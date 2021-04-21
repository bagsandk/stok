<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Global_model');
    }

    public function index()
    {
        $data['history'] = $this->db
            ->join('users', 'users.user_id=history.user_id')
            ->order_by('log_date', 'DESC')
            ->limit(7)
            ->group_start()
            ->like('query', 'golongan')
            ->or_like('query', 'kelompok')
            ->or_like('query', 'sub_kelompok')
            ->or_like('query', 'barang')
            ->or_like('query', 'product')
            ->or_like('query', 'product_kendaraan')
            ->or_like('query', 'kartu_stok_non_aset')
            ->or_like('query', 'kartu_stok_aset')
            ->group_end()
            ->get_where('history', ['history.user_id' => $this->session->userdata('user_id')])->result_array();
        $data['_view'] = 'guest/dashboard';
        $this->load->view('guest/layouts/main', $data);
    }
}
