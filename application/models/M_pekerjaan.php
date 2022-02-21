<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pekerjaan extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT p.id_pekerjaan, p.nama FROM tb_pekerjaan AS p")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('p.id_pekerjaan, p.nama');
        $this->datatables->order_by('p.ins', 'desc');
        $this->datatables->from('tb_pekerjaan AS p');
        return print_r($this->datatables->generate());
    }
}