<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Obat_model extends CI_Model {
 
    
    //--=============================================================================
    //                              new script 
    //--=============================================================================
    function getUnit($unitId)
    {
        $this->db->select('*');
        $this->db->from('data_master_unit_detail');
        $this->db->where('id_detail',$unitId);
        $query = $this->db->get();
        return $query;
    }
  
    public function getListObat()
    {
        $sql="SELECT * FROM simpus_master_obat smo group by kode_obat limit 3000";
        $query=$this->db->query($sql);
        return $query;

    }
    public function getIdObat($obat_id)
    {
        $sql = "SELECT * FROM simpus_master_obat WHERE obat_id='".$obat_id."'";
        $query = $this->db->query($sql);
        return $query;
    }
    function getResepDiambil($loketId)
    {
        $sql="SELECT resep_diambil FROM simpus_loket r
        WHERE r.idLoket='".$loketId."'";
       $query = $this->db->query($sql);
       return $query;
    }
    function getDataObatByLoketId($loketId)
    {    
      $sql="SELECT * FROM simpus_resep_obat r
        WHERE r.loketId='".$loketId."'";
       $query = $this->db->query($sql);
       return $query;
    }
    function getDataObatByIdKategori($id_resep)
    {
        $sql="SELECT a.id_resep_detail,b.obat_id,b.kode_obat,b.nama,jumlah,dosis_pakai,tiapJam,kondisi,waktu,nmPoli,satuan FROM simpus_resep_detail a
        INNER JOIN simpus_master_obat b ON a.obat_id=b.OBAT_ID
        inner join simpus_poli_fktp poli on poli.kdPoli=a.poli
        WHERE a.resep_id = '".$id_resep."'";
        $query = $this->db->query($sql);
       return $query;
    }

    function getPemakaianUnit()
    {
        $sql ="SELECT SUM(jumlah+jumlah_puyer) totalPakai FROM simpus_pakai_obat WHERE id_stok_unit=''";
        $query = $this->db->query($sql);
        return $query;
    }


    function get_pop_up_master_obat()
    {
        $sql ="SELECT * FROM simpus_master_obat where aktif='1' order by nama asc";
        $query = $this->db->query($sql);
        return $query;
    }
    function get_pop_up_master_obat_by_id($obat_id)
    {
        $sql ="SELECT * FROM simpus_master_obat where obat_id='".$obat_id."'";
        $query = $this->db->query($sql);
        return $query;
    }
 
}