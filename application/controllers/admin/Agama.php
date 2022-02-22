<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agama extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_agama');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Agama',
        ];
        // untuk load view
        $this->template->load('admin', 'agama', 'view', $data);
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

        $response = $this->crud->gda('tb_agama', ['id_agama' => $post['id']]);

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
        if (empty($post['inpidagama'])) {
            $this->crud->i('tb_agama', $data);
        } else {
            $this->crud->u('tb_agama', $data, ['id_agama' => $post['inpidagama']]);
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
        $this->crud->d('tb_agama', $post['id'], 'id_agama');
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
