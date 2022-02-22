<?php
defined('BASEPATH') or exit('No direct script access allowed');

// untuk mengecek session user
if (!function_exists('checking_session')) {
    function checking_session($user_data, $user_level, array $level)
    {
        $search = in_array($user_level, $level);
        if (empty($user_data) || $search === false) {
            redirect('auth/login');
        }
    }
}

// untuk mengecek role user
if (!function_exists('checking_role_session')) {
    function checking_role_session($role)
    {
        if ($role) {
            return redirect($role);
        }
    }
}

// untuk mengecek user
if (!function_exists('get_users_detail')) {
    function get_users_detail($id)
    {
        if ($id) {
            $ci = get_instance();
            $result = $ci->db->query("SELECT * FROM tb_users WHERE id = '$id'")->row();
            return $result;
        }
    }
}

// untuk mengecek profil sistem
if (!function_exists('get_sistem_detail')) {
    function get_sistem_detail()
    {
        $ci = get_instance();
        $result = $ci->db->query("SELECT tp.id_pengaturan, tp.logo, tp.nama, tp.email, tp.alamat, tp.telepon, tp.facebook, tp.instagram, tp.twitter, tp.youtube FROM tb_pengaturan AS tp LIMIT 1")->row();
        return $result;
    }
}
