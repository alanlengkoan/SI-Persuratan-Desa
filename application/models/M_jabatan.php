<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_jabatan extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT j.id_jabatan, j.nama FROM tb_jabatan AS j")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('j.id_jabatan, j.nama');
        $this->datatables->order_by('j.ins', 'desc');
        $this->datatables->from('tb_jabatan AS j');
        return print_r($this->datatables->generate());
    }
}
