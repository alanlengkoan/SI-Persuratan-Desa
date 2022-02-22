<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Csrf extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // untuk csrf
    public function index()
    {
        echo $this->security->get_csrf_hash();
    }
}