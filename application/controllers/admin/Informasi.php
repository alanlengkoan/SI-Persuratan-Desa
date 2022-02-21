<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_kategori');
        $this->load->model('m_informasi');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman'  => 'Informasi',
            'kategori' => $this->m_kategori->getAll(),
            'content'  => 'admin/informasi/view',
            'css'      => 'admin/informasi/css/view',
            'js'       => 'admin/informasi/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data informasi
    public function get_data_informasi_dt()
    {
        return $this->m_informasi->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_informasi', ['id_informasi' => $post['id']]);
        $response = [
            'id_informasi' => $result['id_informasi'],
            'id_kategori'  => $result['id_kategori'],
            'judul'        => $result['judul'],
            'isi'          => $result['isi'],
            'gambar'       => $result['gambar'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses ubah status
    public function upd_status()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'status' => ($post['value'] === '1' ? '0' : '1')
        ];

        $this->db->trans_start();
        $this->crud->u('tb_informasi', $data, ['id_informasi' => $post['id']]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Ubah!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Ubah!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses ubah status galeri
    public function upd_status_galeri()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'status_galeri' => ($post['value'] === '1' ? '0' : '1')
        ];

        $this->db->trans_start();
        $this->crud->u('tb_informasi', $data, ['id_informasi' => $post['id']]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Ubah!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Ubah!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        if (empty($post['inpidinformasi'])) {
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
                    'id_informasi'  => acak_id('tb_informasi', 'id_informasi'),
                    'id_kategori'   => $post['inpidkategori'],
                    'judul'         => $post['inpjudul'],
                    'isi'           => $post['inpisi'],
                    'gambar'        => $detailFile['file_name'],
                    'tgl_publish'   => date('Y-m-d H:i:s'),
                    'status'        => '1',
                    'status_galeri' => '0',
                ];

                $this->db->trans_start();
                $this->crud->i('tb_informasi', $data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        } else {
            $result = $this->crud->gda('tb_informasi', ['id_informasi' => $post['inpidinformasi']]);

            if (isset($post['ubah_gambar']) && $post['ubah_gambar'] === 'on') {
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

                    $nma_file = $result['gambar'];
                    // menghapus foto yg tersimpan
                    if ($nma_file !== '' || $nma_file !== null) {
                        if (file_exists(upload_path('gambar') . $result['gambar'])) {
                            unlink(upload_path('gambar') . $result['gambar']);
                        }
                    }
                    $data = [
                        'id_informasi' => $post['inpidinformasi'],
                        'id_kategori'  => $post['inpidkategori'],
                        'judul'        => $post['inpjudul'],
                        'isi'          => $post['inpisi'],
                        'gambar'       => $detailFile['file_name'],
                    ];
                    $this->db->trans_start();
                    $this->crud->u('tb_informasi', $data, ['id_informasi' => $post['inpidinformasi']]);
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                    } else {
                        $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                    }
                }
            } else {
                $data = [
                    'id_informasi' => $post['inpidinformasi'],
                    'id_kategori'  => $post['inpidkategori'],
                    'judul'        => $post['inpjudul'],
                    'isi'          => $post['inpisi'],
                ];
                $this->db->trans_start();
                $this->crud->u('tb_informasi', $data, ['id_informasi' => $post['inpidinformasi']]);
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
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_informasi', ['id_informasi' => $post['id']]);
        $nma_file = $result['gambar'];
        // menghapus foto yg tersimpan
        if ($nma_file !== '' || $nma_file !== null) {
            if (file_exists(upload_path('gambar') . $result['gambar'])) {
                unlink(upload_path('gambar') . $result['gambar']);
            }
        }
        $this->db->trans_start();
        $this->crud->d('tb_informasi', $post['id'], 'id_informasi');
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
