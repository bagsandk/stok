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
        $data['_view'] = 'administrator/dashboard';
		$this->load->view('administrator/layouts/main', $data);
    }
}
