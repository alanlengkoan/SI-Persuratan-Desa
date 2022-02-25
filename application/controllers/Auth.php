<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk load model
        $this->load->model('crud');
    }

    // untuk halaman login
    public function login()
    {
        checking_role_session($this->session->userdata('role'));

        if (empty($this->session->userdata('username'))) {
            $this->load->view('home/login/view');
        } else {
            $this->auth($this->session->userdata('username'), $this->session->userdata('password'));
        }
    }

    // untuk halama login admin
    public function admin()
    {
        checking_role_session($this->session->userdata('role'));

        if (empty($this->session->userdata('username'))) {
            $this->load->view('home/login/view');
        } else {
            $this->auth($this->session->userdata('username'), $this->session->userdata('password'));
        }
    }

    // untuk mengecek data login
    public function check_validation()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/login/view');
        } else {
            $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
            $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

            $this->auth($username, $password);
        }
    }

    // untuk mengecek data username dan password
    public function auth($username, $password)
    {
        $user = $this->db->get_where('tb_users', ['username' => $username]);
        $count = $user->result();
        if (count($count) >= 1) {
            $row = $user->row_array();
            if (password_verify($password, $row['password'])) {
                if ($row['roles'] == 'admin') {
                    $data = [
                        'id'       => $row['id'],
                        'id_users' => $row['id_users'],
                        'username' => $row['username'],
                        'password' => $password,
                        'role'     => $row['roles'],
                    ];
                    $this->session->set_userdata($data);
                    exit($this->_response_message(array('status' => true, 'link' => admin_url())));
                } else if ($row['roles'] == 'users') {
                    $data = [
                        'id'       => $row['id'],
                        'id_users' => $row['id_users'],
                        'username' => $row['username'],
                        'password' => $password,
                        'role'     => $row['roles'],
                    ];
                    $this->session->set_userdata($data);
                    exit($this->_response_message(array('status' => true, 'link' => base_url())));
                }
            } else {
                exit($this->_response_message(['title' => 'Gagal!', 'text' => 'Username atau Password Anda salah!', 'type' => 'error', 'button' => 'Ok!']));
            }
        } else {
            exit($this->_response_message(['title' => 'Gagal!', 'text' => 'Username atau Password Anda salah!', 'type' => 'error', 'button' => 'Ok!']));
        }
    }

    // untuk halaman register
    public function register()
    {
        checking_role_session($this->session->userdata('role'));

        if (empty($this->session->userdata('username'))) {
            $this->load->view('home/registrasi/view');
        } else {
            $this->auth($this->session->userdata('username'), $this->session->userdata('password'));
        }
    }

    // // untuk simpan data
    // public function process_save()
    // {
    //     $post = $this->input->post(NULL, TRUE);

    //     $q     = $post['nik'];
    //     $query = $this->db->query("SELECT * FROM tb_pelanggan AS p WHERE p.nik LIKE '%$q%';");
    //     $count = $query->num_rows();

    //     if ($count > 0) {
    //         $response = ['title' => 'Gagal!', 'text' => 'NIK yang Anda masukkan telah terdaftar!', 'type' => 'warning', 'button' => 'Ok!'];
    //     } else {
    //         // data users
    //         $users = [
    //             'id_users'     => acak_id('tb_users', 'id_users'),
    //             'nama'         => $post['nama'],
    //             'email'        => $post['email'],
    //             'username'     => create_character(5),
    //             'password'     => password_hash('12345678', PASSWORD_DEFAULT),
    //             'roles'        => 'users',
    //             'status_akun'  => '0',
    //         ];

    //         $config['upload_path']   = './' . upload_path('gambar');
    //         $config['allowed_types'] = 'jpg|jpeg|png';
    //         $config['encrypt_name']  = TRUE;
    //         $config['overwrite']     = TRUE;

    //         $this->load->library('upload', $config);

    //         $this->upload->do_upload('fc_pangkat_terakhir');
    //         $fc_pangkat_terakhir['fc_pangkat_terakhir'] = $this->upload->data();

    //         $this->upload->do_upload('fc_belum_punya_rumah');
    //         $fc_belum_punya_rumah['fc_belum_punya_rumah'] = $this->upload->data();

    //         $this->upload->do_upload('fc_ktp');
    //         $fc_ktp['fc_ktp'] = $this->upload->data();

    //         $this->upload->do_upload('fc_kk');
    //         $fc_kk['fc_kk'] = $this->upload->data();

    //         $this->upload->do_upload('fc_surat_nikah');
    //         $fc_surat_nikah['fc_surat_nikah'] = $this->upload->data();

    //         $this->upload->do_upload('pas_foto');
    //         $pas_foto['pas_foto'] = $this->upload->data();

    //         // data pelanggan
    //         $pelanggan = [
    //             'id_pelanggan'         => acak_id('tb_pelanggan', 'id_pelanggan'),
    //             'id_users'             => $users['id_users'],
    //             'nik'                  => $post['nik'],
    //             'nip'                  => $post['nip'],
    //             'kelamin'              => $post['kelamin'],
    //             'telepon'              => $post['telepon'],
    //             'alamat'               => $post['alamat'],
    //             'fc_pangkat_terakhir'  => $fc_pangkat_terakhir['fc_pangkat_terakhir']['file_name'],
    //             'fc_belum_punya_rumah' => $fc_belum_punya_rumah['fc_belum_punya_rumah']['file_name'],
    //             'fc_ktp'               => $fc_ktp['fc_ktp']['file_name'],
    //             'fc_kk'                => $fc_kk['fc_kk']['file_name'],
    //             'fc_surat_nikah'       => $fc_surat_nikah['fc_surat_nikah']['file_name'],
    //             'pas_foto'             => $pas_foto['pas_foto']['file_name'],
    //             'status_nikah'         => $post['status_nikah'],
    //             'status_lihat'         => 'belum-lihat',
    //         ];

    //         $this->db->trans_start();
    //         $this->crud->i('tb_users', $users);
    //         $this->crud->i('tb_pelanggan', $pelanggan);
    //         $this->db->trans_complete();
    //         if ($this->db->trans_status() === FALSE) {
    //             $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
    //         } else {
    //             $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
    //         }
    //     }
    //     // untuk response json
    //     $this->_response($response);
    // }

    // untuk logout
    public function logout()
    {
        $session_data = [
            'id'       => '',
            'id_users' => '',
            'username' => '',
            'password' => '',
            'role'     => '',
        ];
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
