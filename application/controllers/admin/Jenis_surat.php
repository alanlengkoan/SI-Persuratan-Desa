<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_surat extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_surat_jenis');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Jenis Surat',
        ];
        // untuk load view
        $this->template->load('admin', 'jenis_surat', 'view', $data);
    }

    // untuk get data
    public function get_data_jenis_surat_dt()
    {
        return $this->m_surat_jenis->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_surat_jenis', ['id_surat_jenis' => $post['id']]);

        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);
        
        $data = [
            'nama' => $post['inpnama'],
        ];

        $this->db->trans_start();
        if (empty($post['inpidsuratjenis'])) {
            $this->crud->i('tb_surat_jenis', $data);
        } else {
            $this->crud->u('tb_surat_jenis', $data, ['id_surat_jenis' => $post['inpidsuratjenis']]);
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
        $this->crud->d('tb_surat_jenis', $post['id'], 'id_surat_jenis');
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
