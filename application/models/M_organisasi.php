  
<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_organisasi extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT o.organisasi, o.id_organisasi, o.isi, o.gambar FROM tb_organisasi AS o");
        return $result;
    }
    
    public function getAllDetail($id_organisasi)
    {
        $result = $this->db->query("SELECT o.organisasi, o.id_organisasi, o.isi, o.gambar FROM tb_organisasi AS o WHERE o.id_organisasi = '$id_organisasi'")->row();
        return $result;
    }
    
    public function getAllDataDt()
    {
        $this->datatables->select('o.organisasi, o.id_organisasi, o.isi, o.gambar');
        $this->datatables->order_by('o.ins', 'asc');
        $this->datatables->from('tb_organisasi AS o');
        return print_r($this->datatables->generate());
    }
}
