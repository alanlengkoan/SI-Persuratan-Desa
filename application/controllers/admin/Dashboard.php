<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
	{
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
	}

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Dashboard Admin',
            'guru'    => 0,
            'aktif'   => 0,
            'alumni'  => 0,
            'content' => 'admin/dashboard/view',
            'css'     => '',
            'js'      => ''
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }
}