<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    public function getPenduduk($kelamin)
    {
        $result = $this->db->query("SELECT COUNT(*) AS sum_gender FROM tb_keluarga_anggota AS ka WHERE ka.kelamin = '$kelamin'")->row();
        return $result;
    }

    public function getPekerjaan()
    {
        $result = $this->db->query("SELECT pe.nama,( SELECT COUNT(*) FROM tb_keluarga_anggota AS ka WHERE ka.id_pekerjaan = pe.id_pekerjaan) AS count FROM tb_pekerjaan AS pe");
        return $result;
    }

    public function getUmur()
    {
        $result = $this->db->query("SELECT ka.tgl_lahir FROM tb_keluarga_anggota AS ka");
        return $result;
    }
}
