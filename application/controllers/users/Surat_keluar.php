<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['users']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_surat_tujuan');
        $this->load->model('m_surat_sifat');
        $this->load->model('m_surat_jenis');
        $this->load->model('m_surat_keluar');
    }

    // untuk default
    public function index()
    {
        $data = [
            'jenis_surat'  => $this->m_surat_jenis->getAll(),
            'tujuan_surat' => $this->m_surat_tujuan->getAll(),
            'sifat_surat'  => $this->m_surat_sifat->getAll(),
        ];
        // untuk load view
        $this->template->load('users', 'Surat Keluar', 'surat_keluar', 'view', $data);
    }

    // untuk halaman detail
    public function detail()
    {
        $id_surat_keluar = base64url_decode($this->uri->segment(4));

        $data = [
            'data' => $this->m_surat_keluar->getDetail($id_surat_keluar),
        ];
        // untuk load view
        $this->template->load('users', 'Detail Surat Keluar', 'surat_keluar', 'detail', $data);
    }

    public function print()
    {
        $id_surat_keluar = base64url_decode($this->uri->segment(4));

        $data = [
            'title'  => 'Surat Keluar',
            'detail' => $this->m_surat_keluar->getDetail($id_surat_keluar),
        ];
        // untuk load view
        $this->pdf->setPaper('legal', 'potrait');
        $this->pdf->cetakPdf('Surat', 'users/surat_keluar/print', $data);
    }

    // untuk get data
    public function get_data_surat_keluar_dt()
    {
        $this->m_surat_keluar->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $message = $this->crud->gda('tb_surat_keluar', ['id_surat_keluar' => $post['id']]);

        // untuk message json
        $this->_response_message($message);
    }


    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'id_users'        => $this->session->userdata('id_users'),
            'id_surat_tujuan' => strip_tags($post['inpidsurattujuan']),
            'id_surat_sifat'  => strip_tags($post['inpidsuratsifat']),
            'id_surat_jenis'  => strip_tags($post['inpidsuratjenis']),
            'no_surat'        => strip_tags($post['inpnosurat']),
            'tgl_surat'       => strip_tags($post['inptglsurat']),
            'tgl_keluar'      => strip_tags($post['inptglkeluar']),
            'perihal'         => strip_tags($post['inpperihal']),
            'isi'             => $post['inpisi'],
            'approve'         => '0',
        ];

        $this->db->trans_start();
        if (empty($post['inpidsuratkeluar'])) {
            $this->crud->i('tb_surat_keluar', $data);
        } else {
            $this->crud->u('tb_surat_keluar', $data, ['id_surat_keluar' => $post['inpidsuratkeluar']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk message
        $this->_response_message($message);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_surat_keluar', $post['id'], 'id_surat_keluar');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $message = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk message
        $this->_response_message($message);
    }
}