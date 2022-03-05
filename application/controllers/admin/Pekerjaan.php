<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pekerjaan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pekerjaan');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Pekerjaan', 'pekerjaan', 'view');
    }

    // untuk get data
    public function get_data_pekerjaan_dt()
    {
        $this->m_pekerjaan->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $message = $this->crud->gda('tb_pekerjaan', ['id_pekerjaan' => $post['id']]);

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
        if (empty($post['inpidpekerjaan'])) {
            $this->crud->i('tb_pekerjaan', $data);
        } else {
            $this->crud->u('tb_pekerjaan', $data, ['id_pekerjaan' => $post['inpidpekerjaan']]);
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

        $check = checking_data('si_persuratan_desa', 'tb_pekerjaan', 'id_pekerjaan', $post['id']);

        if ($check > 0) {
            $message = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();
            $this->crud->d('tb_pekerjaan', $post['id'], 'id_pekerjaan');
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
