  
<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_kelas extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT k.id_kelas, k.nama FROM tb_kelas AS k")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('k.id_kelas, k.nama');
        $this->datatables->order_by('k.ins', 'desc');
        $this->datatables->from('tb_kelas AS k');
        return print_r($this->datatables->generate());
    }

    public function getKelasJumlahSiswa($status)
    {
        $result = $this->db->query("SELECT tb_kelas.id_kelas, tb_kelas.nama,( SELECT COUNT(*) FROM tb_siswa WHERE tb_siswa.id_kelas = tb_kelas.id_kelas AND tb_siswa.status = '$status') AS jumlah_siswa FROM tb_kelas ORDER BY tb_kelas.nama");
        return $result;
    }
}
