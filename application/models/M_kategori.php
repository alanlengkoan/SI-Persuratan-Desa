<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT k.id_kategori, k.nama,( SELECT COUNT(*) FROM tb_informasi AS ti WHERE ti.id_kategori = k.id_kategori AND ti.`status` = '1') AS jumlah FROM tb_kategori AS k ORDER BY k.ins ASC")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('k.id_kategori, k.nama');
        $this->datatables->order_by('k.ins', 'desc');
        $this->datatables->from('tb_kategori AS k');
        return print_r($this->datatables->generate());
    }
}
