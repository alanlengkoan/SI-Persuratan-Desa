<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    public function getYear()
    {
        $result = $this->db->query("SELECT YEAR( tgl_lahir) AS tahun FROM tb_keluarga_anggota GROUP BY YEAR( tgl_lahir)");
        return $result;
    }

    public function getPenduduk($kelamin, $year = null)
    {
        if ($year !== null) {
            $result = $this->db->query("SELECT COUNT(*) AS sum_gender FROM tb_keluarga_anggota AS ka WHERE ka.kelamin = '$kelamin' AND YEAR(ka.tgl_lahir) = '$year'")->row();
        } else {
            $result = $this->db->query("SELECT COUNT(*) AS sum_gender FROM tb_keluarga_anggota AS ka WHERE ka.kelamin = '$kelamin'")->row();
        }
        return $result;
    }

    public function getPekerjaan($year = null)
    {
        if ($year !== null) {
            $result = $this->db->query("SELECT pe.nama,( SELECT COUNT(*) FROM tb_keluarga_anggota AS ka WHERE ka.id_pekerjaan = pe.id_pekerjaan AND YEAR(ka.tgl_lahir) = '$year') AS count FROM tb_pekerjaan AS pe");
        } else {
            $result = $this->db->query("SELECT pe.nama,( SELECT COUNT(*) FROM tb_keluarga_anggota AS ka WHERE ka.id_pekerjaan = pe.id_pekerjaan) AS count FROM tb_pekerjaan AS pe");
        }
        return $result;
    }

    public function getUmur($year = null)
    {
        if ($year !== null) {
            $result = $this->db->query("SELECT ka.tgl_lahir FROM tb_keluarga_anggota AS ka WHERE YEAR(ka.tgl_lahir) = '$year'");
        } else {
            $result = $this->db->query("SELECT ka.tgl_lahir FROM tb_keluarga_anggota AS ka");
        }
        return $result;
    }
}
