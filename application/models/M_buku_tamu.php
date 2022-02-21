<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_buku_tamu extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT bt.id_buku_tamu, bt.ip_address, bt.nama, bt.kelamin, bt.telepon, bt.email, bt.alamat, bt.keperluan FROM tb_buku_tamu AS bt ORDER BY bt.ins ASC");
        return $result;
    }
}
