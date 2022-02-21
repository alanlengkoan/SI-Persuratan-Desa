<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_keluarga extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT k.id_keluarga, k.no_kk, k.nama_kk, k.alamat, k.rt_rw, k.kd_pos, k.desa_kelurahan, k.kecamatan, k.kabupaten_kota, k.provinsi FROM tb_keluarga AS k")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('k.id_keluarga, k.no_kk, k.nama_kk, k.alamat, k.rt_rw, k.kd_pos, k.desa_kelurahan, k.kecamatan, k.kabupaten_kota, k.provinsi');
        $this->datatables->order_by('k.ins', 'desc');
        $this->datatables->from('tb_keluarga AS k');
        return print_r($this->datatables->generate());
    }
}
