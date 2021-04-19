<?php
class Produk_kendaraan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_kendaraan_model');
        $this->load->model('Produk_model');
        $this->load->model('Barang_model');
    }
    function index()
    {
        $data['produk_kendaraan_'] = $this->Produk_kendaraan_model->get_all_produk_kendaraan_();
        $data['_view'] = 'administrator/produk_kendaraan/index';
        $this->load->view('administrator/layouts/main', $data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama produk', 'required|max_length[100]');
        $this->form_validation->set_rules('merek', 'Merek', 'required|max_length[100]');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required|max_length[100]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|max_length[100]');
        $this->form_validation->set_rules('kodeBarang', 'Kode Barang', 'required|max_length[100]');
        $this->form_validation->set_rules('tipe', 'Tipe kendaraan', 'required|max_length[100]');
        $this->form_validation->set_rules('bahanBakar', 'Bahan bakar', 'required|max_length[100]');
        $this->form_validation->set_rules('thPembuatan', 'Tahun Pembuatan', 'required|max_length[100]');
        $this->form_validation->set_rules('warna', 'Warna', 'required|max_length[100]');
        $this->form_validation->set_rules('hp', 'HP', 'required|max_length[100]');

        if ($this->form_validation->run()) {
            $params0 = array(
                'nama' => $this->input->post('nama'),
                'merek' => $this->input->post('merek'),
                'satuan' => $this->input->post('satuan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'gambar' => '-',
                'createdAt' => date('Y-m-d H:i:s'),
                'kodeBarang' => $this->input->post('kodeBarang'),
            );
            $produk_id = $this->Produk_model->add_produk($params0);
            $params = array(
                'tipe' => $this->input->post('tipe'),
                'bahanBakar' => $this->input->post('bahanBakar'),
                'thPembuatan' => $this->input->post('thPembuatan'),
                'warna' => $this->input->post('warna'),
                'hp' => $this->input->post('hp'),
                'createdAt' => date('Y-m-d H:i:s'),
                'productId' => $produk_id,
            );
            $produk_kendaraan_id = $this->Produk_kendaraan_model->add_produk_kendaraan($params);
            redirect('produk_kendaraan/index');
        } else {
            $data['barang'] = $this->Barang_model->get_all_barang_();
            $data['_view'] = 'administrator/produk_kendaraan/add';
            $this->load->view('administrator/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['produk_kendaraan'] = $this->Produk_kendaraan_model->get_produk_kendaraan($id);
        if (isset($data['produk_kendaraan']['id'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama', 'Nama produk', 'required|max_length[100]');
            $this->form_validation->set_rules('merek', 'Merek', 'required|max_length[100]');
            $this->form_validation->set_rules('satuan', 'Satuan', 'required|max_length[100]');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|max_length[100]');
            $this->form_validation->set_rules('kodeBarang', 'Kode Barang', 'required|max_length[100]');
            $this->form_validation->set_rules('tipe', 'Tipe kendaraan', 'required|max_length[100]');
            $this->form_validation->set_rules('bahanBakar', 'Bahan bakar', 'required|max_length[100]');
            $this->form_validation->set_rules('thPembuatan', 'Tahun Pembuatan', 'required|max_length[100]');
            $this->form_validation->set_rules('warna', 'Warna', 'required|max_length[100]');
            $this->form_validation->set_rules('hp', 'HP', 'required|max_length[100]');
            if ($this->form_validation->run()) {
                $params0 = array(
                    'nama' => $this->input->post('nama'),
                    'merek' => $this->input->post('merek'),
                    'satuan' => $this->input->post('satuan'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => '-',
                    'updatedAt' => date('Y-m-d H:i:s'),
                    'kodeBarang' => $this->input->post('kodeBarang'),
                );
                $this->Produk_model->update_produk($data['produk_kendaraan']['productId'], $params0);
                $params = array(
                    'tipe' => $this->input->post('tipe'),
                    'bahanBakar' => $this->input->post('bahanBakar'),
                    'thPembuatan' => $this->input->post('thPembuatan'),
                    'warna' => $this->input->post('warna'),
                    'hp' => $this->input->post('hp'),
                    'updatedAt' => date('Y-m-d H:i:s'),
                );
                $this->Produk_kendaraan_model->update_produk_kendaraan($id, $params);
                redirect('produk_kendaraan/index');
            } else {
                $data['barang'] = $this->Barang_model->get_all_barang_();
                $data['_view'] = 'administrator/produk_kendaraan/edit';
                $this->load->view('administrator/layouts/main', $data);
            }
        } else
            show_error('The produk_kendaraan you are trying to edit does not exist.');
    }
    function remove($id)
    {
        $produk_kendaraan = $this->Produk_kendaraan_model->get_produk_kendaraan($id);
        if (isset($produk_kendaraan['id'])) {
            $this->Produk_kendaraan_model->delete_produk_kendaraan($id);
            redirect('produk_kendaraan/index');
        } else
            show_error('The produk_kendaraan you are trying to delete does not exist.');
    }
}
