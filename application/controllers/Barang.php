<?php
class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->model('Global_model');
        $this->load->model('Subkelompok_model');
    }
    function index()
    {
        $data['barang_'] = $this->Barang_model->get_all_barang_();
        $data['_view'] = 'administrator/barang/index';
        $this->load->view('administrator/layouts/main', $data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('barang', 'barang', 'required|max_length[100]');
        $this->form_validation->set_rules('kodeSub', 'Kode Sub Kelompok', 'required');
        if ($this->form_validation->run()) {
            $params = array(
                'namaBarang' => $this->input->post('barang'),
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
                'kodeSub' => $this->input->post('kodeSub'),
            );
            $barang_id = $this->Barang_model->add_barang($params);
            if ($barang_id) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('barang/index');
        } else {
            $data['subkelompok_'] = $this->Subkelompok_model->get_all_subkelompok_();
            $data['_view'] = 'administrator/barang/add';
            $this->load->view('administrator/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['barang'] = $this->Barang_model->get_barang($id);
        if (isset($data['barang']['id'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('barang', 'barang', 'required|max_length[100]');
            $this->form_validation->set_rules('kodeSub', 'Kode Sub Kelompok', 'required|max_length[100]');
            if ($this->form_validation->run()) {
                $params = array(
                    'namaBarang' => $this->input->post('barang'),
                    'updatedAt' => date('Y-m-d H:i:s'),
                    'kodeSub' => $this->input->post('kodeSub'),
                );
                $barang_id = $this->Barang_model->update_barang($id, $params);
                if ($barang_id) {
                    alert('success', 'Berhasil...', 'Berhasil mengubah data');
                } else {
                    alert('error', 'Gagal...', 'Gagal mengubah data');
                }
                redirect('barang/index');
            } else {
                $data['subkelompok_'] = $this->Subkelompok_model->get_all_subkelompok_();
                $data['_view'] = 'administrator/barang/edit';
                $this->load->view('administrator/layouts/main', $data);
            }
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('barang/index');
            die;
        }
    }
    function remove($id)
    {
        $barang = $this->Barang_model->get_barang($id);
        if (isset($barang['id'])) {
            $cek = $this->Global_model->get_data('product', ['kodeBarang' => $id], false);
            if ($cek == null) {
                $barang_id = $this->Barang_model->delete_barang($id);;
                if ($barang_id) {
                    alert('success', 'Berhasil...', 'Berhasil menghapus data');
                } else {
                    alert('error', 'Gagal...', 'Gagal menghapus data');
                }
                redirect('barang/index');
                die;
            } else {
                alert('error', 'Gagal...', 'Tidak diizinkan untuk menghapus data yang sedang digunakan!');
                redirect('barang/index');
                die;
            }
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('barang/index');
            die;
        }
    }
}
