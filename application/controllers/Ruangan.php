<?php
class Ruangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isLogIn') != true) {
            redirect('auth/logout');
        }
        $this->load->model('Ruangan_model');
        $this->load->model('Gedung_model');
        $this->load->model('Global_model');
    }
    function index()
    {
        $data['ruangan'] = $this->Ruangan_model->get_all_ruangan();
        $data['_view'] = 'administrator/ruangan/index';
        $this->load->view('administrator/layouts/main', $data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama ruangan', 'required');
        $this->form_validation->set_rules('jenisRuangan', 'Jenis Ruangan', 'required|max_length[100]');
        $this->form_validation->set_rules('posisiRuangan', 'Posisi ruangan', 'required|max_length[100]');
        $this->form_validation->set_rules('ukuranRuangan', 'Ukuran ruangan', 'required|max_length[100]');
        $this->form_validation->set_rules('kapasitasRuangan', 'Kapasitas', 'required|max_length[100]');
        $this->form_validation->set_rules('gedungId', 'Gedung', 'required|max_length[100]');
        if ($this->form_validation->run()) {
            $params = array(
                'nama' => $this->input->post('nama'),
                'jenisRuangan' => $this->input->post('jenisRuangan'),
                'posisiRuangan' => $this->input->post('posisiRuangan'),
                'ukuranRuangan' => $this->input->post('ukuranRuangan'),
                'kapasitasRuangan' => $this->input->post('kapasitasRuangan'),
                'gedungId' => $this->input->post('gedungId'),
            );
            $text = text('Insert', 'ruangan', ['nama', 'posisiRuangan', 'ukuranRuangan', 'kapasitasRuangan', 'gedungId'], [], $_POST, []);

            $ruangan = $this->Ruangan_model->add_ruangan($params, $text);
            if ($ruangan) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('ruangan/index');
        } else {
            $data['gedung'] = $this->Gedung_model->get_all_gedung();
            $data['_view'] = 'administrator/ruangan/add';
            $this->load->view('administrator/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['ruangan'] = $this->Ruangan_model->get_ruangan($id);
        if (isset($data['ruangan']['id'])) {
            $this->form_validation->set_rules('nama', 'Nama ruangan', 'required');
            $this->form_validation->set_rules('jenisRuangan', 'Jenis Ruangan', 'required|max_length[100]');
            $this->form_validation->set_rules('posisiRuangan', 'Luas ruangan', 'required|max_length[100]');
            $this->form_validation->set_rules('ukuranRuangan', 'Alamat ruangan', 'required|max_length[100]');
            $this->form_validation->set_rules('kapasitasRuangan', 'Jumlah Lantai', 'required|max_length[100]');
            $this->form_validation->set_rules('gedungId', 'Gedung', 'required|max_length[100]');
            if ($this->form_validation->run()) {
                $params = array(
                    'nama' => $this->input->post('nama'),
                    'jenisRuangan' => $this->input->post('jenisRuangan'),
                    'posisiRuangan' => $this->input->post('posisiRuangan'),
                    'ukuranRuangan' => $this->input->post('ukuranRuangan'),
                    'kapasitasRuangan' => $this->input->post('kapasitasRuangan'),
                    'gedungId' => $this->input->post('gedungId'),
                );
                $text = text('Update', 'ruangan', ['nama', 'jenisRuangan', 'posisiRuangan', 'ukuranRuangan', 'kapasitasRuangan', 'gedungId'], [], $data['ruangan'], $_POST);
                if ($text != '') {
                    $ruangan = $this->Ruangan_model->update_ruangan($id, $params, $text);
                    if ($ruangan) {
                        alert('success', 'Berhasil...', 'Berhasil mengubah data');
                    } else {
                        alert('error', 'Gagal...', 'Gagal mengubah data');
                    }
                } else {
                    alert('info', 'Ubah ?', 'Tidak ada data yang diubah');
                }
                redirect('ruangan/index');
                die;
            } else {
                $data['gedung'] = $this->Gedung_model->get_all_gedung();

                $data['_view'] = 'administrator/ruangan/edit';
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
        $ruangan = $this->Ruangan_model->get_ruangan($id);
        if (isset($ruangan['nameShort'])) {
            $text = text('Delete', 'ruangan', ['nameShort', 'nameLong'], [], $ruangan, []);
            $ruangan = $this->Ruangan_model->delete_ruangan($id, $text);
            if ($ruangan) {
                alert('success', 'Berhasil...', 'Berhasil menghapus data');
            } else {
                alert('error', 'Gagal...', 'Gagal menghapus data');
            }
            redirect('ruangan/index');
            die;
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('ruangan/index');
            die;
        }
    }
}
