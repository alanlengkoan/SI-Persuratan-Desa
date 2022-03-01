<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_surat_asal extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT sa.id_surat_asal, sa.nama, sa.email, sa.telepon, sa.alamat, sa.fax, sa.situs_web FROM tb_surat_asal AS sa")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('sa.id_surat_asal, sa.nama, sa.email, sa.telepon, sa.alamat, sa.fax, sa.situs_web');
        $this->datatables->order_by('sa.ins', 'desc');
        $this->datatables->from('tb_surat_asal AS sa');
        return print_r($this->datatables->generate());
    }
}