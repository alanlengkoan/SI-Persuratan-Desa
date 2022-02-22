<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * CodeIgniter Template Library
 *
 * Create template format in CodeIgniter
 *
 * @packge     CodeIgniter
 * @subpackage Libraries
 * @category   Libraries
 * @author     Alan Saputra Lengkoan
 * @license    MIT License
 */

class Template
{
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function load($role, $module, $view, array $data = [])
    {
        $data['content'] = "{$role}/{$module}/{$view}";
        // untuk css
        if (file_exists(APPPATH . "views/{$role}/{$module}/{$view}.php")) {
            $data['css']     = "{$role}/{$module}/css/{$view}";
        }
        // untuk js
        if (file_exists(APPPATH . "views/{$role}/{$module}/{$view}.php")) {
            $data['js']      = "{$role}/{$module}/js/{$view}";
        }
        // untuk load view
        $this->ci->load->view("{$role}/base", $data);
    }
}