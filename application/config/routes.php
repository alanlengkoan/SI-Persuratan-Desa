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