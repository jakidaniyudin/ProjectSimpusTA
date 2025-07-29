<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gizi_model extends CI_Model {


    public function getId()
    {
        $user_id = $this->session->userdata('user_id');
        $this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
        return $this->id;
    }
    public function getUnit()
    {
        $this->db->select('id_detail,id_unit,nama_unit');
        $this->db->from('data_master_unit_detail as a');
        $this->db->where('a.id_detail',$this->getId());

        $query = $this->db->get();
        return $query;
    }

    public function getPoliGizi()
    {
        $idpkm = $this->ion_auth->unit();
        if($idpkm != '46')
            $unit="AND puskId ='".$idpkm."'";
        else
            $unit="";

        $tgl=date("Y-m-d");
        $sql= "SELECT COUNT(*) AS jumlahGizi
        FROM simpus_loket sl 
        inner join simpus_pelayanan sp on sp.loketId=sl.idLoket
        WHERE tglKunjungan = '".$tgl."' 
        $unit AND sp.kdPoli ='997'";
        $query=$this->db->query($sql);
    
        return $query;
    }

      
}



