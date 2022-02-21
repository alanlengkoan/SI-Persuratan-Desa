<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_guru extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT g.nip, g.id_guru, g.nama, g.kelamin, g.alamat, g.pendidikan, g.thn_masuk, a.nama AS agama, j.nama AS jabatan FROM tb_guru AS g LEFT JOIN tb_agama AS a ON g.id_agama = a.id_agama LEFT JOIN tb_jabatan AS j ON g.id_jabatan = j.id_jabatan ORDER BY g.nama ASC")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('	g.id_guru, g.nip, g.nama, g.kelamin, g.alamat, g.pendidikan, g.thn_masuk, a.nama AS agama, j.nama AS jabatan');
        $this->datatables->join('tb_agama AS a', 'g.id_agama = a.id_agama', 'left');
        $this->datatables->join('tb_jabatan AS j', 'g.id_jabatan = j.id_jabatan', 'left');
        $this->datatables->order_by('g.ins', 'desc');
        $this->datatables->from('tb_guru AS g');
        return print_r($this->datatables->generate());
    }
}
