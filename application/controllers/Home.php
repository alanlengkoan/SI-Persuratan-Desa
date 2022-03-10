<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_profil');
    }

    public function index()
    {
        $data = [
            'profil' => $this->m_profil->getAll(),
        ];
        // untuk load view
        $this->template->load('home', 'Beranda', 'beranda', 'view', $data);
    }
}
