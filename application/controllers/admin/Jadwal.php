<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_kelas');
        $this->load->model('m_mapel');
        $this->load->model('m_jadwal');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Jadwal',
            'content' => 'admin/jadwal/view',
            'css'     => 'admin/jadwal/css/view',
            'js'      => 'admin/jadwal/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_jadwal_dt()
    {
        return $this->m_jadwal->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_jadwal', ['id_jadwal' => $post['id']]);
        $response = [
            'id_jadwal' => $result['id_jadwal'],
            'nama'      => $result['nama'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);
        
        $this->db->trans_start();
        if (empty($post['inpidjadwal'])) {
            $data = [
                'id_jadwal' => acak_id('tb_jadwal', 'id_jadwal'),
                'nama'      => $post['inpnama'],
            ];

            $this->crud->i('tb_jadwal', $data);
        } else {
            $data = [
                'id_jadwal' => $post['inpidjadwal'],
                'nama'      => $post['inpnama'],
            ];

            $this->crud->u('tb_jadwal', $data, ['id_jadwal' => $post['inpidjadwal']]);
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
        $this->crud->d('tb_jadwal', $post['id'], 'id_jadwal');
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
            'halaman' => 'Rincian Jadwal',
            'jadwal'  => $this->m_jadwal->getDetail($id_kuisioner),
            'kelas'   => $this->m_kelas->getAll(),
            'mapel'   => $this->m_mapel->getAll(),
            'content' => 'admin/jadwal/add',
            'css'     => 'admin/jadwal/css/add',
            'js'      => 'admin/jadwal/js/add'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data soal kuisioner by datatable
    public function get_data_jadwal_rincian_dt()
    {
        $id_jadwal = base64url_decode($this->uri->segment('4'));

        return $this->m_jadwal->getAllDataJadwalRincianDt($id_jadwal);
    }

    // untuk get data by id
    public function get_rincian()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_jadwal_rincian', ['id_jadwal_rincian' => $post['id']]);
        $response = [
            'id_jadwal_rincian' => $result['id_jadwal_rincian'],
            'id_jadwal'         => $result['id_jadwal'],
            'id_kelas'          => $result['id_kelas'],
            'id_mapel'          => $result['id_mapel'],
            'tanggal'           => $result['tanggal'],
            'jam_mulai'         => $result['jam_mulai'],
            'jam_selesai'       => $result['jam_selesai'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save_rincian()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpidjadwalrincian'])) {
            $data = [
                'id_jadwal_rincian' => acak_id('tb_jadwal_rincian', 'id_jadwal_rincian'),
                'id_jadwal'         => $post['inpidjadwal'],
                'id_kelas'          => $post['inpidkelas'],
                'id_mapel'          => $post['inpidmapel'],
                'tanggal'           => $post['inptgl'],
                'jam_mulai'         => $post['inpjammulai'],
                'jam_selesai'       => $post['inpjamselesai'],
            ];

            $this->crud->i('tb_jadwal_rincian', $data);
        } else {
            $data = [
                'id_jadwal_rincian' => $post['inpidjadwalrincian'],
                'id_jadwal'         => $post['inpidjadwal'],
                'id_kelas'          => $post['inpidkelas'],
                'id_mapel'          => $post['inpidmapel'],
                'tanggal'           => $post['inptgl'],
                'jam_mulai'         => $post['inpjammulai'],
                'jam_selesai'       => $post['inpjamselesai'],
            ];

            $this->crud->u('tb_jadwal_rincian', $data, ['id_jadwal_rincian' => $post['inpidjadwalrincian']]);
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
    public function process_del_rincian()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_jadwal_rincian', $post['id'], 'id_jadwal_rincian');
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
