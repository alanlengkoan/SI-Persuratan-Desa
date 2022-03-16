<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// route default
$route['default_controller']   = 'home';
$route['404_override']         = 'not_found';
$route['translate_uri_dashes'] = FALSE;

// route admin
$route['admin'] = 'admin/dashboard';

// route users
$route['users'] = 'users/dashboard';

// route home
$route['get_penduduk']      = 'home/get_penduduk';
$route['get_pekerjaan']     = 'home/get_pekerjaan';
$route['get_umur']          = 'home/get_umur';
$route['get_umur_kategori'] = 'home/get_umur_kategori';