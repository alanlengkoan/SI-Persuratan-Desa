<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_dana');
        $this->load->model('m_keuangan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman'  => 'Pengeluaran',
            'dana'     => $this->m_dana->getAll(),
            'keuangan' => $this->m_keuangan->getAll(),
            'content'  => 'admin/pengeluaran/view',
            'css'      => 'admin/pengeluaran/css/view',
            'js'       => 'admin/pengeluaran/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data pengeluaran
    public function get_data_pengeluaran_dt()
    {
        return $this->m_keuangan->getAllKeuanganDt('k');
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_keuangan_rincian', ['id_keuangan_rincian' => $post['id']]);
        $response = [
            'id_keuangan_rincian' => $result['id_keuangan_rincian'],
            'id_keuangan'         => $result['id_keuangan'],
            'id_dana'             => $result['id_dana'],
            'keterangan'          => $result['keterangan'],
            'tanggal'             => $result['tanggal'],
            'kredit'              => $result['kredit'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['idkeuanganrincian'])) {
            $data = [
                'id_keuangan_rincian' => acak_id('tb_keuangan_rincian', 'id_keuangan_rincian'),
                'id_keuangan'         => $post['inpidkeuangan'],
                'id_dana'             => $post['inpiddana'],
                'keterangan'          => $post['inpketerangan'],
                'tanggal'             => $post['inptgl'],
                'kredit'              => remove_separator($post['inpkredit']),
                'status_u'            => 'k',
            ];

            $this->crud->i('tb_keuangan_rincian', $data);
        } else {
            $data = [
                'id_keuangan_rincian' => $post['idkeuanganrincian'],
                'id_keuangan'         => $post['inpidkeuangan'],
                'id_dana'             => $post['inpiddana'],
                'keterangan'          => $post['inpketerangan'],
                'tanggal'             => $post['inptgl'],
                'kredit'              => remove_separator($post['inpkredit']),
            ];

            $this->crud->u('tb_keuangan_rincian', $data, ['id_keuangan_rincian' => $post['idkeuanganrincian']]);
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
        $this->crud->d('tb_keuangan_rincian', $post['id'], 'id_keuangan_rincian');
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
