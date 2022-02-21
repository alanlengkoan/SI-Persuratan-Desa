  
<?php

use PhpOffice\PhpSpreadsheet\Worksheet\Row;

defined('BASEPATH') or exit('No direct script access allowed');

class M_keuangan extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT k.id_keuangan, k.nama FROM tb_keuangan AS k")->result();
        return $result;
    }

    public function getReportKeuangan($id_dana, $tgl_awal, $tgl_akhir)
    {
        $result = $this->db->query("SELECT kr.id_keuangan, d.nama AS dana, k.nama AS uraian, SUM( COALESCE( kr.debit, 0)) AS debit FROM tb_keuangan_rincian AS kr LEFT JOIN tb_keuangan AS k ON kr.id_keuangan = k.id_keuangan LEFT JOIN tb_dana AS d ON kr.id_dana = d.id_dana WHERE kr.status_u = 'd' AND kr.id_dana = '$id_dana' AND kr.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' GROUP BY kr.id_keuangan, k.nama");
        return $result;
    }

    public function getReportOutByMonth($id_keuangan, $bulan)
    {
        $result = $this->db->query("SELECT SUM( kr.kredit) AS kredit FROM tb_keuangan_rincian AS kr WHERE kr.status_u = 'k' AND kr.id_keuangan = '$id_keuangan' AND MONTH( kr.tanggal ) = '$bulan'")->row('kredit');
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('k.id_keuangan, k.nama');
        $this->datatables->order_by('k.ins', 'desc');
        $this->datatables->from('tb_keuangan AS k');
        return print_r($this->datatables->generate());
    }

    public function getAllKeuanganDt($status)
    {
        $this->datatables->select('kr.id_keuangan_rincian, kr.id_keuangan, kr.keterangan, kr.tanggal, kr.debit, kr.kredit, kr.status_u, k.nama AS uraian, d.nama AS dana');
        $this->datatables->join('tb_keuangan AS k', 'kr.id_keuangan = k.id_keuangan', 'left');
        $this->datatables->join('tb_dana AS d', 'kr.id_dana = d.id_dana', 'left');
        $this->datatables->where('kr.status_u', $status);
        $this->datatables->from('tb_keuangan_rincian AS kr');
        return print_r($this->datatables->generate());
    }
}
