<?php
class Subkelompok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('isLogIn') != true){
            redirect('auth/logout');
        }
        $this->load->model('Subkelompok_model');
        $this->load->model('Kelompok_model');
        $this->load->model('Global_model');
    }
    function index()
    {
        $data['subkelompok_'] = $this->Subkelompok_model->get_all_subkelompok_();
        $data['_view'] = 'administrator/subkelompok/index';
        $this->load->view('administrator/layouts/main', $data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('namaSub', 'Nama Sub', 'required|max_length[100]');
        $this->form_validation->set_rules('kodeKelompok', 'Kode Kelompok', 'required|max_length[100]');
        if ($this->form_validation->run()) {
            $params = array(
                'namaSub' => $this->input->post('namaSub'),
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
                'kodeKelompok' => $this->input->post('kodeKelompok'),
            );
            $relation = [
                [
                    'table' => 'kelompok',
                    'field' => ['namaKelompok'],
                    'pk' => 'id',
                    'valuePk' => $this->input->post('kodeKelompok'),
                ]
            ];
            $text = text('Insert', 'sub_kelompok', ['namaSub', 'kodeKelompok'], $relation, $_POST, []);
            $subkelompok_id = $this->Subkelompok_model->add_subkelompok($params, $text);
            if ($subkelompok_id) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('subkelompok/index');
        } else {
            $data['kelompok_'] = $this->Kelompok_model->get_all_kelompok_();
            $data['_view'] = 'administrator/subkelompok/add';
            $this->load->view('administrator/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['subkelompok'] = $this->Subkelompok_model->get_subkelompok($id);
        if (isset($data['subkelompok']['id'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('namaSub', 'Nama Sub', 'required|max_length[100]');
            $this->form_validation->set_rules('kodeKelompok', 'Kode Kelompok', 'required');
            if ($this->form_validation->run()) {
                $params = array(
                    'namaSub' => $this->input->post('namaSub'),
                    'updatedAt' => date('Y-m-d H:i:s'),
                    'kodeKelompok' => $this->input->post('kodeKelompok'),
                );
                $relation = [
                    [
                        'table' => 'kelompok',
                        'field' => ['namaKelompok'],
                        'pk' => 'id',
                        'valuePk' => $this->input->post('kodeKelompok'),
                    ]
                ];
                $text = text('Update', 'sub_kelompok', ['namaSub', 'kodeKelompok'], $relation, $data['subkelompok'], $_POST);
                if ($text != '') {
                    $subkelompok_id = $this->Subkelompok_model->update_subkelompok($id, $params, $text);
                    if ($subkelompok_id) {
                        alert('success', 'Berhasil...', 'Berhasil mengubah data');
                    } else {
                        alert('error', 'Gagal...', 'Gagal mengubah data');
                    }
                } else {
                    alert('info', 'Ubah ?', 'Tidak ada data yang diubah');
                }

                redirect('subkelompok/index');
            } else {
                $data['kelompok_'] = $this->Kelompok_model->get_all_kelompok_();
                $data['_view'] = 'administrator/subkelompok/edit';
                $this->load->view('administrator/layouts/main', $data);
            }
        } else {
            alert('error', 'Gagal...', 'Data yang ingin diubah tidak ditemukan');
            redirect('subkelompok/index');
            die;
        }
    }
    function remove($id)
    {
        $subkelompok = $this->Subkelompok_model->get_subkelompok($id);
        if (isset($subkelompok['id'])) {
            $cek = $this->Global_model->get_data('barang', ['kodeSub' => $id], false);
            if ($cek == null) {
                $text = text('Delete', 'sub_kelompok', ['id', 'namaSub', 'kodeKelompok'], [], $subkelompok, []);
                $subkelompok_id =  $this->Subkelompok_model->delete_subkelompok($id, $text);
                if ($subkelompok_id) {
                    alert('success', 'Berhasil...', 'Berhasil menghapus data');
                } else {
                    alert('error', 'Gagal...', 'Gagal menghapus data');
                }
                redirect('subkelompok/index');
                die;
            } else {
                alert('error', 'Gagal...', 'Tidak diizinkan untuk menghapus data yang sedang digunakan!');
                redirect('subkelompok/index');
                die;
            }
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('subkelompok/index');
            die;
        }
    }
}
