  
<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_kuisioner extends CI_Model
{
    public function getAllDataDt()
    {
        $this->datatables->select('k.id_kuisioner, k.nama, ( SELECT COUNT(*) FROM tb_kuisioner_soal AS ks WHERE ks.id_kuisioner = k.id_kuisioner ) AS jumlah');
        $this->datatables->order_by('k.ins', 'desc');
        $this->datatables->from('tb_kuisioner AS k');
        return print_r($this->datatables->generate());
    }

    public function getAll()
    {
        $result = $this->db->query("SELECT k.id_kuisioner, k.nama FROM tb_kuisioner AS k");
        return $result;
    }

    public function getWhereSoal($id_kuisioner)
    {
        $result = $this->db->query("SELECT tks.id_kuisioner_soal, tks.id_kuisioner, tks.soal, tks.pil_a, tks.pil_b, tks.pil_c, tks.pil_d, tks.pil_e FROM tb_kuisioner_soal AS tks WHERE tks.id_kuisioner = '$id_kuisioner' ORDER BY tks.ins ASC");
        return $result;
    }

    public function getWhereHasil($id_kuisioner_soal, $jawaban)
    {
        $result = $this->db->query("SELECT tkh.id_kuisioner_soal, tkh.jawaban FROM tb_kuisioner_hasil AS tkh WHERE tkh.id_kuisioner_soal = '$id_kuisioner_soal' AND tkh.jawaban = '$jawaban'");
        return $result;
    }

    public function getWhereHasilSiswa($id_siswa)
    {
        $get = $this->db->query("SELECT tkh.id_kuisioner_hasil, tkh.id_kuisioner_soal, tkh.jawaban FROM tb_kuisioner_hasil AS tkh WHERE id_siswa = '$id_siswa'");

        $result = [];
        foreach ($get->result() as $row) {
            $result[$row->id_kuisioner_soal] = [
                'id_kuisioner_hasil' => $row->id_kuisioner_hasil,
                'jawaban'            => $row->jawaban,
            ];
        }
        return $result;
    }

    public function getHasil($id_kuisioner)
    {
        $result = $this->db->query("SELECT tks.id_kuisioner, tkh.id_siswa, tu.nama FROM tb_kuisioner_soal AS tks LEFT JOIN tb_kuisioner_hasil AS tkh ON tks.id_kuisioner_soal = tkh.id_kuisioner_soal LEFT JOIN tb_siswa AS ts ON tkh.id_siswa = ts.id_siswa LEFT JOIN tb_users AS tu ON ts.id_users = tu.id_users WHERE tks.id_kuisioner = '$id_kuisioner' AND tkh.id_siswa IS NOT NULL GROUP BY tks.id_kuisioner, tkh.id_siswa");
        return $result;
    }

    public function getCheckHasil($id_kuisioner, $id_siswa)
    {
        $result = $this->db->query("SELECT tks.id_kuisioner, tks.id_kuisioner_soal, tks.soal, tkh.id_siswa, tkh.jawaban FROM tb_kuisioner_soal AS tks LEFT JOIN tb_kuisioner_hasil AS tkh ON tks.id_kuisioner_soal = tkh.id_kuisioner_soal WHERE tks.id_kuisioner = '$id_kuisioner' AND tkh.id_siswa = '$id_siswa'");
        return $result;
    }

    public function getDetail($id_kuisioner)
    {
        $result = $this->db->query("SELECT k.id_kuisioner, k.nama FROM tb_kuisioner AS k WHERE k.id_kuisioner = '$id_kuisioner'")->row();
        return $result;
    }

    public function getAllKuisionerDetail($id_kuisioner)
    {
        $result = $this->db->query("SELECT ks.id_kuisioner_soal, ks.id_kuisioner, ks.soal, ks.pil_a, ks.pil_b, ks.pil_c, ks.pil_d, ks.pil_e, k.nama FROM tb_kuisioner_soal AS ks LEFT JOIN tb_kuisioner AS k ON ks.id_kuisioner = k.id_kuisioner WHERE ks.id_kuisioner = '$id_kuisioner' ORDER BY ks.ins ASC");
        return $result;
    }

    public function getAllDataKuisionerSoalDt($id_kuisioner)
    {
        $this->datatables->select('ks.id_kuisioner_soal, ks.id_kuisioner, ks.soal, ks.pil_a, ks.pil_b, ks.pil_c, ks.pil_d, ks.pil_e');
        $this->datatables->where('ks.id_kuisioner', $id_kuisioner);
        $this->datatables->order_by('ks.ins', 'asc');
        $this->datatables->from('tb_kuisioner_soal AS ks');
        return print_r($this->datatables->generate());
    }
}
