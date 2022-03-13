<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
	{
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['users']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_surat_keluar');
	}

    // untuk default
    public function index()
    {
        $data = [
            'surat_sudah_approve' => $this->m_surat_keluar->getApprovalSuratKeluarUsers($this->id_users, '1')->num_rows(),
            'surat_belum_approve' => $this->m_surat_keluar->getApprovalSuratKeluarUsers($this->id_users, '0')->num_rows(),
        ];
        // untuk load view
        $this->template->load('users', 'Dashboard User', 'dashboard', 'view', $data);
    }
}
