<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_surat_keluar extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT sk.id_surat_keluar, sk.no_surat, sk.tgl_surat, sk.tgl_keluar, sj.nama AS jenis_surat, st.nama AS tujuan_surat, ss.nama AS sifat_surat FROM tb_surat_keluar AS sk LEFT JOIN tb_surat_jenis AS sj ON sk.id_surat_jenis = sj.id_surat_jenis LEFT JOIN tb_surat_tujuan AS st ON sk.id_surat_tujuan = st.id_surat_tujuan LEFT JOIN tb_surat_sifat AS ss ON sk.id_surat_sifat = ss.id_surat_sifat")->result();
        return $result;
    }

    public function getDetail($id_surat_keluar)
    {
        $result = $this->db->query("SELECT sk.id_surat_keluar, sk.no_surat, sk.tgl_surat, sk.tgl_keluar, sk.perihal, sk.isi, sj.nama AS jenis_surat, st.nama AS tujuan_surat, ss.nama AS sifat_surat FROM tb_surat_keluar AS sk LEFT JOIN tb_surat_jenis AS sj ON sk.id_surat_jenis = sj.id_surat_jenis LEFT JOIN tb_surat_tujuan AS st ON sk.id_surat_tujuan = st.id_surat_tujuan LEFT JOIN tb_surat_sifat AS ss ON sk.id_surat_sifat = ss.id_surat_sifat WHERE sk.id_surat_keluar = '$id_surat_keluar'")->row();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('sk.id_surat_keluar, sk.no_surat, sk.tgl_surat, sk.tgl_keluar, sk.perihal, sk.isi, sj.nama AS jenis_surat, st.nama AS tujuan_surat, ss.nama AS sifat_surat');
        $this->datatables->join('tb_surat_jenis AS sj', 'sk.id_surat_jenis = sj.id_surat_jenis', 'left');
        $this->datatables->join('tb_surat_tujuan AS st', 'sk.id_surat_tujuan = st.id_surat_tujuan', 'left');
        $this->datatables->join('tb_surat_sifat AS ss', 'sk.id_surat_sifat = ss.id_surat_sifat', 'left');
        $this->datatables->order_by('sk.ins', 'desc');
        $this->datatables->from('tb_surat_keluar AS sk');
        return print_r($this->datatables->generate());
    }
}