<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Organisasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_organisasi');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Organisasi',
            'content' => 'admin/organisasi/view',
            'css'     => 'admin/organisasi/css/view',
            'js'      => 'admin/organisasi/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get datatable
    public function get_data_organisasi_dt()
    {
        return $this->m_organisasi->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_organisasi', ['id_organisasi' => $post['id']]);
        $response = [
            'id_organisasi' => $result['id_organisasi'],
            'organisasi'    => $result['organisasi'],
            'isi'       => $result['isi'],
            'gambar'    => $result['gambar'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        if (empty($post['inpidorganisasi'])) {
            if ($_FILES['inpgambar']['name']) {
                $config['upload_path']   = './' . upload_path('gambar');
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name']  = TRUE;
                $config['overwrite']     = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('inpgambar')) {
                    // apa bila gagal
                    $error = array('error' => $this->upload->display_errors());

                    $response = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    // apa bila berhasil
                    $detailFile = $this->upload->data();

                    $data = [
                        'id_organisasi' => acak_id('tb_organisasi', 'id_organisasi'),
                        'organisasi'    => $post['inporganisasi'],
                        'isi'       => $post['inpisi'],
                        'gambar'    => $detailFile['file_name'],
                    ];

                    $this->db->trans_start();
                    $this->crud->i('tb_organisasi', $data);
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                    } else {
                        $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                    }
                }
            } else {
                $data = [
                    'id_organisasi' => acak_id('tb_organisasi', 'id_organisasi'),
                    'organisasi'    => $post['inporganisasi'],
                    'isi'       => $post['inpisi'],
                ];
                
                $this->db->trans_start();
                $this->crud->i('tb_organisasi', $data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        } else {
            if (isset($_FILES['inpgambar']['name'])) {

                $result = $this->crud->gda('tb_organisasi', ['id_organisasi' => $post['inpidorganisasi']]);

                $config['upload_path']   = './' . upload_path('gambar');
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name']  = TRUE;
                $config['overwrite']     = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('inpgambar')) {
                    // apa bila gagal
                    $error = array('error' => $this->upload->display_errors());

                    $response = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    // apa bila berhasil
                    $detailFile = $this->upload->data();

                    // menghapus foto yg tersimpan
                    if ($result['gambar'] !== null) {
                        if (file_exists(upload_path('gambar') . $result['gambar'])) {
                            unlink(upload_path('gambar') . $result['gambar']);
                        }
                    }

                    $data = [
                        'id_organisasi' => $post['inpidorganisasi'],
                        'organisasi'    => $post['inporganisasi'],
                        'isi'       => $post['inpisi'],
                        'gambar'    => $detailFile['file_name'],
                    ];

                    $this->db->trans_start();
                    $this->crud->u('tb_organisasi', $data, ['id_organisasi' => $post['inpidorganisasi']]);
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                    } else {
                        $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                    }
                }
            } else {
                $data = [
                    'id_organisasi' => $post['inpidorganisasi'],
                    'organisasi'    => $post['inporganisasi'],
                    'isi'       => $post['inpisi'],
                ];

                $this->db->trans_start();
                $this->crud->u('tb_organisasi', $data, ['id_organisasi' => $post['inpidorganisasi']]);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post   = $this->input->post(NULL, TRUE);
        $result = $this->crud->gda('tb_organisasi', ['id_organisasi' => $post['id']]);
        $nma_file = $result['gambar'];
        // menghapus foto yg tersimpan
        if ($nma_file !== '' || $nma_file !== null) {
            if (file_exists(upload_path('gambar') . $result['gambar'])) {
                unlink(upload_path('gambar') . $result['gambar']);
            }
        }
        $this->db->trans_start();
        $this->crud->d('tb_organisasi', $post['id'], 'id_organisasi');
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
