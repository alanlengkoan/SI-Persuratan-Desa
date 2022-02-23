<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_surat_sifat extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT ss.id_surat_sifat, ss.nama, ss.keterangan FROM tb_surat_sifat AS ss")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('ss.id_surat_sifat, ss.nama, ss.keterangan');
        $this->datatables->order_by('ss.ins', 'desc');
        $this->datatables->from('tb_surat_sifat AS ss');
        return print_r($this->datatables->generate());
    }
}