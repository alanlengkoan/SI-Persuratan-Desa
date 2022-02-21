  
<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_profil extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT p.profil, p.id_profil, p.isi, p.gambar FROM tb_profil AS p");
        return $result;
    }
    
    public function getAllDetail($id_profil)
    {
        $result = $this->db->query("SELECT p.profil, p.id_profil, p.isi, p.gambar FROM tb_profil AS p WHERE p.id_profil = '$id_profil'")->row();
        return $result;
    }
    
    public function getAllDataDt()
    {
        $this->datatables->select('p.profil, p.id_profil, p.isi, p.gambar');
        $this->datatables->order_by('p.ins', 'asc');
        $this->datatables->from('tb_profil AS p');
        return print_r($this->datatables->generate());
    }
}
