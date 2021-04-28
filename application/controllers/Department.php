<?php
class Department extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isLogIn') != true) {
            redirect('auth/logout');
        }
        $this->load->model('Department_model');
        $this->load->model('Global_model');
    }
    function index()
    {
        $data['department'] = $this->Department_model->get_all_department();
        $data['_view'] = 'administrator/department/index';
        $this->load->view('administrator/layouts/main', $data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nameShort', 'Nama Pendek', 'required|is_unique[department.nameShort]');
        $this->form_validation->set_rules('nameLong', 'Nama Panjang', 'required|max_length[100]');
        if ($this->form_validation->run()) {
            $params = array(
                'nameShort' => $this->input->post('nameShort'),
                'nameLong' => $this->input->post('nameLong'),
            );
            $text = text('Insert', 'department', ['nameShort', 'nameLong'], [], $_POST, []);

            $department = $this->Department_model->add_department($params, $text);
            if ($department) {
                alert('success', 'Berhasil...', 'Berhasil menambahkan data');
            } else {
                alert('error', 'Gagal...', 'Gagal menambahkan data');
            }
            redirect('department/index');
        } else {
            $data['_view'] = 'administrator/department/add';
            $this->load->view('administrator/layouts/main', $data);
        }
    }
    function edit($id)
    {
        $data['department'] = $this->Department_model->get_department($id);
        if (isset($data['department']['nameShort'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nameShort', 'Nama Pendek', 'required|is_unique[department.nameShort.nameShort.' . $data['department']['nameShort'] . ']');
            $this->form_validation->set_rules('nameLong', 'Nama Panjang', 'required|max_length[100]');
            if ($this->form_validation->run()) {
                $params = array(
                    'nameShort' => $this->input->post('nameShort'),
                    'nameLong' => $this->input->post('nameLong'),
                );
                $text = text('Update', 'department', ['nameShort', 'nameLong'], [], $data['department'], $_POST);
                if ($text != '') {
                    $department = $this->Department_model->update_department($id, $params, $text);
                    if ($department) {
                        alert('success', 'Berhasil...', 'Berhasil mengubah data');
                    } else {
                        alert('error', 'Gagal...', 'Gagal mengubah data');
                    }
                } else {
                    alert('info', 'Ubah ?', 'Tidak ada data yang diubah');
                }
                redirect('department/index');
                die;
            } else {
                $data['_view'] = 'administrator/department/edit';
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
        $department = $this->Department_model->get_department($id);
        if (isset($department['nameShort'])) {
            $text = text('Delete', 'department', ['nameShort', 'nameLong'], [], $department, []);
            $department = $this->Department_model->delete_department($id, $text);
            if ($department) {
                alert('success', 'Berhasil...', 'Berhasil menghapus data');
            } else {
                alert('error', 'Gagal...', 'Gagal menghapus data');
            }
            redirect('department/index');
            die;
        } else {
            alert('error', 'Gagal...', 'Data yang ingin dihapus tidak ditemukan');
            redirect('department/index');
            die;
        }
    }
}
