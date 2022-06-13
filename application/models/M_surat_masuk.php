<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_surat_masuk extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT sm.id_surat_masuk, sm.no_surat, sm.tgl_surat, sm.tgl_masuk, sm.perihal, sj.nama AS jenis_surat, sa.nama AS asal_surat, ss.nama AS sifat_surat FROM tb_surat_masuk AS sm LEFT JOIN tb_surat_jenis AS sj ON sm.id_surat_jenis = sj.id_surat_jenis LEFT JOIN tb_surat_asal AS sa ON sm.id_surat_asal = sa.id_surat_asal LEFT JOIN tb_surat_sifat AS ss ON sm.id_surat_sifat = ss.id_surat_sifat")->result();
        return $result;
    }

    public function getDetail($id_surat_masuk)
    {
        $result = $this->db->query("SELECT sm.id_surat_masuk, sm.no_surat, sm.tgl_surat, sm.tgl_masuk, sm.perihal, sm.arsip, sm.arsip_tipe, sj.nama AS jenis_surat, sa.nama AS asal_surat, ss.nama AS sifat_surat FROM tb_surat_masuk AS sm LEFT JOIN tb_surat_jenis AS sj ON sm.id_surat_jenis = sj.id_surat_jenis LEFT JOIN tb_surat_asal AS sa ON sm.id_surat_asal = sa.id_surat_asal LEFT JOIN tb_surat_sifat AS ss ON sm.id_surat_sifat = ss.id_surat_sifat WHERE sm.id_surat_masuk = '$id_surat_masuk'")->row();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('sm.id_surat_masuk, sm.no_surat, sm.tgl_surat, sm.tgl_masuk, sj.nama AS jenis_surat, sa.nama AS asal_surat, ss.nama AS sifat_surat');
        $this->datatables->join('tb_surat_jenis AS sj', 'sm.id_surat_jenis = sj.id_surat_jenis', 'left');
        $this->datatables->join('tb_surat_asal AS sa', 'sm.id_surat_asal = sa.id_surat_asal', 'left');
        $this->datatables->join('tb_surat_sifat AS ss', 'sm.id_surat_sifat = ss.id_surat_sifat', 'left');
        $this->datatables->order_by('sm.ins', 'desc');
        $this->datatables->from('tb_surat_masuk AS sm');
        return print_r($this->datatables->generate());
    }
}