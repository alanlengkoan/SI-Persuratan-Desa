<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_surat_tujuan extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT st.id_surat_tujuan, st.nama, st.email, st.telepon, st.alamat FROM tb_surat_tujuan AS st")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('st.id_surat_tujuan, st.nama, st.email, st.telepon, st.alamat');
        $this->datatables->order_by('st.ins', 'desc');
        $this->datatables->from('tb_surat_tujuan AS st');
        return print_r($this->datatables->generate());
    }
}