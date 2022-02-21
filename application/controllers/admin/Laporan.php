<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_guru');
        $this->load->model('m_dana');
        $this->load->model('m_siswa');
        $this->load->model('m_keuangan');
        $this->load->model('m_buku_tamu');
    }

    // untuk default
    public function index()
    {
    }

    // untuk halaman laporan keuangan
    public function l_keuangan()
    {
        $data = [
            'halaman' => 'Laporan Keuangan',
            'dana'    => $this->m_dana->getAll(),
            'content' => 'admin/l_keuangan/view',
            'css'     => '',
            'js'      => 'admin/l_keuangan/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk lihat laporan keuangan
    public function l_keuangan_show()
    {
        $post = $this->input->post(NULL, TRUE);

        $start    = new DateTime($post['tgl_awal']);
        $end      = new DateTime($post['tgl_akhir']);
        $interval = new DateInterval('P1M');
        $period   = new DatePeriod($start, $interval, $end);

        $get = $this->m_keuangan->getReportKeuangan($post['id_dana'], $post['tgl_awal'], $post['tgl_akhir']);
        $num = $get->num_rows();
        $no  = 1;

        if ($num > 0) {
            foreach ($get->result() as $row) {
                foreach ($period as $dt) {
                    $bulan  = $dt->format('m') . PHP_EOL;
                    $kredit[(int) $bulan] = $this->m_keuangan->getReportOutByMonth($row->id_keuangan, $bulan);
                }

                $sisa = ($row->debit - array_sum($kredit));

                $result[] = [
                    'no'         => $no++,
                    'dana'       => $row->dana,
                    'uraian'     => $row->uraian,
                    'keterangan' => '-',
                    'debit'      => $row->debit,
                    'bulan'      => $kredit,
                    'kredit'     => array_sum($kredit),
                    'sisa'       => $sisa,
                ];
            }
        } else {
            foreach ($period as $dt) {
                $bulan  = $dt->format('m') . PHP_EOL;
                $kredit[(int) $bulan] = 0;
            }

            $result[] = [
                'no'         => 'Data Kosong!',
                'dana'       => 'Data Kosong!',
                'uraian'     => 'Data Kosong!',
                'keterangan' => 'Data Kosong!',
                'debit'      => 0,
                'bulan'      => $kredit,
                'kredit'     => 0,
                'sisa'       => 0,
            ];
        }

        $data = [
            'bulan'       => ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'jarak_bulan' => $kredit,
            'halaman'     => "Daftar Keuangan",
            'keuangan'    => $result,
        ];

        // untuk load view
        $this->load->view('admin/l_keuangan/table', $data);
    }

    // untuk export laporan keuangan
    public function l_keuangan_export()
    {
        $post     = $this->input->get(NULL, TRUE);
        
        $start    = new DateTime(base64url_decode($post['tgl_awal']));
        $end      = new DateTime(base64url_decode($post['tgl_akhir']));
        $interval = new DateInterval('P1M');
        $period   = new DatePeriod($start, $interval, $end);

        // untuk dana
        $dana = $this->crud->gda('tb_dana', ['id_dana' => base64url_decode($post['id_dana'])]);

        $get = $this->m_keuangan->getReportKeuangan(base64url_decode($post['id_dana']), base64url_decode($post['tgl_awal']), base64url_decode($post['tgl_akhir']));
        $num = $get->num_rows();
        $no  = 1;

        if ($num > 0) {
            foreach ($get->result() as $row) {
                foreach ($period as $dt) {
                    $bulan  = $dt->format('m') . PHP_EOL;
                    $kredit[(int) $bulan] = $this->m_keuangan->getReportOutByMonth($row->id_keuangan, $bulan);
                }

                $sisa = ($row->debit - array_sum($kredit));

                $result[] = [
                    'no'         => $no++,
                    'dana'       => $row->dana,
                    'uraian'     => $row->uraian,
                    'keterangan' => '-',
                    'debit'      => $row->debit,
                    'bulan'      => $kredit,
                    'kredit'     => array_sum($kredit),
                    'sisa'       => $sisa,
                ];
            }
        } else {
            foreach ($period as $dt) {
                $bulan  = $dt->format('m') . PHP_EOL;
                $kredit[(int) $bulan] = 0;
            }

            $result[] = [
                'no'         => 'Data Kosong!',
                'dana'       => 'Data Kosong!',
                'uraian'     => 'Data Kosong!',
                'keterangan' => 'Data Kosong!',
                'debit'      => 0,
                'bulan'      => $kredit,
                'kredit'     => 0,
                'sisa'       => 0,
            ];
        }

        $data = [
            'bulan'       => ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'jarak_bulan' => $kredit,
            'dana'        => $dana,
            'halaman'     => "Daftar Keuangan",
            'keuangan'    => $result,
        ];

        // untuk load view
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->cetakPdf('laporan_keuangan', 'admin/l_keuangan/print', $data);
    }

    // untuk halaman laporan siswa
    public function l_siswa()
    {
        $data = [
            'halaman' => 'Laporan Siswa',
            'aktif'   => $this->m_siswa->getAllSiswaStatus('0'),
            'alumni'  => $this->m_siswa->getAllSiswaStatus('1'),
            'content' => 'admin/l_siswa/view',
            'css'     => 'admin/l_siswa/css/view',
            'js'      => 'admin/l_siswa/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk halaman laporan guru
    public function l_guru()
    {
        $data = [
            'halaman' => 'Laporan Guru',
            'data'    => $this->m_guru->getAll(),
            'content' => 'admin/l_guru/view',
            'css'     => 'admin/l_guru/css/view',
            'js'      => 'admin/l_guru/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    public function l_buku_tamu()
    {
        $data = [
            'halaman' => 'Laporan Buku Tamu',
            'data'    => $this->m_buku_tamu->getAll(),
            'content' => 'admin/l_buku_tamu/view',
            'css'     => 'admin/l_buku_tamu/css/view',
            'js'      => 'admin/l_buku_tamu/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }
}