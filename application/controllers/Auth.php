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

    // untuk mengecek no nik
    public function check_no_ktp()
    {
        $post = $this->input->post(NULL, TRUE);

        $q = $post['q'];

        $message = [];

        if ($q) {
            $get = $this->db->query("SELECT * FROM tb_keluarga_anggota WHERE no_ktp LIKE '%$q%'");
            $sum = $get->num_rows();

            if ($sum > 0) {
                $message = ['status' => true];
            } else {
                $message = ['status' => false];
            }
        }
        // untuk message json
        $this->_response_message($message);
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

    // untuk simpan data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $q = $post['nik'];

        $qry = $this->db->query("SELECT * FROM tb_keluarga_anggota WHERE no_ktp LIKE '%$q%'");
        $num = $qry->num_rows();
        $row = $qry->row();

        if ($num > 0) {
            // untuk simpan users
            $users = [
                'id_users' => acak_id('tb_users', 'id_users'),
                'nama'     => $row->nama,
                'email'    => $post['email'],
                'username' => $post['username'],
                'password' => password_hash($post['password'], PASSWORD_DEFAULT),
                'roles'    => 'users',
            ];

            // untuk ubah keluarga anggota
            $keluarga_anggota = [
                'id_users' => $users['id_users'],
            ];

            $this->db->trans_start();
            $this->crud->i('tb_users', $users);
            $this->crud->u('tb_keluarga_anggota', $keluarga_anggota, ['id_keluarga_anggota' => $row->id_keluarga_anggota]);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $message = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $message = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
            }
        } else {
            $message = ['title' => 'Gagal!', 'text' => 'NIK yang Anda masukkan tidak terdaftar!', 'type' => 'warning', 'button' => 'Ok!'];
        }
        // untuk message json
        $this->_response_message($message);
    }

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
