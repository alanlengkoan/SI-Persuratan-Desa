<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_surat extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_surat_jenis');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Jenis Surat', 'jenis_surat', 'view');
    }

    // untuk get data
    public function get_data_jenis_surat_dt()
    {
        $this->m_surat_jenis->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $message = $this->crud->gda('tb_surat_jenis', ['id_surat_jenis' => $post['id']]);

        // untuk message json
        $this->_response_message($message);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);
        
        $data = [
            'nama' => strip_tags($post['inpnama']),
        ];

        $this->db->trans_start();
        if (empty($post['inpidsuratjenis'])) {
            $this->crud->i('tb_surat_jenis', $data);
        } else {
            $this->crud->u('tb_surat_jenis', $data, ['id_surat_jenis' => $post['inpidsuratjenis']]);
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

        $check = checking_data('tb_surat_jenis', 'id_surat_jenis', $post['id']);

        if ($check > 0) {
            $message = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();
            $this->crud->d('tb_surat_jenis', $post['id'], 'id_surat_jenis');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $message = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }
        // untuk message json
        $this->_response_message($message);
    }
}
