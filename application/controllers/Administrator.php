<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Global_model');
    }

    public function index()
    {
        $data['history'] = $this->db
            ->join('users', 'users.user_id=history.user_id')
            ->order_by('log_date', 'DESC')
            ->limit(7)
            ->get_where('history', ['history.user_id' => $this->session->userdata('user_id')])->result_array();
        $data['insert'] = count($this->Global_model->get_data('history', ['history.user_id' => $this->session->userdata('user_id'), 'type' => 'Insert']));
        $data['update'] = count($this->Global_model->get_data('history', ['history.user_id' => $this->session->userdata('user_id'), 'type' => 'Update']));
        $data['delete'] = count($this->Global_model->get_data('history', ['history.user_id' => $this->session->userdata('user_id'), 'type' => 'Delete']));
        $data['_view'] = 'administrator/dashboard';
        $this->load->view('administrator/layouts/main', $data);
    }
}
