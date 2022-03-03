<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends MY_Controller
{
    public $users;

    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk mengambil detail user
        $this->users = get_users_detail($this->id);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pengaturan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'data' => $this->m_pengaturan->getFirstRecord(),
        ];
        // untuk load view
        $this->template->load('admin', 'Pengaturan', 'pengaturan', 'view', $data);
    }

    // untuk ubah foto
    public function upd_foto()
    {
        $id_pengaturan = $this->uri->segment('4');

        $_FILES['inpfoto']['name']     = $_FILES['inplogo']['name'][0];
        $_FILES['inpfoto']['type']     = $_FILES['inplogo']['type'][0];
        $_FILES['inpfoto']['tmp_name'] = $_FILES['inplogo']['tmp_name'][0];
        $_FILES['inpfoto']['error']    = $_FILES['inplogo']['error'][0];
        $_FILES['inpfoto']['size']     = $_FILES['inplogo']['size'][0];

        $config['upload_path']   = './' . upload_path('gambar');
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name']  = TRUE;
        $config['overwrite']     = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('inpfoto')) {
            // apa bila gagal
            $error = array('error' => $this->upload->display_errors());

            $message = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
        } else {
            // apa bila berhasil
            $detailFile = $this->upload->data();

            $this->db->trans_start();
            if ($id_pengaturan === null) {
                $data = [
                    'id_pengaturan' => acak_id('tb_pengaturan', 'id_pengaturan'),
                    'logo'          => $detailFile['file_name'],
                ];

                $this->crud->i('tb_pengaturan', $data);
            } else {
                $data = [
                    'logo' => $detailFile['file_name'],
                ];

                $this->crud->u('tb_pengaturan', $data, ['id_pengaturan' => $id_pengaturan]);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }
        // untuk message json
        $this->_response_message($message);
    }

    // untuk update profil
    public function upd_profil()
    {
        $id_pengaturan = $this->uri->segment('4');
        
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'nama'      => $post['inpnama'],
            'alamat'    => $post['inpalamat'],
            'email'     => $post['inpemail'],
            'telepon'   => $post['inptelepon'],
            'fax'       => $post['inpfax'],
            'situs_web' => $post['inpsitusweb'],
            'facebook'  => $post['inplinkfacebook'],
            'instagram' => $post['inplinkinstagram'],
            'twitter'   => $post['inplinktwitter'],
            'youtube'   => $post['inplinkyoutube'],
        ];

        $this->db->trans_start();
        if ($id_pengaturan === null) {
            $this->crud->i('tb_pengaturan', $data);
        } else {
            $this->crud->u('tb_pengaturan', $data, ['id_pengaturan' => $id_pengaturan]);
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
}
