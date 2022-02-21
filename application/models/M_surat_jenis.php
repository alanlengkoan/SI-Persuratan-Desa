<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_surat_jenis extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT sj.id_surat_jenis, sj.nama FROM tb_surat_jenis AS sj")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('sj.id_surat_jenis, sj.nama');
        $this->datatables->order_by('sj.ins', 'desc');
        $this->datatables->from('tb_surat_jenis AS sj');
        return print_r($this->datatables->generate());
    }
}