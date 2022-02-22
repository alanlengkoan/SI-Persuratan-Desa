<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_keluarga_anggota extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT ka.id_keluarga_anggota, ka.id_agama, ka.id_pekerjaan, ka.no_kk, k.nama_kk, ka.no_ktp, ka.nama, ka.kelamin, ka.tmp_lahir, ka.tgl_lahir, ka.kewarganegaraan, ka.pendidikan, ka.status_nikah FROM tb_keluarga_anggota AS ka LEFT JOIN tb_keluarga AS k ON ka.no_kk = k.no_kk")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('ka.id_keluarga_anggota, ka.id_agama, ka.id_pekerjaan, ka.no_kk, k.nama_kk, ka.no_ktp, ka.nama, ka.kelamin, ka.tmp_lahir, ka.tgl_lahir, ka.kewarganegaraan, ka.pendidikan, ka.status_nikah');
        $this->datatables->join('tb_keluarga AS k', 'ka.no_kk = k.no_kk', 'left');
        $this->datatables->order_by('ka.ins', 'desc');
        $this->datatables->from('tb_keluarga_anggota AS ka');
        return print_r($this->datatables->generate());
    }
}
