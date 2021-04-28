<?php
class Gedung extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isLogIn') != true) {
            redirect('auth/logout');
        }
        $this->load->model('Gedung_model');
        $this->load->model('Global_model');
    }
    function index()
    {
        $data['gedung'] = $this->Gedung_model->get_all_gedung();
        $data['_view'] = 'administrator/gedung/index';
        $this->load->view('administrator/layouts/main', $data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('namaGedung', 'Nama Gedung', 'required|is_unique[gedung.namaGedung]');
        $this->form_validation->set_rules('thnPembangunan', 'Tahun Pembangunan', 'required|max_length[100]');
        $this->form_validation->set_rules('luasGedung', 'Luas Gedung', 'required|max_length[100]');
        $this->form_validation->set_rules('alamatGedung', 'Alamat Gedung', 'required|max_length[100]');
        $this->form_validation->set_rules('jmlLantai', 'Jumlah Lantai', 'required|max_length[100]');
        $this->form_validation->set_rules('jmlRuangan', 'Jumlah Ruangan', 'required|max_length[100]');
        if ($this->form_validation->run()) {
            $params = array(
                'namaGedung' => $this->input->post('namaGedung'),
                'thnPembangunan' => $this->input->post('thnPembangunan'),
                'luasGedung' => $this->input->post('luasGedung'),
                'alamatGedung' => $this->input->post('alamatGedung'),
                'jmlLantai' => $this->input->post('jmlLantai'),
                'jmlRuangan' => $this->input->post('jmlRuangan'),
            );
            $text = text('Insert', 'gedung', ['namaGedung', 'thnPembangunan','luasGedung','alamatGedung','jmlLantai','jmlRuangan'], [], $_POST, []);

            $gedung = $this->Gedung_model->add_gedung($params, $text);
            if ($gedung) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('gedung/index');
        } else {
            $data['_view'] = 'administrator/gedung/add';
            $this->load->view('administrator/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['gedung'] = $this->Gedung_model->get_gedung($id);
        if (isset($data['gedung']['id'])) {
            $this->form_validation->set_rules('namaGedung', 'Nama Gedung', 'required');
            $this->form_validation->set_rules('thnPembangunan', 'Tahun Pembangunan', 'required|max_length[100]');
            $this->form_validation->set_rules('luasGedung', 'Luas Gedung', 'required|max_length[100]');
            $this->form_validation->set_rules('alamatGedung', 'Alamat Gedung', 'required|max_length[100]');
            $this->form_validation->set_rules('jmlLantai', 'Jumlah Lantai', 'required|max_length[100]');
            $this->form_validation->set_rules('jmlRuangan', 'Jumlah Ruangan', 'required|max_length[100]');
            if ($this->form_validation->run()) {
                $params = array(
                    'namaGedung' => $this->input->post('namaGedung'),
                    'thnPembangunan' => $this->input->post('thnPembangunan'),
                    'luasGedung' => $this->input->post('luasGedung'),
                    'alamatGedung' => $this->input->post('alamatGedung'),
                    'jmlLantai' => $this->input->post('jmlLantai'),
                    'jmlRuangan' => $this->input->post('jmlRuangan'),
                );
                $text = text('Update', 'gedung', ['namaGedung', 'thnPembangunan','luasGedung','alamatGedung','jmlLantai','jmlRuangan'], [], $data['gedung'], $_POST);
                if ($text != '') {
                    $gedung = $this->Gedung_model->update_gedung($id, $params, $text);
                    if ($gedung) {
                        alert('success', 'Berhasil...', 'Berhasil mengubah data');
                    } else {
                        alert('error', 'Gagal...', 'Gagal mengubah data');
                    }
                } else {
                    alert('info', 'Ubah ?', 'Tidak ada data yang diubah');
                }
                redirect('gedung/index');
                die;
            } else {
                $data['_view'] = 'administrator/gedung/edit';
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
        $gedung = $this->Gedung_model->get_gedung($id);
        if (isset($gedung['nameShort'])) {
            $text = text('Delete', 'gedung', ['nameShort', 'nameLong'], [], $gedung, []);
            $gedung = $this->Gedung_model->delete_gedung($id, $text);
            if ($gedung) {
                alert('success', 'Berhasil...', 'Berhasil menghapus data');
            } else {
                alert('error', 'Gagal...', 'Gagal menghapus data');
            }
            redirect('gedung/index');
            die;
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('gedung/index');
            die;
        }
    }
}
