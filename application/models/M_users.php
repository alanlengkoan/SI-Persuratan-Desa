<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{
    public function getRoleUsers($role, $id_users)
    {
        $result = $this->db->query("SELECT tu.id_users, tu.nama, tu.email, tu.roles, tu.foto, tu.username, ts.id_siswa, ts.nis, ts.tmp_lahir, ts.tgl_lahir, ts.ortu_wali, ts.kelamin, ts.alamat, ts.thn_lulus, ts.`status` FROM tb_users AS tu LEFT JOIN tb_siswa AS ts ON tu.id_users = ts.id_users WHERE tu.roles = '$role' AND tu.id_users = '$id_users'")->row();
        return $result;
    }
}