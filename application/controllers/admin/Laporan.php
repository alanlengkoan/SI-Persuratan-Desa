<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_surat_masuk');
        $this->load->model('m_surat_keluar');
        $this->load->model('m_keluarga_anggota');
    }

    public function surat_masuk()
    {
        // untuk load view
        $this->template->load('admin', 'Laporan Surat Masuk', 'laporan/surat_masuk', 'view');
    }

    public function get_data_surat_masuk_dt()
    {
        $this->m_surat_masuk->getAllDataDt();
    }

    public function surat_keluar()
    {
        // untuk load view
        $this->template->load('admin', 'Laporan Surat Keluar', 'laporan/surat_keluar', 'view');
    }

    public function get_data_surat_keluar_dt()
    {
        $this->m_surat_keluar->getAllDataDt();
    }

    public function penduduk()
    {
        // untuk load view
        $this->template->load('admin', 'Laporan Penduduk', 'laporan/penduduk', 'view');
    }

    public function get_data_penduduk_dt()
    {
        $this->m_keluarga_anggota->getAllDataDt();
    }
}
