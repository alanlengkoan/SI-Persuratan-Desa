<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_guru');
        $this->load->model('m_users');
        $this->load->model('m_agama');
        $this->load->model('m_jabatan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Guru',
            'agama'   => $this->m_agama->getAll(),
            'jabatan' => $this->m_jabatan->getAll(),
            'content' => 'admin/guru/view',
            'css'     => 'admin/guru/css/view',
            'js'      => 'admin/guru/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data guru
    public function get_data_guru_dt()
    {
        return $this->m_guru->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_guru', ['id_guru' => $post['id']]);
        $response = [
            'id_guru'    => $result['id_guru'],
            'id_agama'   => $result['id_agama'],
            'id_jabatan' => $result['id_jabatan'],
            'nip'        => $result['nip'],
            'nama'       => $result['nama'],
            'kelamin'    => $result['kelamin'],
            'alamat'     => $result['alamat'],
            'pendidikan' => $result['pendidikan'],
            'thn_masuk'  => $result['thn_masuk'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpidguru'])) {
            $data = [
                'id_guru'    => acak_id('tb_guru', 'id_guru'),
                'id_agama'   => $post['inpidagama'],
                'id_jabatan' => $post['inpidjabatan'],
                'nip'        => $post['inpnip'],
                'nama'       => $post['inpnama'],
                'kelamin'    => $post['inpkelamin'],
                'alamat'     => $post['inpalamat'],
                'pendidikan' => $post['inppendidikan'],
                'thn_masuk'  => $post['inpthnmasuk'],
            ];

            $this->crud->i('tb_guru', $data);
        } else {
            $data = [
                'id_guru'    => $post['inpidguru'],
                'id_agama'   => $post['inpidagama'],
                'id_jabatan' => $post['inpidjabatan'],
                'nip'        => $post['inpnip'],
                'nama'       => $post['inpnama'],
                'kelamin'    => $post['inpkelamin'],
                'alamat'     => $post['inpalamat'],
                'pendidikan' => $post['inppendidikan'],
                'thn_masuk'  => $post['inpthnmasuk'],
            ];

            $this->crud->u('tb_guru', $data, ['id_guru' => $post['inpidguru']]);
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
        $this->crud->d('tb_guru', $post['id'], 'id_guru');
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
