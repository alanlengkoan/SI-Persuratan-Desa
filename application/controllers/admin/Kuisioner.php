<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuisioner extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_kuisioner');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Kuisioner',
            'content' => 'admin/kuisioner/view',
            'css'     => 'admin/kuisioner/css/view',
            'js'      => 'admin/kuisioner/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk halaman hasil
    public function hasil()
    {
        $id_kuisioner = base64url_decode($this->uri->segment('4'));

        $data = [
            'halaman' => 'Hasil Kuisioner',
            'data'    => $this->m_kuisioner->getHasil($id_kuisioner),
            'content' => 'admin/kuisioner/hasil',
            'css'     => 'admin/kuisioner/css/hasil',
            'js'      => 'admin/kuisioner/js/hasil'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    public function detail()
    {
        $get      = $this->input->get(NULL, TRUE);
        $get_soal = $this->m_kuisioner->getWhereSoal($get['id_kuisioner']);

        foreach ($get_soal->result() as $row) {
            $soal[$row->id_kuisioner_soal] = [
                1 => $row->pil_a,
                2 => $row->pil_b,
                3 => $row->pil_c,
                4 => $row->pil_d,
                5 => $row->pil_e,
            ];
        }

        $data = [
            'halaman' => 'Hasil Kuisioner',
            'data'    => $this->m_kuisioner->getCheckHasil($get['id_kuisioner'], $get['id_siswa']),
            'soal'    => $soal,
            'content' => 'admin/kuisioner/detail',
            'css'     => 'admin/kuisioner/css/detail',
            'js'      => 'admin/kuisioner/js/detail'
        ];

        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_jadwal_dt()
    {
        return $this->m_kuisioner->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_kuisioner', ['id_kuisioner' => $post['id']]);
        $response = [
            'id_kuisioner' => $result['id_kuisioner'],
            'nama'         => $result['nama'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpidkuisioner'])) {
            $data = [
                'id_kuisioner' => acak_id('tb_kuisioner', 'id_kuisioner'),
                'nama'         => $post['inpnama'],
            ];

            $this->crud->i('tb_kuisioner', $data);
        } else {
            $data = [
                'id_kuisioner' => $post['inpidkuisioner'],
                'nama'         => $post['inpnama'],
            ];

            $this->crud->u('tb_kuisioner', $data, ['id_kuisioner' => $post['inpidkuisioner']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_kuisioner', $post['id'], 'id_kuisioner');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk tambah soal kuisioner
    public function add()
    {
        $id_kuisioner = base64url_decode($this->uri->segment('4'));

        $data = [
            'halaman'   => 'Soal Kuisioner',
            'kuisioner' => $this->m_kuisioner->getDetail($id_kuisioner),
            'content'   => 'admin/kuisioner/add',
            'css'       => 'admin/kuisioner/css/add',
            'js'        => 'admin/kuisioner/js/add'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data soal kuisioner by datatable
    public function get_data_kuisioner_soal_dt()
    {
        $id_kuisioner = base64url_decode($this->uri->segment('4'));

        return $this->m_kuisioner->getAllDataKuisionerSoalDt($id_kuisioner);
    }

    // untuk get data by id
    public function get_soal()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_kuisioner_soal', ['id_kuisioner_soal' => $post['id']]);
        $response = [
            'id_kuisioner_soal' => $result['id_kuisioner_soal'],
            'id_kuisioner'      => $result['id_kuisioner'],
            'soal'              => $result['soal'],
            'pil_a'             => $result['pil_a'],
            'pil_b'             => $result['pil_b'],
            'pil_c'             => $result['pil_c'],
            'pil_d'             => $result['pil_d'],
            'pil_e'             => $result['pil_e'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save_soal()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpidkuisionersoal'])) {
            $data = [
                'id_kuisioner_soal' => acak_id('tb_kuisioner_soal', 'id_kuisioner_soal'),
                'id_kuisioner'      => $post['inpidkuisioner'],
                'soal'              => $post['inpsoal'],
                'pil_a'             => $post['inppila'],
                'pil_b'             => $post['inppilb'],
                'pil_c'             => $post['inppilc'],
                'pil_d'             => $post['inppild'],
                'pil_e'             => $post['inppile'],
            ];

            $this->crud->i('tb_kuisioner_soal', $data);
        } else {
            $data = [
                'id_kuisioner_soal' => $post['inpidkuisionersoal'],
                'id_kuisioner'      => $post['inpidkuisioner'],
                'soal'              => $post['inpsoal'],
                'pil_a'             => $post['inppila'],
                'pil_b'             => $post['inppilb'],
                'pil_c'             => $post['inppilc'],
                'pil_d'             => $post['inppild'],
                'pil_e'             => $post['inppile'],
            ];

            $this->crud->u('tb_kuisioner_soal', $data, ['id_kuisioner_soal' => $post['inpidkuisionersoal']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses hapus data
    public function process_del_soal()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_kuisioner_soal', $post['id'], 'id_kuisioner_soal');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }
}
