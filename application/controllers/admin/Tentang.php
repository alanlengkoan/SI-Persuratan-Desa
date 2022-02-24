<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tentang extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_profil');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Tentang', 'tentang', 'view');
    }

    // untuk get datatable
    public function get_data_profil_dt()
    {
        $this->m_profil->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $message = $this->crud->gda('tb_profil', ['id_profil' => $post['id']]);

        // untuk response json
        $this->_response_message($message);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        if (empty($post['inpidprofil'])) {
            if ($_FILES['inpgambar']['name']) {
                $config['upload_path']   = './' . upload_path('gambar');
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name']  = TRUE;
                $config['overwrite']     = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('inpgambar')) {
                    // apa bila gagal
                    $error = array('error' => $this->upload->display_errors());

                    $message = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    // apa bila berhasil
                    $detailFile = $this->upload->data();

                    $data = [
                        'id_profil' => acak_id('tb_profil', 'id_profil'),
                        'nama'      => strip_tags($post['inpnama']),
                        'isi'       => $post['inpisi'],
                        'gambar'    => $detailFile['file_name'],
                    ];

                    $this->db->trans_start();
                    $this->crud->i('tb_profil', $data);
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                    } else {
                        $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                    }
                }
            } else {
                $data = [
                    'id_profil' => acak_id('tb_profil', 'id_profil'),
                    'nama'      => strip_tags($post['inpnama']),
                    'isi'       => $post['inpisi'],
                ];
                
                $this->db->trans_start();
                $this->crud->i('tb_profil', $data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        } else {
            if (isset($_FILES['inpgambar']['name'])) {
                $result = $this->crud->gda('tb_profil', ['id_profil' => $post['inpidprofil']]);

                $config['upload_path']   = './' . upload_path('gambar');
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name']  = TRUE;
                $config['overwrite']     = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('inpgambar')) {
                    // apa bila gagal
                    $error = array('error' => $this->upload->display_errors());

                    $message = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
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
                        'id_profil' => strip_tags($post['inpidprofil']),
                        'nama'      => strip_tags($post['inpnama']),
                        'isi'       => $post['inpisi'],
                        'gambar'    => $detailFile['file_name'],
                    ];

                    $this->db->trans_start();
                    $this->crud->u('tb_profil', $data, ['id_profil' => $post['inpidprofil']]);
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                    } else {
                        $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                    }
                }
            } else {
                $data = [
                    'id_profil' => strip_tags($post['inpidprofil']),
                    'nama'      => strip_tags($post['inpnama']),
                    'isi'       => $post['inpisi'],
                ];

                $this->db->trans_start();
                $this->crud->u('tb_profil', $data, ['id_profil' => $post['inpidprofil']]);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        }
        // untuk response json
        $this->_response_message($message);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post   = $this->input->post(NULL, TRUE);
        $result = $this->crud->gda('tb_profil', ['id_profil' => $post['id']]);
        $nma_file = $result['gambar'];
        // menghapus foto yg tersimpan
        if ($nma_file !== '' || $nma_file !== null) {
            if (file_exists(upload_path('gambar') . $result['gambar'])) {
                unlink(upload_path('gambar') . $result['gambar']);
            }
        }
        $this->db->trans_start();
        $this->crud->d('tb_profil', $post['id'], 'id_profil');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $message = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response_message($message);
    }
}
