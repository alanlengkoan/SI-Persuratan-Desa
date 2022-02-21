<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_informasi extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("")->result();
        return $result;
    }

    public function getWhereDetail($id_informasi)
    {
        $result = $this->db->query("SELECT i.id_informasi, i.judul, i.isi, i.gambar, DATE_FORMAT( i.tgl_publish, '%Y-%m-%d' ) AS tgl_publish, DATE_FORMAT( i.tgl_publish, '%H:%i:%s' ) AS jam_publish, k.nama AS kategori FROM tb_informasi AS i LEFT JOIN tb_kategori AS k ON i.id_kategori = k.id_kategori WHERE i.id_informasi = '$id_informasi'")->row();
        return $result;
    }
    
    public function getWhereStatus($status)
    {
        $result = $this->db->query("SELECT i.id_informasi, i.judul, i.isi, i.gambar, DATE_FORMAT( i.tgl_publish, '%Y-%m-%d' ) AS tgl_publish, DATE_FORMAT( i.tgl_publish, '%H:%i:%s' ) AS jam_publish, k.nama AS kategori FROM tb_informasi AS i LEFT JOIN tb_kategori AS k ON i.id_kategori = k.id_kategori WHERE i.status = '$status'");
        return $result;
    }

    public function getWhereStatusPopuler()
    {
        $result = $this->db->query("SELECT i.id_informasi, i.judul, i.isi, i.gambar, DATE_FORMAT( i.tgl_publish, '%Y-%m-%d') AS tgl_publish, DATE_FORMAT( i.tgl_publish, '%H:%i:%s' ) AS jam_publish, k.nama AS kategori FROM tb_informasi AS i LEFT JOIN tb_kategori AS k ON i.id_kategori = k.id_kategori WHERE i.STATUS = '1' ORDER BY i.tgl_publish ASC LIMIT 5");
        return $result;
    }
    
    public function getWhereGaleri()
    {
        $result = $this->db->query("SELECT i.gambar FROM tb_informasi AS i WHERE status_galeri = '1'");
        return $result;
    }

    public function getWhereStatusAndKategori($status, $id_kategori)
    {
        $result = $this->db->query("SELECT i.id_informasi, i.judul, i.isi, i.gambar, DATE_FORMAT( i.tgl_publish, '%Y-%m-%d' ) AS tgl_publish, DATE_FORMAT( i.tgl_publish, '%H:%i:%s' ) AS jam_publish, k.nama AS kategori FROM tb_informasi AS i LEFT JOIN tb_kategori AS k ON i.id_kategori = k.id_kategori WHERE i.status = '$status' AND i.id_kategori = '$id_kategori'");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('i.id_informasi, i.id_kategori, i.judul, i.isi, i.gambar, i.tgl_publish, i.`status`, i.status_galeri, k.nama AS kategori');
        $this->datatables->join('tb_kategori AS k', 'i.id_kategori = k.id_kategori', 'left');
        $this->datatables->from('tb_informasi AS i');
        return print_r($this->datatables->generate());
    }
}
