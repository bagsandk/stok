<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isLogIn') != true) {
            redirect('auth/logout');
        }
        $this->load->model('Global_model');
    }

    public function index()
    {
        $data['history'] = $this->db
            ->join('users', 'users.user_id=history.user_id')
            ->order_by('log_date', 'DESC')
            ->limit(7)
            ->get('history')->result_array();
        $data['insert'] = count($this->Global_model->get_data('history', ['type' => 'Insert']));
        $data['update'] = count($this->Global_model->get_data('history', ['type' => 'Update']));
        $data['delete'] = count($this->Global_model->get_data('history', ['type' => 'Delete']));
        $data['_view'] = 'super_admin/dashboard';
        $this->load->view('super_admin/layouts/main', $data);
    }
}
