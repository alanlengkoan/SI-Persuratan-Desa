<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_dashboard');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Dashboard Admin', 'dashboard', 'view');
    }

    // untuk penduduk
    public function get_penduduk()
    {
        $res = [
            [
                'name' => 'Laki - laki',
                'y'    => (int) $this->m_dashboard->getPenduduk('L')->sum_gender,
            ],
            [
                'name' => 'Perempuan',
                'y'    => (int) $this->m_dashboard->getPenduduk('P')->sum_gender,
            ]
        ];

        $response = ['data' => $res];
        // untuk response json
        $this->_response($response);
    }

    // untuk pekerjaan
    public function get_pekerjaan()
    {
        $get = $this->m_dashboard->getPekerjaan();
        $num = $get->num_rows();
        $res = [];
        if ($num > 0) {
            foreach ($get->result() as $row) {
                $res[] = [
                    'name' => $row->nama,
                    'y'    => (int) $row->count,
                ];
            }
        }

        $response = ['data' => $res];
        // untuk response json
        $this->_response($response);
    }

    // untuk umur
    public function get_umur()
    {
        $get = $this->m_dashboard->getUmur();
        $num = $get->num_rows();
        $res = [];
        $get_age = [];
        $age = [
            "0 - 4",
            "5 - 9",
            "10 - 14",
            "15 - 19",
            "20 - 24",
            "25 - 29",
            "30 - 34",
            "35 - 39",
            "40 - 44",
            "45 - 49",
            "50 - 54",
            "55 - 59",
            "60 - 64",
            "65 - 69",
            "70 - 74",
            "75",
        ];
        if ($num > 0) {
            for ($i = 0; $i < count($age); $i++) {
                $parsing = explode("-", $age[$i]);
                foreach ($get->result() as $row) {
                    $umur = count_age($row->tgl_lahir);
                    $prev = preg_replace("/[^0-9]/", "", $parsing[0]);
                    $next = preg_replace("/[^0-9]/", "", $parsing[1] ?? 0);
                    if ($umur >= $prev && $umur <= $next) {
                        $get_age[$age[$i]][] = $umur;
                    }
                }
            }
        }

        foreach ($age as $value) {
            $res[] = [
                'name' => $value,
                'y'    => (int) (empty($get_age[$value]) ? 0 : count($get_age[$value])),
            ];
        }

        $response = ['data' => $res];
        // untuk response json
        $this->_response($response);
    }

    // untuk kategori umur
    public function get_umur_kategori()
    {
        $get = $this->m_dashboard->getUmur();
        $num = $get->num_rows();
        $res = [];
        $get_age = [];
        $age = [
            "0 - 15 (Anak-anak)",
            "16 - 24 (Muda)",
            "25 - 34 (Pekerja Awal)",
            "35 - 44 (Paruh Baya)",
            "45 - 54 (Pra-Pensiun)",
            "55 - 64 (Pensiun)",
            "65 (Lanjut Usia)",
        ];
        if ($num > 0) {
            for ($i = 0; $i < count($age); $i++) {
                $parsing = explode("-", $age[$i]);
                foreach ($get->result() as $row) {
                    $umur = count_age($row->tgl_lahir);
                    $prev = preg_replace("/[^0-9]/", "", $parsing[0]);
                    $next = preg_replace("/[^0-9]/", "", $parsing[1] ?? 0);
                    if ($umur >= $prev && $umur <= $next) {
                        $get_age[$age[$i]][] = $umur;
                    }
                }
            }
        }

        foreach ($age as $value) {
            $res[] = [
                'name' => $value,
                'y'    => (int) (empty($get_age[$value]) ? 0 : count($get_age[$value])),
            ];
        }

        $response = ['data' => $res];
        // untuk response json
        $this->_response($response);
    }
}
