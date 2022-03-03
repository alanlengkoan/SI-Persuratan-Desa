<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agama extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_agama');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Agama', 'agama', 'view');
    }

    // untuk get data agama
    public function get_data_agama_dt()
    {
        $this->m_agama->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $message = $this->crud->gda('tb_agama', ['id_agama' => $post['id']]);

        // untuk message
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
        if (empty($post['inpidagama'])) {
            $this->crud->i('tb_agama', $data);
        } else {
            $this->crud->u('tb_agama', $data, ['id_agama' => $post['inpidagama']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk message
        $this->_response_message($message);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_agama', $post['id'], 'id_agama');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $message = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk message
        $this->_response_message($message);
    }
}
