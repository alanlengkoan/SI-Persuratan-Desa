<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_dana extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT d.id_dana, d.nama FROM tb_dana AS d");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('d.id_dana, d.nama');
        $this->datatables->order_by('d.ins', 'desc');
        $this->datatables->from('tb_dana AS d');
        return print_r($this->datatables->generate());
    }
}
