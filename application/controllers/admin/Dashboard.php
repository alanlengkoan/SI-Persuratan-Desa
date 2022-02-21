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
        $this->load->model('m_guru');
        $this->load->model('m_siswa');
	}

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Dashboard Admin',
            'guru'    => $this->m_guru->getAll(),
            'aktif'   => $this->m_siswa->getAllSiswaStatus('0'),
            'alumni'  => $this->m_siswa->getAllSiswaStatus('1'),
            'content' => 'admin/dashboard/view',
            'css'     => '',
            'js'      => ''
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }
}
