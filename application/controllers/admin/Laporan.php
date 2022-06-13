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

    public function surat_masuk_pdf()
    {
        $data = [
            'surat_masuk' => $this->m_surat_masuk->getAll(),
        ];

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('laporan_pembelian', 'admin/laporan/surat_masuk/pdf', $data);
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

    public function surat_keluar_pdf()
    {
        $data = [
            'surat_keluar' => $this->m_surat_keluar->getAll(),
        ];

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('laporan_pembelian', 'admin/laporan/surat_keluar/pdf', $data);
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

    public function penduduk_pdf()
    {
        $data = [
            'penduduk' => $this->m_keluarga_anggota->getAll(),
        ];

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('laporan_pembelian', 'admin/laporan/penduduk/pdf', $data);
    }

    public function get_data_penduduk_dt()
    {
        $this->m_keluarga_anggota->getAllDataDt();
    }
}
