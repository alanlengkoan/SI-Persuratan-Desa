<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_surat_asal');
        $this->load->model('m_surat_masuk');
        $this->load->model('m_surat_sifat');
        $this->load->model('m_surat_jenis');
    }

    // untuk default
    public function index()
    {
        $data = [
            'jenis_surat' => $this->m_surat_jenis->getAll(),
            'asal_surat'  => $this->m_surat_asal->getAll(),
            'sifat_surat' => $this->m_surat_sifat->getAll(),
        ];
        // untuk load view
        $this->template->load('admin', 'Surat Masuk', 'surat_masuk', 'view', $data);
    }

    // untuk halaman detail
    public function detail()
    {
        $id_surat_masuk = base64url_decode($this->uri->segment(4));

        $data = [
            'data' => $this->m_surat_masuk->getDetail($id_surat_masuk),
        ];
        // untuk load view
        $this->template->load('admin', 'Detail Surat Masuk', 'surat_masuk', 'detail', $data);
    }

    // untuk get data
    public function get_data_surat_masuk_dt()
    {
        $this->m_surat_masuk->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $message = $this->crud->gda('tb_surat_masuk', ['id_surat_masuk' => $post['id']]);

        // untuk message json
        $this->_response_message($message);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        switch ($post['inparsiptipe']) {
            case 'pdf':
                $config['upload_path']   = './' . upload_path('pdf');
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name']  = TRUE;
                $config['overwrite']     = TRUE;
                break;
            case 'doc':
                $config['upload_path']   = './' . upload_path('doc');
                $config['allowed_types'] = 'doc|docx';
                $config['encrypt_name']  = TRUE;
                $config['overwrite']     = TRUE;
                break;
            default:
                echo "Gagal";
                break;
        }

        $this->load->library('upload', $config);

        if (empty($post['inpidsuratmasuk'])) {
            // untuk proses simpan
            if (!$this->upload->do_upload('inparsip')) {
                // apa bila gagal
                $error = array('error' => $this->upload->display_errors());

                $message = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
            } else {
                // apa bila berhasil
                $detailFile = $this->upload->data();

                $data = [
                    'id_surat_asal'  => strip_tags($post['inpidsuratasal']),
                    'id_surat_sifat' => strip_tags($post['inpidsuratsifat']),
                    'id_surat_jenis' => strip_tags($post['inpidsuratjenis']),
                    'no_surat'       => strip_tags($post['inpnosurat']),
                    'tgl_surat'      => strip_tags($post['inptglsurat']),
                    'tgl_masuk'      => strip_tags($post['inptglmasuk']),
                    'perihal'        => strip_tags($post['inpperihal']),
                    'arsip_tipe'     => strip_tags($post['inparsiptipe']),
                    'arsip'          => $detailFile['file_name'],
                ];

                $this->db->trans_start();
                $this->crud->i('tb_surat_masuk', $data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        } else {
            $result = $this->crud->gda('tb_surat_masuk', ['id_surat_masuk' => $post['inpidsuratmasuk']]);

            // untuk proses simpan
            if (!$this->upload->do_upload('inparsip')) {
                // apa bila gagal
                $error = array('error' => $this->upload->display_errors());

                $message = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
            } else {
                // apa bila berhasil
                $detailFile = $this->upload->data();

                // menghapus foto yg tersimpan
                if ($result['arsip'] !== '' || $result['arsip'] !== null) {
                    if ($result['arsip_tipe'] === 'pdf') {
                        if (file_exists(upload_path('pdf') . $result['arsip'])) {
                            unlink(upload_path('pdf') . $result['arsip']);
                        }
                    } else {
                        if (file_exists(upload_path('doc') . $result['arsip'])) {
                            unlink(upload_path('doc') . $result['arsip']);
                        }
                    }
                }

                $data = [
                    'id_surat_asal'  => strip_tags($post['inpidsuratasal']),
                    'id_surat_sifat' => strip_tags($post['inpidsuratsifat']),
                    'id_surat_jenis' => strip_tags($post['inpidsuratjenis']),
                    'no_surat'       => strip_tags($post['inpnosurat']),
                    'tgl_surat'      => strip_tags($post['inptglsurat']),
                    'tgl_masuk'      => strip_tags($post['inptglmasuk']),
                    'perihal'        => strip_tags($post['inpperihal']),
                    'arsip_tipe'     => strip_tags($post['inparsiptipe']),
                    'arsip'          => $detailFile['file_name'],
                ];

                $this->db->trans_start();
                $this->crud->u('tb_surat_masuk', $data, ['id_surat_masuk' => $post['inpidsuratmasuk']]);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        }
        // untuk message json
        $this->_response_message($message);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_surat_masuk', ['id_surat_masuk' => $post['id']]);
        // menghapus foto yg tersimpan
        if ($result['arsip'] !== '' || $result['arsip'] !== null) {
            if ($result['arsip_tipe'] === 'pdf') {
                if (file_exists(upload_path('pdf') . $result['arsip'])) {
                    unlink(upload_path('pdf') . $result['arsip']);
                }
            } else {
                if (file_exists(upload_path('doc') . $result['arsip'])) {
                    unlink(upload_path('doc') . $result['arsip']);
                }
            }
        }

        $this->db->trans_start();
        $this->crud->d('tb_surat_masuk', $post['id'], 'id_surat_masuk');
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
