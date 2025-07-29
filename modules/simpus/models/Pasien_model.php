<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien_model extends CI_Model {

    var $table = 'simpus_pasien';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('NAMA_LGKP','NIK','noKartu','NO_MR','NO_KK'); //set column field database for datatable searchable 
    var $order = array('id'=>'desc'); // default order 
    



    private function _get_datatables_query()
    {

        //add custom filter here


        if($this->input->post('NO_KEC'))
        {
            $this->db->where('NO_KEC', $this->input->post('NO_KEC'));
        }

        if($this->input->post('NO_KEL'))
        {
            $this->db->where('NO_KEL', $this->input->post('NO_KEL'));
        }

        if($this->input->post('PUSK_ID'))
        {
            $this->db->where('PUSK_ID', $this->input->post('PUSK_ID'));
        }
        $this->db->where('ACTIVE','1');
        $this->db->limit(10);
        $this->db->from($this->table);
        $i = 0;




        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                   $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                   $this->db->like($item, $_POST['search']['value']);
               }
               else
               {
                $this->db->or_like($item, $_POST['search']['value']);
            }

                if(count($this->column_search) - 1 == $i) //last loop
                {
                  $this->db->group_end(); //close bracket
              }
          }
          $i++;
      }





        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

////
    // cari MR LAMA
    function cari_pasien_lama($mr_lama){
        $show=$this->db->query("select CONCAT(p.`KODE_KK`,p.`NOMOR`) AS MR_LAMA, p.*  from pasien p where concat(p.`KODE_KK`,p.`NOMOR`) = '".$mr_lama."';");    
        if($show->num_rows() > 0 ) {
            return $show->result();
        } else {
            return array();
        }
    } 








    function get_prop()
    {
      $K=$this->db->query("select * from setup_prop order by NO_PROP ASC");

      foreach ($K->result_array() as $row)
      {
        $data[$row['NO_PROP']] = $row['NAMA_PROP'];
    }

    $K->free_result();
    return $data;
}  		


function get_kab($idprop)
{
  $K=$this->db->query("select * from setup_kab where NO_PROP = '$idprop' order by NO_KAB ASC");
  $data[''] = '';
  foreach ($K->result_array() as $row)
  {
    $data[$row['NO_KAB']] = $row['NAMA_KAB'];
}

$K->free_result();
return $data;
}  

function get_kec($idprop,$idkab)
{
  $K=$this->db->query("select * from setup_kec where NO_PROP = '$idprop' AND NO_KAB = '$idkab' order by NO_KEC ASC");
  $data[''] = '';
  foreach ($K->result_array() as $row)
  {
    $data[$row['NO_KEC']] = $row['NAMA_KEC'];
}

$K->free_result();
return $data;
} 

function get_kel($idprop,$idkab,$idkec)
{
  $K=$this->db->query("select * from setup_kel where NO_PROP = '$idprop' AND NO_KAB = '$idkab' AND NO_KEC = '$idkec'  order by NO_KEL ASC");
  $data[''] = '';
  foreach ($K->result_array() as $row)
  {
    $data[$row['NO_KEL']] = $row['NAMA_KEL'];
}

$K->free_result();
return $data;
} 



function get_kerja()
{
  $K=$this->db->query("select * from PKRJN_MASTER order by NO ASC");
  $data[''] = '';
  foreach ($K->result_array() as $row)
  {
    $data[$row['NO']] = $row['DESCRIP'];
}

$K->free_result();
return $data;
} 


public function get_filter_pas($kec,$kel,$jenis_kel,$nama,$nik,$mr,$bpjs,$alamat)
{


    if($kec =='0')
        $kecx = '';
    else
        $kecx = "AND sp.`NO_KEC`='".$kec."'";

    if($kel =='0')
        $kelx = '';
    else
        $kelx = "AND sp.`NO_KEL`='".$kel."'";

    if($jenis_kel =='0')
      $jenis_kelx = '';
    else
      $jenis_kelx = "AND sp.`JENIS_KLMIN`='".$jenis_kel."'";

    if($nama =='0'){
        $namax = '';
    }else{
       $nama = str_replace("%20"," ",$nama);
        $namax = "AND MATCH(sp.`NAMA_LGKP`) AGAINST ('+\"".$nama."\"' IN BOOLEAN MODE)";}

    if($alamat =='0'){
        $alamatx = '';
    }else{
       $alamat = str_replace("%20"," ",$alamat);
        $alamatx = "AND MATCH(sp.`ALAMAT`) AGAINST ('+\"".$alamat."\"' IN BOOLEAN MODE)";}

    if($nik =='0')
        $nikx = '';
    else
        $nikx = "AND sp.`NIK` = '".$nik."'";

    if($mr =='0')
        $mrx = '';
    else
        $mrx = "AND sp.`NO_MR` = '".$mr."'";

    if($bpjs =='0')
        $bpjsx = '';
    else
        $bpjsx = "AND sp.`noKartu` = '".$bpjs."'";

    



  $sql="SELECT * FROM simpus_pasien sp 
  WHERE sp.ACTIVE='1'
    $kecx
    $kelx
    $jenis_kelx
    $namax
    $nikx
    $mrx
    $bpjsx
    $alamatx
    ORDER BY created DESC
    limit 20
  ";
  $query=$this->db->query($sql);
//echo $this->db->last_query();
  return $query;
}

public function get_filter_pas2($kec,$jenis_kel,$nama,$nik,$mr,$bpjs)
{


    if($kec =='0')
        $kecx = '';
    else
        $kecx = "AND sp.`NO_KEC`='".$kec."'";

    if($jenis_kel =='0')
      $jenis_kelx = '';
    else
      $jenis_kelx = "AND sp.`JENIS_KLMIN`='".$jenis_kel."'";

    if($nama =='0'){
        $namax = '';
    }else{
       $nama = str_replace("%20"," ",$nama);
        $namax = "AND sp.`NAMA_LGKP` LIKE '%".$nama."%'";}

    if($nik =='0')
        $nikx = '';
    else
        $nikx = "AND sp.`NIK` = '".$nik."'";

    if($mr =='0')
        $mrx = '';
    else
        $mrx = "AND sp.`NO_MR` = '".$mr."'";

    if($bpjs =='0')
        $bpjsx = '';
    else
        $bpjsx = "AND sp.`noKartu` = '".$bpjs."'";

    



  $sql="SELECT * FROM simpus_pasien sp 
  WHERE sp.ACTIVE='1'
    $kecx 
    $jenis_kelx
    $namax
    $nikx
    $mrx
    $bpjsx
    ORDER BY created DESC
    limit 20
  ";
  $query=$this->db->query($sql);
echo $this->db->last_query();
  return $query;
}

}