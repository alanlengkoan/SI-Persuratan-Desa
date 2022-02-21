  
<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_jadwal extends CI_Model
{
    public function getAllDataDt()
    {
        $this->datatables->select('j.id_jadwal, j.nama');
        $this->datatables->order_by('j.ins', 'desc');
        $this->datatables->from('tb_jadwal AS j');
        return print_r($this->datatables->generate());
    }

    public function getAll()
    {
        $result = $this->db->query("SELECT j.id_jadwal, j.nama FROM tb_jadwal AS j")->result();
        return $result;
    }

    public function getDetail($id_jadwal)
    {
        $result = $this->db->query("SELECT j.id_jadwal, j.nama FROM tb_jadwal AS j WHERE j.id_jadwal = '$id_jadwal'")->row();
        return $result;
    }

    public function getAllDataJadwalRincianDt($id_jadwal)
    {
        $this->datatables->select('jr.id_jadwal_rincian, jr.tanggal, jr.jam_mulai, jr.jam_selesai, k.nama AS kelas, m.nama AS mapel');
        $this->datatables->join('tb_kelas AS k', 'jr.id_kelas = k.id_kelas', 'left');
        $this->datatables->join('tb_mapel AS m', 'jr.id_mapel = m.id_mapel', 'left');
        $this->datatables->where('jr.id_jadwal', $id_jadwal);
        $this->datatables->from('tb_jadwal_rincian AS jr');
        return print_r($this->datatables->generate());
    }
}
