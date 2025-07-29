<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vaksin_model extends CI_Model {

public function get_filter_pas($jenis_kel,$nama,$nik,$tiket,$kategori,$faskes)
{


   

    if($jenis_kel =='0')
      $jenis_kelx = '';
    else
      $jenis_kelx = "AND jenis_kelamin='".$jenis_kel."'";

    if($nama =='0'){
        $namax = '';
    }else{
       $nama = str_replace("%20"," ",$nama);
        $namax = "AND MATCH(nama) AGAINST ('+\"".$nama."\"' IN BOOLEAN MODE)";}

    if($nik =='0'){
        $nikx = '';
      }
    else{
        $nik = str_replace("%20"," ",$nik);
        $nikx = "AND MATCH(nik) AGAINST ('+\"".$nik."\"' IN BOOLEAN MODE)";
      }

    if($tiket =='0')
        $tiketx = '';
    else
        $tiketx = "AND tiket_vaksinasi = '".$tiket."'";

    if($kategori =='0'){
        $kategorix = '';
    }
    else{
       $kategori = str_replace("%20"," ",$kategori);
        $kategorix = "AND kategori = '".$kategori."'";
    }

    if($faskes =='0'){
        $faskesx = '';
    }
    else{
       $faskes = str_replace("%20"," ",$faskes);
        $faskesx = "AND faskes = '".$faskes."'";
    }



  $sql="SELECT * FROM simpus_vaksin  
  WHERE tiket_vaksinasi!=''
    
    $jenis_kelx
    $namax
    $nikx
    $tiketx
    $kategorix
    $faskesx
    ORDER BY nama,vaksinasi ASC
    limit 20
  ";
  $query=$this->db->query($sql);
//echo $this->db->last_query();
  return $query;
}

function get_select($kolom)
  {
    $K=$this->db->query("select * from simpus_vaksin where ".$kolom."!='' group by ".$kolom." ");
    $data['0'] = '0';
    foreach ($K->result_array() as $row)
    {
      $data[$row[$kolom]] = $row[$kolom];
    }
    $K->free_result();
    return $data;
  } 


}