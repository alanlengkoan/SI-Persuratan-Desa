<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{
    public function getRoleUsers($role, $id_users)
    {
        $result = $this->db->query("SELECT tu.id_users, tu.nama, tu.email, tu.telepon, tu.roles, tu.foto, tu.username FROM tb_users AS tu WHERE tu.roles = '$role' AND tu.id_users = '$id_users'")->row();
        return $result;
    }
}