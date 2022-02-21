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
            'content' => 'admin/agama/view',
            'css'     => 'admin/agama/css/view',
            'js'      => 'admin/agama/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data agama
    public function get_data_agama_dt()
    {
        return $this->m_agama->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_agama', ['id_agama' => $post['id']]);
        $response = [
            'id_agama' => $result['id_agama'],
            'nama'     => $result['nama'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpidagama'])) {
            $data = [
                'id_agama' => acak_id('tb_agama', 'id_agama'),
                'nama'       => $post['inpnama'],
            ];

            $this->crud->i('tb_agama', $data);
        } else {
            $data = [
                'id_agama' => $post['inpidagama'],
                'nama'       => $post['inpnama'],
            ];

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
