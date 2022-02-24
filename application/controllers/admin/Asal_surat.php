<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asal_surat extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_surat_asal');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Asal Surat', 'asal_surat', 'view');
    }

    // untuk get data
    public function get_data_asal_surat_dt()
    {
        $this->m_surat_asal->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $message = $this->crud->gda('tb_surat_asal', ['id_surat_asal' => $post['id']]);

        // untuk message json
        $this->_response_message($message);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);
        
        $data = [
            'nama'      => strip_tags($post['inpnama']),
            'email'     => strip_tags($post['inpemail']),
            'telepon'   => strip_tags($post['inptelepon']),
            'fax'       => strip_tags($post['inpfax']),
            'situs_web' => strip_tags($post['inpsitusweb']),
        ];

        $this->db->trans_start();
        if (empty($post['inpidsuratasal'])) {
            $this->crud->i('tb_surat_asal', $data);
        } else {
            $this->crud->u('tb_surat_asal', $data, ['id_surat_asal' => $post['inpidsuratasal']]);
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

        $this->db->trans_start();
        $this->crud->d('tb_surat_asal', $post['id'], 'id_surat_asal');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $message = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk message json
        $this->_response_message($message);
    }
}
