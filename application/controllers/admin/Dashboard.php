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
            'guru'    => 0,
            'aktif'   => 0,
            'alumni'  => 0,
        ];
        // untuk load view
        $this->template->load('admin', 'Dashboard Admin', 'dashboard', 'view', $data);
    }
}
