<?php
class Golongan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Golongan_model');
        $this->load->model('Global_model');
    }
    function index()
    {
        $data['golongan_'] = $this->Golongan_model->get_all_golongan_();
        $data['_view'] = 'administrator/golongan/index';
        $this->load->view('administrator/layouts/main', $data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('namaGolongan', 'golongan', 'required|max_length[100]');
        if ($this->form_validation->run()) {
            $params = array(
                'namaGolongan' => $this->input->post('namaGolongan'),
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s')
            );
            $text = text('Insert', 'golongan', ['namaGolongan'], [], $_POST, []);

            $golongan_id = $this->Golongan_model->add_golongan($params, $text);
            if ($golongan_id) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('golongan/index');
        } else {
            $data['_view'] = 'administrator/golongan/add';
            $this->load->view('administrator/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['golongan'] = $this->Golongan_model->get_golongan($id);
        if (isset($data['golongan']['id'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('namaGolongan', 'Golongan', 'required|max_length[100]');
            if ($this->form_validation->run()) {
                $params = array(
                    'namaGolongan' => $this->input->post('namaGolongan'),
                    'updatedAt' => date('Y-m-d H:i:s')
                );
                $text = text('Update', 'golongan', ['namaGolongan'], [], $data['golongan'], $_POST);
                if ($text != '') {
                    $golongan_id = $this->Golongan_model->update_golongan($id, $params, $text);
                    if ($golongan_id) {
                        alert('success', 'Berhasil...', 'Berhasil mengubah data');
                    } else {
                        alert('error', 'Gagal...', 'Gagal mengubah data');
                    }
                } else {
                    alert('info', 'Ubah ?', 'Tidak ada data yang diubah');
                }
                redirect('golongan/index');
                die;
            } else {
                $data['_view'] = 'administrator/golongan/edit';
                $this->load->view('administrator/layouts/main', $data);
            }
        } else {
            alert('error', 'Gagal...', 'Data yang ingin diubah tidak ditemukan');
            redirect('golongan/index');
            die;
        }
    }
    function remove($id)
    {
        $golongan = $this->Golongan_model->get_golongan($id);
        if (isset($golongan['id'])) {
            $cek = $this->Global_model->get_data('kelompok', ['kodeGol' => $id], false);
            if ($cek == null) {
                $text = text('Delete', 'golongan', ['id', 'namaGolongan'], [], $golongan, []);
                $golongan_id = $this->Golongan_model->delete_golongan($id, $text);
                if ($golongan_id) {
                    alert('success', 'Berhasil...', 'Berhasil menghapus data');
                } else {
                    alert('error', 'Gagal...', 'Gagal menghapus data');
                }
                redirect('golongan/index');
                die;
            } else {
                alert('error', 'Gagal...', 'Tidak diizinkan untuk menghapus data yang sedang digunakan!');
                redirect('golongan/index');
                die;
            }
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('golongan/index');
            die;
        }
    }
}
