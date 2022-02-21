<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_agama extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT a.id_agama, a.nama FROM tb_agama AS a")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('a.id_agama, a.nama');
        $this->datatables->order_by('a.ins', 'desc');
        $this->datatables->from('tb_agama AS a');
        return print_r($this->datatables->generate());
    }
}
