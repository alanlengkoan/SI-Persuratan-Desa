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
                    exit($this->_response(array('status' => true, 'link' => admin_url())));
                } else if ($row['roles'] == 'users') {
                    $data = [
                        'id'       => $row['id'],
                        'id_users' => $row['id_users'],
                        'username' => $row['username'],
                        'password' => $password,
                        'role'     => $row['roles'],
                    ];
                    $this->session->set_userdata($data);
                    exit($this->_response(array('status' => true, 'link' => base_url())));
                }
            } else {
                exit($this->_response(['title' => 'Gagal!', 'text' => 'Username atau Password Anda salah!', 'type' => 'error', 'button' => 'Ok!']));
            }
        } else {
            exit($this->_response(['title' => 'Gagal!', 'text' => 'Username atau Password Anda salah!', 'type' => 'error', 'button' => 'Ok!']));
        }
    }

    public function access_session()
    {
        $ip  = $this->input->ip_address();
        $get = $this->db->query("SELECT * FROM tb_buku_tamu AS bt WHERE bt.ip_address = '$ip'");
        $num = $get->num_rows();
        $res = ['check' => $num];
        // untuk response json
        $this->_response($res);
    }

    public function access_session_save()
    {
        $post = $this->input->post(NULL, TRUE);
        $data = [
            'ip_address' => $this->input->ip_address(),
            'nama'       => $post['nama'],
            'kelamin'    => $post['kelamin'],
            'telepon'    => $post['telepon'],
            'email'      => $post['email'],
            'alamat'     => $post['alamat'],
            'keperluan'  => $post['keperluan'],
        ];
        $this->db->trans_start();
        $this->crud->i('tb_buku_tamu', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
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
