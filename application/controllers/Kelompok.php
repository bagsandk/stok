<?php
class Kelompok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('isLogIn') != true){
            redirect('auth/logout');
        }
        $this->load->model('Kelompok_model');
        $this->load->model('Golongan_model');
        $this->load->model('Global_model');
    }
    function index()
    {
        $data['kelompok_'] = $this->Kelompok_model->get_all_kelompok_();
        $data['_view'] = 'administrator/kelompok/index';
        $this->load->view('administrator/layouts/main', $data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('namaKelompok', 'namaKelompok', 'required|max_length[100]');
        $this->form_validation->set_rules('kodeGol', 'Kode Golongan', 'required');
        if ($this->form_validation->run()) {
            $params = array(
                'namaKelompok' => $this->input->post('namaKelompok'),
                'kodeGol' => $this->input->post('kodeGol'),
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
            );
            $relation = [
                [
                    'table' => 'golongan',
                    'field' => ['namaGolongan'],
                    'pk' => 'id',
                    'valuePk' => $this->input->post('kodeGol'),
                ]
            ];
            $text = text('Insert', 'kelompok', ['namaKelompok', 'kodeGol'], $relation, $_POST, []);
            $kelompok_id = $this->Kelompok_model->add_kelompok($params, $text);
            if ($kelompok_id) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('kelompok/index');
        } else {
            $data['golongan_'] = $this->Golongan_model->get_all_golongan_();
            $data['_view'] = 'administrator/kelompok/add';
            $this->load->view('administrator/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['kelompok'] = $this->Kelompok_model->get_kelompok($id);
        if (isset($data['kelompok']['id'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('namaKelompok', 'namaKelompok', 'required|max_length[100]');
            $this->form_validation->set_rules('kodeGol', 'Kode Golongan', 'required');
            if ($this->form_validation->run()) {
                $params = array(
                    'namaKelompok' => $this->input->post('namaKelompok'),
                    'updatedAt' => date('Y-m-d H:i:s'),
                    'kodeGol' => $this->input->post('kodeGol'),
                );
                $relation = [
                    [
                        'table' => 'golongan',
                        'field' => ['namaGolongan'],
                        'pk' => 'id',
                        'valuePk' => $this->input->post('kodeGol'),
                    ]
                ];
                $text = text('Update', 'kelompok', ['namaKelompok', 'kodeGol'], $relation, $data['kelompok'], $_POST);
                if ($text != '') {
                    $kelompok_id = $this->Kelompok_model->update_kelompok($id, $params, $text);
                    if ($kelompok_id) {
                        alert('success', 'Berhasil...', 'Berhasil mengubah data');
                    } else {
                        alert('error', 'Gagal...', 'Gagal mengubah data');
                    }
                } else {
                    alert('info', 'Ubah ?', 'Tidak ada data yang diubah');
                }
                redirect('kelompok/index');
            } else {
                $data['golongan_'] = $this->Golongan_model->get_all_golongan_();
                $data['_view'] = 'administrator/kelompok/edit';
                $this->load->view('administrator/layouts/main', $data);
            }
        } else {
            alert('error', 'Gagal...', 'Data yang ingin diubah tidak ditemukan');
            redirect('kelompok/index');
            die;
        }
    }
    function remove($id)
    {
        $kelompok = $this->Kelompok_model->get_kelompok($id);
        if (isset($kelompok['id'])) {
            $cek = $this->Global_model->get_data('sub_kelompok', ['kodeKelompok' => $id], false);
            if ($cek == null) {
                $text = text('Delete', 'kelompok', ['id', 'namaKelompok', 'kodeGol'], [], $kelompok, []);
                $kelompok_id = $this->Kelompok_model->delete_kelompok($id, $text);
                if ($kelompok_id) {
                    alert('success', 'Berhasil...', 'Berhasil menghapus data');
                } else {
                    alert('error', 'Gagal...', 'Gagal menghapus data');
                }
                redirect('kelompok/index');
                die;
            } else {
                alert('error', 'Gagal...', 'Tidak diizinkan untuk menghapus data yang sedang digunakan!');
                redirect('kelompok/index');
                die;
            }
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('kelompok/index');
            die;
        }
    }
}
