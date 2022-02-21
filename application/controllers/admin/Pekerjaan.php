<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pekerjaan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pekerjaan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Pekerjaan',
            'content' => 'admin/pekerjaan/view',
            'css'     => 'admin/pekerjaan/css/view',
            'js'      => 'admin/pekerjaan/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data
    public function get_data_pekerjaan_dt()
    {
        return $this->m_pekerjaan->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_pekerjaan', ['id_pekerjaan' => $post['id']]);

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
        if (empty($post['inpidpekerjaan'])) {
            $this->crud->i('tb_pekerjaan', $data);
        } else {
            $this->crud->u('tb_pekerjaan', $data, ['id_pekerjaan' => $post['inpidpekerjaan']]);
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
        $this->crud->d('tb_pekerjaan', $post['id'], 'id_pekerjaan');
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
