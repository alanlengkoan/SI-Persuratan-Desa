<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['users']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pengaturan');
        $this->load->model('m_surat_sifat');
        $this->load->model('m_surat_jenis');
        $this->load->model('m_surat_keluar');
        $this->load->model('m_surat_tujuan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'penduduk'     => $this->crud->gda('tb_keluarga_anggota', ['id_users' => $this->id_users]),
            'jenis_surat'  => $this->m_surat_jenis->getAll(),
            'tujuan_surat' => $this->m_surat_tujuan->getAll(),
            'sifat_surat'  => $this->m_surat_sifat->getAll(),
        ];
        // untuk load view
        $this->template->load('users', 'Permohonan Surat', 'surat_keluar', 'view', $data);
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
            'data'   => $this->m_pengaturan->getFirstRecord(),
        ];
        // untuk load view
        $this->pdf->setPaper('legal', 'potrait');
        $this->pdf->cetakPdf('Surat', 'users/surat_keluar/print', $data);
    }

    // untuk get data
    public function get_data_surat_keluar_dt()
    {
        $this->m_surat_keluar->getAllDataUsersDt($this->id_users);
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

        $config['upload_path']   = './' . upload_path('gambar');
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name']  = TRUE;
        $config['overwrite']     = TRUE;

        $this->load->library('upload', $config);

        // untuk proses simpan
        if (!$this->upload->do_upload('inpfotoktp')) {
            // apa bila gagal
            $error = array('error' => $this->upload->display_errors());

            $message = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
        } else {
            // apa bila berhasil
            $detailFile = $this->upload->data();

            $data = [
                'id_users'        => $this->id_users,
                'id_surat_tujuan' => strip_tags($post['inpidsurattujuan']),
                'id_surat_jenis'  => strip_tags($post['inpidsuratjenis']),
                'id_surat_sifat'  => strip_tags($post['inpidsuratsifat']),
                'perihal'         => strip_tags($post['inpperihal']),
                'foto_ktp'        => $detailFile['file_name'],
            ];

            $this->db->trans_start();
            if (empty($post['inpidsuratkeluar'])) {
                $data2 = [
                    'approve' => '0'
                ];
                $insert = array_merge($data, $data2);

                $this->crud->i('tb_surat_keluar', $insert);
            } else {
                $this->crud->u('tb_surat_keluar', $data, ['id_surat_keluar' => $post['inpidsuratkeluar']]);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }
        // untuk message
        $this->_response_message($message);
    }
}
