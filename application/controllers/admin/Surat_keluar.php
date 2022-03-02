<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_surat_tujuan');
        $this->load->model('m_surat_sifat');
        $this->load->model('m_surat_jenis');
        $this->load->model('m_surat_keluar');
    }

    // untuk default
    public function index()
    {
        $data = [
            'jenis_surat'  => $this->m_surat_jenis->getAll(),
            'tujuan_surat' => $this->m_surat_tujuan->getAll(),
            'sifat_surat'  => $this->m_surat_sifat->getAll(),
        ];
        // untuk load view
        $this->template->load('admin', 'Surat Keluar', 'surat_keluar', 'view', $data);
    }

    // untuk halaman detail
    public function detail()
    {
        $id_surat_keluar = base64url_decode($this->uri->segment(4));

        $data = [
            'data' => $this->m_surat_keluar->getDetail($id_surat_keluar),
        ];
        // untuk load view
        $this->template->load('admin', 'Detail Surat Keluar', 'surat_keluar', 'detail', $data);
    }

    public function print()
    {
        $id_surat_keluar = base64url_decode($this->uri->segment(4));

        $data = [
            'title'  => 'Surat Keluar',
            'detail' => $this->m_surat_keluar->getDetail($id_surat_keluar),
        ];
        // untuk load view
        $this->pdf->setPaper('legal', 'potrait');
        $this->pdf->cetakPdf('Surat', 'admin/surat_keluar/print', $data);
    }

    // untuk get data
    public function get_data_surat_keluar_dt()
    {
        $this->m_surat_keluar->getAllDataDt();
    }
}