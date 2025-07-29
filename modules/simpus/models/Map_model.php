<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map_model extends CI_Model {

   
public function getDataPusk($idkat,$idkec){
      if($idkat==0){
        $kat="";
      }else{
        $kat="AND dmd.`id_kategori`='".$idkat."'";
      }

      if($idkec==0){
        $kec="";
      }else{
        $kec="AND dmd.`no_kec`='".$idkec."'";
      }
    $sql="SELECT dmd.`id_unit` as id,dmd.`id_kategori`,CONCAT('[',dmd.`latitude`,',',dmd.`longitude`,']') AS loc, dmd.`nama_unit` as title,latitude,longitude
          FROM data_master_unit_detail dmd WHERE latitude <> '' $kat $kec;";
    $query=$this->db->query($sql);
    //echo $this->db->last_query();
    return $query;  
  }

}