  
<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_mapel extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT m.id_mapel, m.nama FROM tb_mapel AS m")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('m.id_mapel, m.nama');
        $this->datatables->order_by('m.ins', 'desc');
        $this->datatables->from('tb_mapel AS m');
        return print_r($this->datatables->generate());
    }
}
