<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dana extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_dana');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Dana',
            'content' => 'admin/dana/view',
            'css'     => 'admin/dana/css/view',
            'js'      => 'admin/dana/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data dana
    public function get_data_dana_dt()
    {
        return $this->m_dana->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_dana', ['id_dana' => $post['id']]);
        $response = [
            'id_dana' => $result['id_dana'],
            'nama'    => $result['nama'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpiddana'])) {
            $data = [
                'id_dana' => acak_id('tb_dana', 'id_dana'),
                'nama'    => $post['inpnama'],
            ];

            $this->crud->i('tb_dana', $data);
        } else {
            $data = [
                'id_dana' => $post['inpiddana'],
                'nama'    => $post['inpnama'],
            ];

            $this->crud->u('tb_dana', $data, ['id_dana' => $post['inpiddana']]);
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
        $this->crud->d('tb_dana', $post['id'], 'id_dana');
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
