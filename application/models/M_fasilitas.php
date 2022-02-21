<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_fasilitas extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT f.id_fasilitas, f.nama, f.gambar, f.keterangan FROM tb_fasilitas AS f ORDER BY f.ins")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('f.id_fasilitas, f.nama, f.gambar');
        $this->datatables->from('tb_fasilitas AS f');
        $this->datatables->order_by('f.ins', 'desc');
        return print_r($this->datatables->generate());
    }
}
