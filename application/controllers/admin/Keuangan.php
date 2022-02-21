<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_keuangan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Anggaran',
            'content' => 'admin/keuangan/view',
            'css'     => 'admin/keuangan/css/view',
            'js'      => 'admin/keuangan/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_jadwal_dt()
    {
        return $this->m_keuangan->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_keuangan', ['id_keuangan' => $post['id']]);
        $response = [
            'id_keuangan' => $result['id_keuangan'],
            'nama'      => $result['nama'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpidkeuangan'])) {
            $data = [
                'id_keuangan' => acak_id('tb_keuangan', 'id_keuangan'),
                'nama'        => $post['inpnama'],
            ];

            $this->crud->i('tb_keuangan', $data);
        } else {
            $data = [
                'id_keuangan' => $post['inpidkeuangan'],
                'nama'        => $post['inpnama'],
            ];

            $this->crud->u('tb_keuangan', $data, ['id_keuangan' => $post['inpidkeuangan']]);
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
        $this->crud->d('tb_keuangan', $post['id'], 'id_keuangan');
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
