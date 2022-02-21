<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_kelas');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Kelas',
            'content' => 'admin/kelas/view',
            'css'     => 'admin/kelas/css/view',
            'js'      => 'admin/kelas/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_kelas_dt()
    {
        return $this->m_kelas->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_kelas', ['id_kelas' => $post['id']]);
        $response = [
            'id_kelas' => $result['id_kelas'],
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
        if (empty($post['inpidkelas'])) {
            $data = [
                'id_kelas' => acak_id('tb_kelas', 'id_kelas'),
                'nama'     => $post['inpnama'],
            ];

            $this->crud->i('tb_kelas', $data);
        } else {
            $data = [
                'id_kelas' => $post['inpidkelas'],
                'nama'     => $post['inpnama'],
            ];

            $this->crud->u('tb_kelas', $data, ['id_kelas' => $post['inpidkelas']]);
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
        $this->crud->d('tb_kelas', $post['id'], 'id_kelas');
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
