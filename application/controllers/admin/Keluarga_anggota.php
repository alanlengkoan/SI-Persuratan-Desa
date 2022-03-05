<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluarga_anggota extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_agama');
        $this->load->model('m_keluarga');
        $this->load->model('m_pekerjaan');
        $this->load->model('m_keluarga_anggota');
    }

    // untuk default
    public function index()
    {
        $data = [
            'keluarga'  => $this->m_keluarga->getAll(),
            'agama'     => $this->m_agama->getAll(),
            'pekerjaan' => $this->m_pekerjaan->getAll(),
        ];
        // untuk load view
        $this->template->load('admin', 'Anggota Keluarga', 'keluarga_anggota', 'view', $data);
    }

    // untuk get data
    public function get_data_keluarga_anggota_dt()
    {
        $this->m_keluarga_anggota->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $message = $this->crud->gda('tb_keluarga_anggota', ['id_keluarga_anggota' => $post['id']]);

        // untuk message json
        $this->_response_message($message);
    }

    public function check_no_ktp()
    {
        $post = $this->input->post(NULL, TRUE);

        $q = $post['q'];

        $message = [];

        if ($q) {
            $get = $this->db->query("SELECT * FROM tb_keluarga_anggota WHERE no_ktp LIKE '%$q%'");
            $sum = $get->num_rows();

            if ($sum > 0) {
                $message = ['status' => true];
            } else {
                $message = ['status' => false];
            }
        }
        // untuk message json
        $this->_response_message($message);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'id_agama'        => strip_tags($post['inpidagama']),
            'id_pekerjaan'    => strip_tags($post['inpidpekerjaan']),
            'no_kk'           => strip_tags($post['inpnokk']),
            'no_ktp'          => strip_tags($post['inpnoktp']),
            'nama'            => strip_tags($post['inpnama']),
            'kelamin'         => strip_tags($post['inpkelamin']),
            'tmp_lahir'       => strip_tags($post['inptmplahir']),
            'tgl_lahir'       => strip_tags($post['inptgllahir']),
            'kewarganegaraan' => strip_tags($post['inpkewarganegaraan']),
            'pendidikan'      => strip_tags($post['inppendidikan']),
            'status_nikah'    => strip_tags($post['inpstatusnikah']),
        ];

        $this->db->trans_start();
        if (empty($post['inpidkeluargaanggota'])) {
            $this->crud->i('tb_keluarga_anggota', $data);
        } else {
            $this->crud->u('tb_keluarga_anggota', $data, ['id_keluarga_anggota' => $post['inpidkeluargaanggota']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk message json
        $this->_response_message($message);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_keluarga_anggota', $post['id'], 'id_keluarga_anggota');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $message = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk message json
        $this->_response_message($message);
    }
}
