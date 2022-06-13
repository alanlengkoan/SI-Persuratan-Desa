<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_surat_keluar extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT sk.id_surat_keluar, sk.no_surat, sk.tgl_surat, sk.tgl_keluar, sk.perihal, sk.approve, sj.nama AS jenis_surat, st.nama AS tujuan_surat, ss.nama AS sifat_surat FROM tb_surat_keluar AS sk LEFT JOIN tb_surat_jenis AS sj ON sk.id_surat_jenis = sj.id_surat_jenis LEFT JOIN tb_surat_tujuan AS st ON sk.id_surat_tujuan = st.id_surat_tujuan LEFT JOIN tb_surat_sifat AS ss ON sk.id_surat_sifat = ss.id_surat_sifat")->result();
        return $result;
    }

    public function getDetail($id_surat_keluar)
    {
        $result = $this->db->query("SELECT sk.id_surat_keluar, sk.no_surat, sk.tgl_surat, sk.tgl_keluar, sk.perihal, sk.approve, sj.nama AS jenis_surat, st.nama AS tujuan_surat, ss.nama AS sifat_surat, sk.foto_ktp, sk.arsip, sk.arsip_tipe FROM tb_surat_keluar AS sk LEFT JOIN tb_surat_jenis AS sj ON sk.id_surat_jenis = sj.id_surat_jenis LEFT JOIN tb_surat_tujuan AS st ON sk.id_surat_tujuan = st.id_surat_tujuan LEFT JOIN tb_surat_sifat AS ss ON sk.id_surat_sifat = ss.id_surat_sifat WHERE sk.id_surat_keluar = '$id_surat_keluar'")->row();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('sk.id_surat_keluar, sk.no_surat, sk.tgl_surat, sk.tgl_keluar, sk.perihal, sk.approve, sj.nama AS jenis_surat, st.nama AS tujuan_surat, ss.nama AS sifat_surat, ka.*, sk.arsip_tipe, sk.arsip');
        $this->datatables->join('tb_surat_jenis AS sj', 'sk.id_surat_jenis = sj.id_surat_jenis', 'left');
        $this->datatables->join('tb_surat_tujuan AS st', 'sk.id_surat_tujuan = st.id_surat_tujuan', 'left');
        $this->datatables->join('tb_surat_sifat AS ss', 'sk.id_surat_sifat = ss.id_surat_sifat', 'left');
        $this->datatables->join('tb_keluarga_anggota AS ka', 'ka.id_users = sk.id_users', 'left');
        $this->datatables->order_by('sk.ins', 'desc');
        $this->datatables->from('tb_surat_keluar AS sk');
        return print_r($this->datatables->generate());
    }

    public function getAllDataUsersDt($id_users)
    {
        $this->datatables->select('sk.id_surat_keluar, sk.id_users, sk.perihal, sk.approve, sj.nama AS jenis_surat, st.nama AS tujuan_surat, ss.nama AS sifat_surat, sk.arsip_tipe, sk.arsip');
        $this->datatables->join('tb_surat_jenis AS sj', 'sk.id_surat_jenis = sj.id_surat_jenis', 'left');
        $this->datatables->join('tb_surat_tujuan AS st', 'sk.id_surat_tujuan = st.id_surat_tujuan', 'left');
        $this->datatables->join('tb_surat_sifat AS ss', 'sk.id_surat_sifat = ss.id_surat_sifat', 'left');
        $this->datatables->where('sk.id_users', $id_users);
        $this->datatables->order_by('sk.ins', 'desc');
        $this->datatables->from('tb_surat_keluar AS sk');
        return print_r($this->datatables->generate());
    }

    public function getApprovalSuratKeluarUsers($id_users, $approve)
    {
        $result = $this->db->query("SELECT sk.id_surat_keluar, sk.id_users, sk.no_surat, sk.tgl_surat, sk.tgl_keluar, sk.perihal, sk.approve, sj.nama AS jenis_surat, st.nama AS tujuan_surat, ss.nama AS sifat_surat FROM tb_surat_keluar AS sk LEFT JOIN tb_surat_jenis AS sj ON sk.id_surat_jenis = sj.id_surat_jenis LEFT JOIN tb_surat_tujuan AS st ON sk.id_surat_tujuan = st.id_surat_tujuan LEFT JOIN tb_surat_sifat AS ss ON sk.id_surat_sifat = ss.id_surat_sifat WHERE sk.id_users = '$id_users' AND sk.approve = '$approve' ORDER BY sk.ins");
        return $result;
    }
}