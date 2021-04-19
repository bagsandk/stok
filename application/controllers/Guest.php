<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Global_model');
    }

    public function index()
    {
        $data['_view'] = 'guest/dashboard';
		$this->load->view('guest/layouts/main', $data);
    }
}
