<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluarga extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

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

    // untuk check nomor kk
    public function check_no_kk()
    {
        $post = $this->input->post(NULL, TRUE);

        $q = $post['q'];

        $message = [];

        if ($q) {
            $get = $this->db->query("SELECT * FROM tb_keluarga WHERE no_kk LIKE '%$q%'");
            $sum = $get->num_rows();

            if ($sum > 0) {
                $message = ['status' => true];
            } else {
                $message = ['status' => false];
            }
        }
        // untuk message json
        $this->_response_message($message);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);
        
        $data = [
            'no_kk'          => strip_tags($post['inpnokk']),
            'nama_kk'        => strip_tags($post['inpnmkk']),
            'alamat'         => strip_tags($post['inpalamat']),
            'rt_rw'          => strip_tags($post['inprtrw']),
            'kd_pos'         => strip_tags($post['inpkdpos']),
            'desa_kelurahan' => strip_tags($post['inpdesakel']),
            'kecamatan'      => strip_tags($post['inpkec']),
            'kabupaten_kota' => strip_tags($post['inpkabkot']),
            'provinsi'       => strip_tags($post['inpprovinsi']),
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
