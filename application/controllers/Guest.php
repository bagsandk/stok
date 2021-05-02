<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if($this->session->userdata('isLogIn') != true){
        //     redirect('auth/logout');
        // }
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
        $data['_view'] = 'guest/dashboard';
        $this->load->view('guest/layouts/main', $data);
    }

    function test()
    {
        $this->load->library('pdf');
        $pdf = new FPDF('L', 'mm', [40, 58]);
        // membuat halaman baru
        $pdf->SetMargins(0,2,0);
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 9);
        // mencetak string 
        $pdf->Image(base_url('assets/img/0003-BAAK-IV-2021').'.png',18,6.0,20,20);
        $pdf->Cell(0, 5, '0003-BAAK-IV-2021', 0, 0, 'C');
        $pdf->Output("F","C:/xampp/htdocs/stok/assets/pdf/0003-BAAK-IV-2021.pdf");


        // $this->load->library('pdf');
        // $pdf = new FPDF('P', 'mm', [40, 30]);
        // // membuat halaman baru
        // $pdf->AddPage();
        // // setting jenis font yang akan digunakan
        // $pdf->SetFont('Arial', 'B', 8);
        // $pdf->SetTopMargin(4);
        // // mencetak string 
        // $pdf->Cell(0, 0, '0003-BAAK-IV-2021', 0, 1, 'C');
        // $pdf->Image(base_url('assets/img/0003-BAAK-IV-2021').'.png',5,14,20,20);
        // $pdf->Output();
    }
}
