<?php
class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Barang_model');
        $this->load->model('Global_model');
    }
    function index()
    {
        $data['produk_'] = $this->Produk_model->get_all_produk_();
        $data['_view'] = 'administrator/produk/index';
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
        if ($this->form_validation->run()) {
            $params = array(
                'nama' => $this->input->post('nama'),
                'merek' => $this->input->post('merek'),
                'satuan' => $this->input->post('satuan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'gambar' => '-',
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
                'kodeBarang' => $this->input->post('kodeBarang'),
            );
            $produk_id = $this->Produk_model->add_produk($params);
            redirect('produk/index');
        } else {
            $data['barang'] = $this->Barang_model->get_all_barang_();
            $data['_view'] = 'administrator/produk/add';
            $this->load->view('administrator/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['produk'] = $this->Produk_model->get_produk($id);
        if (isset($data['produk']['id'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama', 'Nama produk', 'required|max_length[100]');
            $this->form_validation->set_rules('merek', 'Merek', 'required|max_length[100]');
            $this->form_validation->set_rules('satuan', 'Satuan', 'required|max_length[100]');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|max_length[100]');
            $this->form_validation->set_rules('kodeBarang', 'Kode Barang', 'required|max_length[100]');
            if ($this->form_validation->run()) {
                $params = array(
                    'nama' => $this->input->post('nama'),
                    'merek' => $this->input->post('merek'),
                    'satuan' => $this->input->post('satuan'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'updatedAt' => date('Y-m-d H:i:s'),
                    'kodeBarang' => $this->input->post('kodeBarang'),
                );
                $this->Produk_model->update_produk($id, $params);
                redirect('produk/index');
            } else {
                $data['barang'] = $this->Barang_model->get_all_barang_();
                $data['_view'] = 'administrator/produk/edit';
                $this->load->view('administrator/layouts/main', $data);
            }
        } else
            show_error('The produk you are trying to edit does not exist.');
    }
    function remove($id)
    {
        $produk = $this->Produk_model->get_produk($id);
        if (isset($produk['id'])) {
            $cek = $this->Global_model->get_data('product_kendaraan', ['productId' => $id], false);
            if ($cek == null) {
                $product_id = $this->Produk_model->delete_produk($id);
                if ($product_id) {
                    alert('success', 'Berhasil...', 'Berhasil menghapus data');
                } else {
                    alert('error', 'Gagal...', 'Gagal menghapus data');
                }
                redirect('produk/index');
                die;
            } else {
                alert('error', 'Gagal...', 'Tidak diizinkan untuk menghapus data yang sedang digunakan!');
                redirect('produk/index');
                die;
            }
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('produk/index');
            die;
        }
    }
}
