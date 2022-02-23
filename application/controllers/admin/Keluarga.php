<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluarga extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_keluarga');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Keluarga', 'keluarga', 'view');
    }

    // untuk get data
    public function get_data_keluarga_dt()
    {
        return $this->m_keluarga->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $message = $this->crud->gda('tb_keluarga', ['id_keluarga' => $post['id']]);
        
        // untuk message json
        $this->_response_message($message);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);
        
        $data = [
            'no_kk'          => $post['inpnokk'],
            'nama_kk'        => $post['inpnmkk'],
            'alamat'         => $post['inpalamat'],
            'rt_rw'          => $post['inprtrw'],
            'kd_pos'         => $post['inpkdpos'],
            'desa_kelurahan' => $post['inpdesakel'],
            'kecamatan'      => $post['inpkec'],
            'kabupaten_kota' => $post['inpkabkot'],
            'provinsi'       => $post['inpprovinsi'],
        ];

        $this->db->trans_start();
        if (empty($post['inpidkeluarga'])) {
            $this->crud->i('tb_keluarga', $data);
        } else {
            $this->crud->u('tb_keluarga', $data, ['id_keluarga' => $post['inpidkeluarga']]);
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
        $this->crud->d('tb_keluarga', $post['id'], 'id_keluarga');
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
