<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fasilitas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_fasilitas');
    }

    // untuk default
    public function index()
    {
        $data = [
            'halaman' => 'Fasilitas',
            'content' => 'admin/fasilitas/view',
            'css'     => 'admin/fasilitas/css/view',
            'js'      => 'admin/fasilitas/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data fasilitas
    public function get_data_fasilitas_dt()
    {
        return $this->m_fasilitas->getAllDataDt();
    }

    // untuk get data fasilitas by id
    public function get_data_fasilitas()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_fasilitas', ['id_fasilitas' => $post['id']]);
        $response = [
            'id_fasilitas' => $result['id_fasilitas'],
            'nama'         => $result['nama'],
            'gambar'       => $result['gambar'],
            'keterangan'   => $result['keterangan'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk simpan
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        if (empty($post['inpidfasilitas'])) {
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
                    'id_fasilitas' => acak_id('tb_fasilitas', 'id_fasilitas'),
                    'nama'         => $post['inpnama'],
                    'gambar'       => $detailFile['file_name'],
                    'keterangan'   => $post['inpketerangan'],
                ];
                $this->db->trans_start();
                $this->crud->i('tb_fasilitas', $data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        } else {
            $result = $this->crud->gda('tb_fasilitas', ['id_fasilitas' => $post['inpidfasilitas']]);

            if (isset($post['ubah_gambar_fasilitas']) && $post['ubah_gambar_fasilitas'] === 'on') {
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
                        'id_fasilitas' => $post['inpidfasilitas'],
                        'nama'         => $post['inpnama'],
                        'gambar'       => $detailFile['file_name'],
                        'keterangan'   => $post['inpketerangan'],
                    ];
                    $this->db->trans_start();
                    $this->crud->u('tb_fasilitas', $data, ['id_fasilitas' => $post['inpidfasilitas']]);
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                    } else {
                        $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                    }
                }
            } else {
                $data = [
                    'id_fasilitas' => $post['inpidfasilitas'],
                    'nama'         => $post['inpnama'],
                    'keterangan'   => $post['inpketerangan'],
                ];
                $this->db->trans_start();
                $this->crud->u('tb_fasilitas', $data, ['id_fasilitas' => $post['inpidfasilitas']]);
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

    // untuk hapus
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_fasilitas', ['id_fasilitas' => $post['id']]);
        $nma_file = $result['gambar'];
        // menghapus foto yg tersimpan
        if ($nma_file !== '' || $nma_file !== null) {
            if (file_exists(upload_path('gambar') . $result['gambar'])) {
                unlink(upload_path('gambar') . $result['gambar']);
            }
        }
        $this->db->trans_start();
        $this->crud->d('tb_fasilitas', $post['id'], 'id_fasilitas');
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
