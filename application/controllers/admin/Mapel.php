<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_mapel');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Mata Pelajaran',
            'content' => 'admin/mapel/view',
            'css'     => 'admin/mapel/css/view',
            'js'      => 'admin/mapel/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_mapel_dt()
    {
        return $this->m_mapel->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_mapel', ['id_mapel' => $post['id']]);
        $response = [
            'id_mapel' => $result['id_mapel'],
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
        if (empty($post['inpidmapel'])) {
            $data = [
                'id_mapel' => acak_id('tb_mapel', 'id_mapel'),
                'nama'     => $post['inpnama'],
            ];

            $this->crud->i('tb_mapel', $data);
        } else {
            $data = [
                'id_mapel' => $post['inpidmapel'],
                'nama'     => $post['inpnama'],
            ];

            $this->crud->u('tb_mapel', $data, ['id_mapel' => $post['inpidmapel']]);
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
        $this->crud->d('tb_mapel', $post['id'], 'id_mapel');
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
