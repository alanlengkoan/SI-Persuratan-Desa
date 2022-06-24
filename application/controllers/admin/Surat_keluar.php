<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pengaturan');
        $this->load->model('m_surat_sifat');
        $this->load->model('m_surat_jenis');
        $this->load->model('m_surat_keluar');
        $this->load->model('m_surat_tujuan');
        $this->load->model('m_keluarga_anggota');
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
        $this->template->load('admin', 'Surat Keluar', 'surat_keluar', 'view', $data);
    }

    // untuk halaman detail
    public function detail()
    {
        $id_surat_keluar = base64url_decode($this->uri->segment(4));

        $data = [
            'data' => $this->m_surat_keluar->getDetail($id_surat_keluar),
        ];
        // untuk load view
        $this->template->load('admin', 'Detail Surat Keluar', 'surat_keluar', 'detail', $data);
    }

    public function print()
    {
        $id_surat_keluar = base64url_decode($this->uri->segment(4));

        $surat_keluar = $this->m_surat_keluar->getDetail($id_surat_keluar);
        $penduduk     = $this->m_keluarga_anggota->getWhere($surat_keluar->id_users);

        $data = [
            'title'    => 'Surat Keluar',
            'detail'   => $surat_keluar,
            'penduduk' => $penduduk,
            'data'     => $this->m_pengaturan->getFirstRecord(),
        ];
        // untuk load view
        $this->pdf->setPaper('legal', 'potrait');
        $this->pdf->cetakPdf('Surat', 'admin/surat_keluar/print', $data);
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $message = $this->crud->gda('tb_surat_keluar', ['id_surat_keluar' => $post['id']]);

        // untuk message json
        $this->_response_message($message);
    }

    // untuk get data
    public function get_data_surat_keluar_dt()
    {
        $this->m_surat_keluar->getAllDataDt();
    }

    // untuk ubah approve
    public function upd_approve()
    {
        $post = $this->input->post(NULL, TRUE);

        $kode = get_kode_urut('tb_surat_keluar', 'no_surat', '214/');
        $no_surat = $kode . '/BT/I/' . date('Y');

        $data = [
            'no_surat'   => $no_surat,
            'tgl_surat'  => date('Y-m-d'),
            'tgl_keluar' => date('Y-m-d'),
            'approve'    => ($post['value'] === '1' ? '0' : '1')
        ];

        $this->db->trans_start();
        $this->crud->u('tb_surat_keluar', $data, ['id_surat_keluar' => $post['id']]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $message = ['title' => 'Gagal!', 'text' => 'Gagal Ubah!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Ubah!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk message json
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
