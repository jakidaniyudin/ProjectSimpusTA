<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umum_model extends CI_Model {

	var $table = 'simpus_pelayanan as pel';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array(''); //set column field database for datatable searchable 
    var $order = array('idpelayanan'=>'desc'); // default order 



    public function getId()
    {
    	$user_id = $this->session->userdata('user_id');
    	$this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
    	return $this->id;

    }
    private function _get_datatables_query()
    {

    	$this->db->select('idpelayanan,pasien.NO_PROP,pasien.NO_KAB,pasien.NO_KEC,pasien.NO_KEL,tglKunjungan,NIK,pasien.noKartu,NAMA_LGKP,NO_MR,pasien.ALAMAT,NO_RT,NO_RW,statusKartu, loket.noKunjungan,loket.noUrut,pel.kdPoli,unit.nama_unit,pel.sudahDilayani,pasien.ID');


    	if($this->input->post('id_detail'))
    	{
    		$this->db->where('unit.id_detail', $this->input->post('id_detail'));
    	}

    	if($this->input->post('tglKunjungan'))
    	{
    		$tglKunjungan=date("Y-m-d", strtotime($this->input->post('tglKunjungan')));
    		$this->db->where('loket.tglKunjungan', $tglKunjungan);
    	}	

    	$this->db->join('simpus_loket as loket','pel.loketId = loket.idLoket');
    	$this->db->join('simpus_pasien as pasien','pasien.ID = loket.pasienId');
    	$this->db->join('data_master_unit_detail as unit','unit.id_detail = loket.unitId');


    	if($this->getId().$this->id!=46){
    		$where="(pel.`kdPoli`='001')";
    		$this->db->where($where);
    	}

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
     // echo $this->db->last_query();
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
   $this->_get_datatables_query();
   $query = $this->db->get();
   return $this->db->count_all_results();
}





    //======= LAPORAN =========== =D

    //lap1
function getDiagnosaLapKesakitan($unit,$unit_details,$tgl_awal,$tgl_akhir,$diagnosa,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = "AND puskId='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND `unitId`= '".$unit_details."'";

        //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND kategoriUnitId='".$unit."'";

        //diagnosa
if($diagnosa == '0'){
  $diagnosax = "";
}
else{
  $diagnosax = "AND diag.`kdDiagnosa`= '".$diagnosa."'";
}

$sql="SELECT sk.kdDiagnosa,sk.nmDiagnosa,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 1 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru07L, 
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 1 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru07P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 1 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama07L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 1 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama07P,
        #umur 8-28 hari
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 2 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru828L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 2 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru828P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 2 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama828L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 2 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama828P,
        #umur 1-12 bulan
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 3 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru112L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 3 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru112P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 3 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama112L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 3 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama112P,
        #umur 1-4 tahun
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 4 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru14L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 4 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru14P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 4 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama14L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 4 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama14P,
        #umur 5-9 tahun
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 5 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru59L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 5 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru59P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 5 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama59L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 5 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama59P,
        #umur 10-14 tahun
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 6 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru1014L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 6 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru1014P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 6 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama1014L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 6 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama1014P,
        #umur 15-19 tahun
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 7 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru1519L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 7 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru1519P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 7 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama1519L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 7 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama1519P,
        #umur 20-44 tahun
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 8 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru2044L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 8 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru2044P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 8 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama2044L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 8 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama2044P,
        #umur 45-54 tahun
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 9 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru4554L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 9 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru4554P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 9 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama4554L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 9 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama4554P,
        #umur 55-59 tahun
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 10 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru5559L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 10 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru5559P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 10 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama5559L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 10 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama5559P,
        #umur 60-69 tahun
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 11 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru6069L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 11 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru6069P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 11 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama6069L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 11 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama6069P,
        #umur >= 70 tahun
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 12 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru70L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`kelUmur` = 12 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru70P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 12 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama70L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`kelUmur` = 12 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama70P,

SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`JENIS_KLMIN`='1',1,0)) AS jmlBaruL,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`JENIS_KLMIN`='2',1,0)) AS jmlBaruP,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`JENIS_KLMIN`='1',1,0)) AS jmlLamaL,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND sk.`JENIS_KLMIN`='2',1,0)) AS jmlLamaP
FROM 
(SELECT diag.`kdDiagnosa`,diag.`nmDiagnosa`,diag.`diagnosaKasus`,lok.`pasienId`,lok.`kelUmur`,
   lok.`puskId`,lok.`unitId`,lok.`tglKunjungan`,lok.`kategoriUnitId`,JENIS_KLMIN
   FROM
   simpus_loket lok
   INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
   INNER JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
   INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId` 
   INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori 
   INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
   WHERE lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
   $unitx
   $idpkm
   $unit_details_x
   $diagnosax) sk
   where kdDiagnosa !=''
   GROUP BY kdDiagnosa
   ORDER BY kdDiagnosa ASC;";
   $query=$this->db->query($sql);
  // echo $this->db->last_query();
   return $query;
}

    //lap2
function getDataLapJiwa($unit,$unit_details,$tgl_awal,$tgl_akhir,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND puskId='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND `unitId`= '".$unit_details."'";

        //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND kategoriUnitId='".$unit."'";

$sql="SELECT sk.`kdDiag`,sk.`nmDiag`,
    #umur < 1TH
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`umur` < 1 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru0L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`umur` < 1 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru0P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` < 1 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama0L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` < 1 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama0P,
        #umur 1 -4 1TH
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`umur` >=1 AND sk.`umur` <= 4 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru14L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`umur` >=1 AND sk.`umur` <= 4 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru14P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=1 AND sk.`umur` <= 4 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama14L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=1 AND sk.`umur` <= 4 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama14P,
        #umur 5 -14 1TH
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`umur` >=5 AND sk.`umur` <= 14 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru514L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`umur` >=5 AND sk.`umur` <= 14 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru514P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=5 AND sk.`umur` <= 14 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama514L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=5 AND sk.`umur` <= 14 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama514P,
        #umur 15 - 44 1TH
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`umur` >=15 AND sk.`umur` <= 44 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru1544L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`umur` >=15 AND sk.`umur` <= 44 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru1544P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=15 AND sk.`umur` <= 44 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama1544L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=15 AND sk.`umur` <= 44 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama1544P,
        #umur 45 - 54 1TH
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`umur` >=45 AND sk.`umur` <= 54 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru4554L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`umur` >=45 AND sk.`umur` <= 54 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru4554P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=45 AND sk.`umur` <= 54 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama4554L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=45 AND sk.`umur` <= 54 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama4554P,
        #umur 55 - 64 1TH
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`umur` >=55 AND sk.`umur` <= 64 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru5564L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`umur` >=55 AND sk.`umur` <= 64 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru5564P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=55 AND sk.`umur` <= 64 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama5564L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=55 AND sk.`umur` <= 64 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama5564P,
        #umur > 65 1TH
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`umur` >=65 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru65L,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND  sk.`umur` >=65 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru65P,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=65 AND sk.`JENIS_KLMIN`='1',1,0)) AS lama65L,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`umur` >=65 AND sk.`JENIS_KLMIN`='2',1,0)) AS lama65P,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`JENIS_KLMIN`='1',1,0)) AS jmlBaruL,
SUM(IF((sk.diagnosaKasus='1' OR sk.diagnosaKasus='3') AND sk.`JENIS_KLMIN`='2',1,0)) AS jmlBaruP,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND  sk.`JENIS_KLMIN`='1',1,0)) AS jmlLamaL,
SUM(IF((sk.diagnosaKasus='2' OR sk.diagnosaKasus='4') AND sk.`JENIS_KLMIN`='2',1,0)) AS jmlLamaP

FROM (SELECT sd.`kdDiag`,sd.`nmDiag`,diag.`kdDiagnosa`,diag.`nmDiagnosa`,diag.`diagnosaKasus`,lok.`pasienId`,lok.`kelUmur`,lok.umur,
   lok.`puskId`,lok.`unitId`,lok.`tglKunjungan`,lok.`kategoriUnitId`,JENIS_KLMIN
   FROM
   simpus_loket lok
   INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
   INNER JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
   INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
   INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori` 
   INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
   INNER JOIN simpus_diagnosa sd ON diag.`kdDiagnosa`=sd.`kdDiag`
   WHERE 
   sd.`jiwa`='1'
   AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
   $unitx
   $idpkm
   $unit_details_x
   ) sk

   GROUP BY kdDiag
   ORDER BY kdDiag ASC;";
   $query=$this->db->query($sql);
    //echo $this->db->last_query();
   return $query;
}

     //3==========================================LAPORAN SURVEILANS==================================================
function getDataLapSurveilans($unit,$unit_details,$tgl_awal,$tgl_akhir,$pusk)
{
   if($pusk=='0')
    $idpkm =" AND puskId='".$pusk."' ";
else
    $idpkm = " AND puskId='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND `unitId`= '".$unit_details."'";
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND kategoriUnitId='".$unit."'";

$sql="SELECT kdDiag,nmDiag,
SUM(IF(sk.`kelUmur` = 1 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru07L,
SUM(IF(sk.`kelUmur` = 1 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru07P,
SUM(IF(sk.`kelUmur` = 2 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru828L,
SUM(IF(sk.`kelUmur` = 2 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru828P,
SUM(IF(sk.`kelUmur` = 3 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru112L,
SUM(IF(sk.`kelUmur` = 3 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru112P,
SUM(IF(sk.`kelUmur` = 4 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru14L,
SUM(IF(sk.`kelUmur` = 4 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru14P,
SUM(IF(sk.`kelUmur` = 5 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru59L,
SUM(IF(sk.`kelUmur` = 5 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru59P,
SUM(IF(sk.`kelUmur` = 6 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru1014L,
SUM(IF(sk.`kelUmur` = 6 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru1014P,
SUM(IF(sk.`kelUmur` = 7 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru1519L,
SUM(IF(sk.`kelUmur` = 7 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru1519P,
SUM(IF(sk.`kelUmur` = 8 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru2044L,
SUM(IF(sk.`kelUmur` = 8 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru2044P,
SUM(IF(sk.`kelUmur` = 9 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru4554L,
SUM(IF(sk.`kelUmur` = 9 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru4554P,
SUM(IF(sk.`kelUmur` = 10 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru5559L,
SUM(IF(sk.`kelUmur` = 10 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru5559P,
SUM(IF(sk.`kelUmur` = 11 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru6069L,
SUM(IF(sk.`kelUmur` = 11 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru6069P,
SUM(IF(sk.`kelUmur` = 12 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru70L,
SUM(IF(sk.`kelUmur` = 12 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru70P,
SUM(IF(sk.`JENIS_KLMIN`='1',1,0)) AS jmlBaruL,
SUM(IF(sk.`JENIS_KLMIN`='2',1,0)) AS jmlBaruP

FROM (SELECT sd.`kdDiag`,sd.`nmDiag`,diag.`kdDiagnosa`,diag.`nmDiagnosa`,diag.`diagnosaKasus`,lok.`pasienId`,lok.`kelUmur`,
   lok.`puskId`,lok.`unitId`,lok.`tglKunjungan`,lok.`kategoriUnitId`,JENIS_KLMIN
   FROM
   simpus_loket lok
   INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
   INNER JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
   INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
   INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori` 
   INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
   INNER JOIN simpus_diagnosa sd ON diag.`kdDiagnosa`=sd.`kdDiag`
   WHERE 
   sd.`surveilans` ='1'
   AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
   $unitx
   $idpkm
   $unit_details_x
   ) sk

   GROUP BY kdDiag
   ORDER BY kdDiag ASC;";

   $query=$this->db->query($sql);
   echo $this->db->last_query();
   return $query;
}

    //4==========================================LAPORAN WABAH==================================================
function getLapWabah($pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = "WHERE PUSK_ID='".$pusk."' ";

$sql="SELECT NO_KEL,NAMA_KEL FROM setup_kel_bwi_new
$idpkm ";
$query=$this->db->query($sql);
       //echo $this->db->last_query();
return $query;
}

function getDataLapWabah($kdKel,$unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
   if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND puskId='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND `unitId`= '".$unit_details."'";
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND kategoriUnitId='".$unit."'";

$sql="SELECT
SUM(IF(sk.`diare`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS diareL,
SUM(IF(sk.`diare`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS diareP,
SUM(IF(sk.`klorea`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS kloreaL,
SUM(IF(sk.`klorea`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS kloreaP,
SUM(IF(sk.`dhf`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS dhfL,
SUM(IF(sk.`dhf`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS dhfP,
SUM(IF(sk.`tbparu`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS tbparuL,
SUM(IF(sk.`tbparu`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS tbparuP,
SUM(IF(sk.`diphteri`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS diphteriL,
SUM(IF(sk.`diphteri`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS diphteriP,
SUM(IF(sk.`hepatitis`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS hepatitisL,
SUM(IF(sk.`hepatitis`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS hepatitisP,
SUM(IF(sk.`campak`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS campakL,
SUM(IF(sk.`campak`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS campakP,
SUM(IF(sk.`rabies`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS rabiesL,
SUM(IF(sk.`rabies`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS rabiesP,
SUM(IF(sk.`tetneo`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS tetneoL,
SUM(IF(sk.`tetneo`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS tetneoP,
SUM(IF(sk.`influinza`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS influinzaL,
SUM(IF(sk.`influinza`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS influinzaP,
SUM(IF(sk.`thypoid`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS thypoidL,
SUM(IF(sk.`thypoid`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS thypoidP,
SUM(IF(sk.`cikungunya`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS cikungunyaL,
SUM(IF(sk.`cikungunya`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS cikungunyaP,
SUM(IF(sk.`leptosperosis`='1' AND sk.`JENIS_KLMIN`='1',1,0)) AS leptosperosisL,
SUM(IF(sk.`leptosperosis`='1' AND sk.`JENIS_KLMIN`='2',1,0)) AS leptosperosisP

FROM (SELECT sd.*,diag.`kdDiagnosa`,diag.`nmDiagnosa`,diag.`diagnosaKasus`,lok.`pasienId`,
   lok.`puskId`,lok.`unitId`,lok.`tglKunjungan`,lok.`kategoriUnitId`,JENIS_KLMIN
   FROM
   simpus_loket lok
   INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
   INNER JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
   INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
   INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori` 
   INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
   INNER JOIN simpus_diagnosa sd ON diag.`kdDiagnosa`=sd.`kdDiag`

   WHERE 
   sp.`NO_KEL`='".$kdKel."'
   AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
   $unitx
   $idpkm
   $unit_details_x
) sk;";
$query=$this->db->query($sql);
       //echo $this->db->last_query();
return $query;
}

    //5================================LAPORAN LEMBAR SURVEILANS EPIDEMIOLOGI CAMPAK=============================

function getlapEpidemoligiCampak($unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
	if($pusk=='0')
        $idpkm ='';
    else
        $idpkm = " AND puskId='".$pusk."' ";

    $tglAwal=date("Y-m-d",strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

    if($unit_details == '0')
      $unit_details_x = "";
  else
      $unit_details_x = "AND `unitId`= '".$unit_details."'";
  if($unit =='0')
      $unitx = '';
  else
      $unitx = "AND kategoriUnitId='".$unit."'";


  $sql="SELECT sp.`NAMA_LGKP`,lok.`umur`,lok.`tglKunjungan`
  FROM
  simpus_loket lok
  INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
  INNER JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
  INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
  INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori` 
  INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
  INNER JOIN simpus_diagnosa sd ON diag.`kdDiagnosa`=sd.`kdDiag`

  WHERE 
  sd.`campak`='1'
  AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
  $unitx
  $idpkm
  $unit_details_x;" ;
  $query=$this->db->query($sql);
       // echo $this->db->last_query();
  return $query;
}

    //6==========================================LAPORAN PENYAKIT TERBESAR=======================================

public function getLapPenyakitTerbesar($unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$poli,$pusk)
{
	if($pusk=='0')
        $idpkm ='';
    else
        $idpkm = " AND puskId='".$pusk."' ";

    $tglAwal=date("Y-m-d",strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

    if($unit_details == '0')
      $unit_details_x = "";
  else
      $unit_details_x = "AND `unitId`= '".$unit_details."'";
  if($unit =='0')
      $unitx = '';
  else
      $unitx = "AND kategoriUnitId='".$unit."'";

  if($poli =='0')
    $polix = '';
else
    $polix = "AND (pel.`kdPoli`='".$poli."' OR pel.`tujuanPoli`='".$poli."')";

$sql="SELECT kdDiagnosa,nmDiagnosa,COUNT(kdDiagnosa) AS jml,
SUM(IF(sk.`diagnosaKasus`='1' AND `JENIS_KLMIN`='1',1,0)) AS baruL,
SUM(IF(sk.`diagnosaKasus`='1' AND `JENIS_KLMIN`='2',1,0)) AS baruP,
SUM(IF(sk.`diagnosaKasus`='2' AND `JENIS_KLMIN`='1',1,0)) AS lamaL,
SUM(IF(sk.`diagnosaKasus`='2' AND `JENIS_KLMIN`='2',1,0)) AS lamaP,
SUM(IF(sk.`diagnosaKasus`='3' AND `JENIS_KLMIN`='1',1,0)) AS kunBaruL,
SUM(IF(sk.`diagnosaKasus`='3' AND `JENIS_KLMIN`='2',1,0)) AS kunBaruP,
SUM(IF(sk.`diagnosaKasus`='4' AND `JENIS_KLMIN`='1',1,0)) AS kunLamaL,
SUM(IF(sk.`diagnosaKasus`='4' AND `JENIS_KLMIN`='2',1,0)) AS kunLamaP
FROM (SELECT diag.`kdDiagnosa`,diag.`nmDiagnosa`,diag.`diagnosaKasus`,JENIS_KLMIN
	FROM
	simpus_loket lok
	INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
	INNER JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
	INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
	INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori` 
	INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
	INNER JOIN simpus_diagnosa sd ON diag.`kdDiagnosa`=sd.`kdDiag`

	WHERE 
	lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
	$unitx
    $polix
    $idpkm
    $unit_details_x
     AND diag.`kdDiagnosa` != ''
    ) sk
    GROUP BY kdDiagnosa
    ORDER BY jml DESC LIMIT 25;" ;
    $query=$this->db->query($sql);
       //  echo $this->db->last_query();
    return $query;
}
    //8======================LAPORAN REKAPITULASI KUNJUNGAN KASUS PASIEN RAWAT JALAN=================================
function getlapRekapKunjRawatJalan($pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " WHERE sk.`PUSK_ID`='".$pusk."' ";

$sql="SELECT 9999 AS NO_KEL,'LUAR WILAYAH' AS NAMA_KEL 
UNION SELECT NO_KEL,NAMA_KEL FROM setup_kel_bwi_new sk
$idpkm ORDER BY NO_KEL";
$query=$this->db->query($sql);
       //echo $this->db->last_query();
return $query;
}
function getDatalapRekapKunjRawatJalan($kdKel,$unit,$unit_details,$tgl_awal,$tgl_akhir,$diagnosa,$pusk)
{
	if($pusk=='0')
        $idpkm ='';
    else
        $idpkm = " AND puskId='".$pusk."' ";

    $tglAwal=date("Y-m-d",strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

    if($unit_details == '0')
      $unit_details_x = "";
  else
      $unit_details_x = "AND `unitId`= '".$unit_details."'";
  if($unit =='0')
      $unitx = '';
  else
      $unitx = "AND kategoriUnitId='".$unit."'";

  if($diagnosa == '0'){
      $diagnosax = "";
  }
  else{
      $diagnosax = "AND diag.`kdDiagnosa`= '".$diagnosa."'";
  }

  if($kdKel =='9999')
      $kelx = "AND lok.`wilayah`='2'";
  else
      $kelx = "AND sp.`NO_KEL`='".$kdKel."' AND lok.`wilayah`='1' ";

  $sql="SELECT
  SUM(IF(sk.`kelUmur` = 1 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru07L,
  SUM(IF(sk.`kelUmur` = 1 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru07P,
  SUM(IF(sk.`kelUmur` = 2 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru828L,
  SUM(IF(sk.`kelUmur` = 2 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru828P,
  SUM(IF(sk.`kelUmur` = 3 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru112L,
  SUM(IF(sk.`kelUmur` = 3 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru112P,
  SUM(IF(sk.`kelUmur` = 4 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru14L,
  SUM(IF(sk.`kelUmur` = 4 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru14P,
  SUM(IF(sk.`kelUmur` = 5 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru59L,
  SUM(IF(sk.`kelUmur` = 5 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru59P,
  SUM(IF(sk.`kelUmur` = 6 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru1014L,
  SUM(IF(sk.`kelUmur` = 6 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru1014P,
  SUM(IF(sk.`kelUmur` = 7 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru1519L,
  SUM(IF(sk.`kelUmur` = 7 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru1519P,
  SUM(IF(sk.`kelUmur` = 8 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru2044L,
  SUM(IF(sk.`kelUmur` = 8 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru2044P,
  SUM(IF(sk.`kelUmur` = 9 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru4554L,
  SUM(IF(sk.`kelUmur` = 9 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru4554P,
  SUM(IF(sk.`kelUmur` = 10 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru5559L,
  SUM(IF(sk.`kelUmur` = 10 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru5559P,
  SUM(IF(sk.`kelUmur` = 11 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru6069L,
  SUM(IF(sk.`kelUmur` = 11 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru6069P,
  SUM(IF(sk.`kelUmur` = 12 AND sk.`JENIS_KLMIN`='1',1,0)) AS baru70L,
  SUM(IF(sk.`kelUmur` = 12 AND sk.`JENIS_KLMIN`='2',1,0)) AS baru70P,
  SUM(IF(sk.`JENIS_KLMIN`='1',1,0)) AS jmlBaruL,
  SUM(IF(sk.`JENIS_KLMIN`='2',1,0)) AS jmlBaruP,
  SUM(IF(sk.`JENIS_KLMIN`='2' OR sk.`JENIS_KLMIN`='1',1,0)) AS jmlBaruLP


  FROM (SELECT diag.`kdDiagnosa`,diag.`nmDiagnosa`,diag.`diagnosaKasus`,lok.`pasienId`,lok.`kelUmur`,
   lok.`puskId`,lok.`unitId`,lok.`tglKunjungan`,lok.`kategoriUnitId`,JENIS_KLMIN,lok.`wilayah`
   FROM simpus_loket lok 
   INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket` 
   INNER JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan` 
   INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
   INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori` 
   INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
   LEFT JOIN setup_kec_bwi_new kec ON kec.`NO_KEC`=sp.`NO_KEC`
   LEFT JOIN setup_kel_bwi_new kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL`
   WHERE  lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'

   $idpkm
   $unit_details_x
   $unitx
   $diagnosax
   $kelx) sk";
   $query=$this->db->query($sql);
     //  echo $this->db->last_query();
   return $query;
}
    //lap9
public function getLap_rekap_tind($unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
	if($pusk=='0')
        $idpkm ='';
    else
        $idpkm = " AND puskId='".$pusk."' ";

    $tglAwal=date("Y-m-d",strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

    if($unit_details == '0')
      $unit_details_x = "";
  else
      $unit_details_x = "AND `unitId`= '".$unit_details."'";
  if($unit =='0')
      $unitx = '';
  else
      $unitx = "AND kategoriUnitId='".$unit."'";

  $sql="SELECT t.`kdTindakan`,t.`nmTindakan`,COUNT(t.`kdTindakan`) AS jml,trk.`nilai_tarif_pajak` AS harga,
  COUNT(t.`kdTindakan`)*trk.`nilai_tarif_pajak` AS total
  FROM simpus_tindakan t
  INNER JOIN simpus_loket lok ON lok.`idLoket`=t.`loketId`
  LEFT JOIN tarif_retribusi_kesehatan trk ON t.`kdTindakan`=trk.`kd_rek_tarif_pajak`
  INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId` 
  INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
  WHERE  tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."' 
  $unitx
  $idpkm
  $unit_details_x
  $unitx
  GROUP BY kdTindakan ORDER BY jml DESC" ;
  $query=$this->db->query($sql);
  echo $this->db->last_query();

  return $query;
}

public function getLap_rekap_tind_retribusi($unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
	if($pusk=='0')
        $idpkm ='';
    else
        $idpkm = " AND puskId='".$pusk."' ";

    $tglAwal=date("Y-m-d",strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

    if($unit_details == '0')
      $unit_details_x = "";
  else
      $unit_details_x = "AND `unitId`= '".$unit_details."'";
  if($unit =='0')
      $unitx = '';
  else
      $unitx = "AND kategoriUnitId='".$unit."'";

  $sql="SELECT t.`kdTindakan`,t.`nmTindakan`,COUNT(t.`kdTindakan`) AS jml,trk.`nilai_tarif_pajak` AS harga,
  COUNT(t.`kdTindakan`)*trk.`nilai_tarif_pajak` AS total
  FROM simpus_tindakan t
  INNER JOIN simpus_loket lok ON lok.`idLoket`=t.`loketId`
  LEFT JOIN tarif_retribusi_kesehatan trk ON t.`kdTindakan`=trk.`kd_rek_tarif_pajak`
  INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId` 
  INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
  WHERE lok.`noKartu` !='' AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."' $unitx
  $idpkm
  $unit_details_x
  $unitx
  GROUP BY kdTindakan ORDER BY jml DESC" ;
  $query=$this->db->query($sql);
  // echo $this->db->last_query();

  return $query;
}

        //10==========================================LAPORAN REGISTER RAWAT JALAN=======================================
public function get_lap_reg_kunj_pas($unit,$unit_details,$tgl_awal,$tgl_akhir,$diagnosa,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";

if($diagnosa == '0')
  $diagnosax = "";
else
  $diagnosax = "AND sdd.`kdDiagnosa`= '".$diagnosa."'";



        //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT lok.`idLoket`,sp.`NO_MR`,sp.`noKartu`,sp.`NIK`,sp.`NAMA_LGKP`,lok.`umur`, kel.`NAMA_KEL`,sp.`NO_RT`,sp.`NO_RW`,kec.`NAMA_KEC`,sadar.`nmSadar`,IF(sp.`JENIS_KLMIN`='1','L','P') jnis_kel,sp.`ALAMAT`,sa.`terapi`,IF (sp.`noKartu`!='','BPJS','NON BPJS') kategori,
sa.`sistole`,sa.`diastole`,sa.`respRate`,sa.`heartRate`,sa.`catatan`,GROUP_CONCAT(CONCAT('(',sdd.`kdDiagnosa`,') ',sdd.`nmDiagnosa`) SEPARATOR ', ') diagnosa, GROUP_CONCAT(CONCAT('(',st.`kdTindakan`,') ',st.`nmTindakan`) SEPARATOR ', ') tindakan,IF (lok.`kunjBaru`='true','baru','lama') kasus
FROM simpus_loket lok
INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
INNER JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
LEFT JOIN simpus_anamnesa sa ON sa.`loketId`=lok.`idLoket`
LEFT JOIN simpus_kesadaran sadar ON sadar.`kdSadar`=sa.`kdSadar`
LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP` 
LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
left join simpus_tindakan st on st.`idPelayanan`=spn.`idpelayanan`

#code unit
INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

WHERE 
spn.`kdPoli`='001'
AND sdd.`kdDiagnosa` NOT LIKE 'K%'
AND sdd.`kdDiagnosa` NOT LIKE 'P%'
AND sdd.`kdDiagnosa` NOT LIKE 'O%'
AND sdd.`nmDiagnosa` NOT LIKE '%pregnan%'
AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
$unitx
$idpkm
$unit_details_x
$diagnosax
GROUP BY spn.`idpelayanan`
";
$query=$this->db->query($sql);
//echo $this->db->last_query();
return $query;
}

//11========================================LAPORAN KEGIATAN KESEHATAN USIA LANJUT========================================
function getDataLapUsiaLan($unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";

         //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT sdd.`kdDiagnosa`,sdd.`nmDiagnosa`,COUNT(sdd.`kdDiagnosa`) jml,
SUM(IF(sp.`JENIS_KLMIN`='1',1,0)) AS lansiaL,
SUM(IF(sp.`JENIS_KLMIN`='2',1,0)) AS lansiaP
FROM simpus_loket lok 
INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
INNER JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
WHERE lok.`kelUmur`>='11' AND sdd.`kdDiagnosa`!=''
AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
$unitx
$idpkm
$unit_details_x
GROUP BY sdd.`kdDiagnosa`
ORDER BY jml DESC LIMIT 10;";
$query=$this->db->query($sql);
       //echo $this->db->last_query();
return $query;
}

  //12=============================LAPORAN KEGIATAN PROGRAM KESEHATAN INDERA PENGLIHATAN (MATA)=============================
function getKatarak()
{

	$sql="SELECT mk.`id_katarak`as id , mk.`id_katarakPO` as idPO, mk.`nmKatarak` as kegiatan from master_katarak mk
	union select sd.`id` as id, sd.`kdDiag` as idPO, sd.`nmDiag` as kegiatan from simpus_diagnosa sd WHERE sd.`mata`='1'";
	$query=$this->db->query($sql);
	return $query;

}

function getDataLapKatarak($id_katarak,$id_katarakPO,$unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";
         //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND dmu.id_kategori='".$unit."'";

if(($id_katarak>=1)&&($id_katarakPO>=1))
  $katarakx = "AND (skk.`operasiKatarak`='".$id_katarak."' 
OR skk.`tindakLanjutPascaOperasi`='".$id_katarakPO."')";
else
  $katarakx = "AND sdd.`kdDiagnosa`='".$id_katarakPO."'";

$sql="SELECT 
	    #umur 0 - 7 hr
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 1 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru0_7L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 1 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru0_7P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 1 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama0_7L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 1 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama0_7P,
	    #umur 8 - 28 hr
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 2 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru8_28L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 2 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru8_28P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 2 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama8_28L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 2 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama8_28P,
	    #umur 1 - 12 bln
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 3 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru1_12L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 3 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru1_12P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 3 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama1_12L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 3 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama1_12P,
	    #umur 1 - 4 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 4 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru1_4L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 4 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru1_4P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 4 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama1_4L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 4 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama1_4P,
	     #umur 5 - 9 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 5 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru5_9L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 5 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru5_9P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 5 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama5_9L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 5 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama5_9P,
	    #umur 10_14 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 6 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru10_14L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 6 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru10_14P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 6 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama10_14L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 6 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama10_14P,
	    #umur 15_19 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 7 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru15_19L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 7 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru15_19P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 7 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama15_19L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 7 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama15_19P,
	    #umur 20_44 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 8 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru20_44L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 8 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru20_44P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 8 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama20_44L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 8 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama20_44P,
	     #umur 20_44 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND (lok.`kelUmur` BETWEEN 9 AND 10) AND sp.`JENIS_KLMIN`='1',1,0)) AS baru45_59L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND (lok.`kelUmur` BETWEEN 9 AND 10) AND sp.`JENIS_KLMIN`='2',1,0)) AS baru45_59P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND (lok.`kelUmur` BETWEEN 9 AND 10) AND sp.`JENIS_KLMIN`='1',1,0)) AS lama45_59L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND (lok.`kelUmur` BETWEEN 9 AND 10) AND sp.`JENIS_KLMIN`='2',1,0)) AS lama45_59P, 

	        #umur > 65 1TH
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` >= 11 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru59L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND  lok.`kelUmur` >= 11 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru59P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND  lok.`kelUmur` >= 11 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama59L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND  lok.`kelUmur` >= 11 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama59P,

SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND spn.`kdStatusPulang`=4 AND sp.`JENIS_KLMIN`='1',1,0)) AS jmlKasusBaruL,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND spn.`kdStatusPulang`=4 AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlKasusBaruP,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND spn.`kdStatusPulang`=4 AND sp.`JENIS_KLMIN`='1',1,0)) AS jmlKasusLamaL,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND spn.`kdStatusPulang`=4 AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlKasusLamaP,

SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND sp.`JENIS_KLMIN`='1',1,0)) AS jmlBaruL,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlBaruP,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND  sp.`JENIS_KLMIN`='1',1,0)) AS jmlLamaL,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlLamaP

FROM simpus_loket lok
INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
LEFT JOIN simpus_katarak skk ON skk.`idPelayanan`=spn.`idpelayanan`
        #code unit
INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId`
INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
WHERE 
tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
$unitx
$idpkm
$unit_details_x
$katarakx 


";
$query=$this->db->query($sql);
	// echo $this->db->last_query();
return $query;
}

    //13=============================LAPORAN KEGIATAN PROGRAM KESEHATAN INDERA PENDENGARAN (TELINGA)==========================

function getDataLapTelinga($unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";

         //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT sd.`kdDiag`,sd.`nmDiag`,
     #umur 0 - 7 hr
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 1 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru0_7L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 1 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru0_7P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 1 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama0_7L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 1 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama0_7P,
    #umur 8 - 28 hr
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 2 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru8_28L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 2 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru8_28P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 2 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama8_28L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 2 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama8_28P,
    #umur 1 - 12 bln
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 3 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru1_12L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 3 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru1_12P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 3 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama1_12L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 3 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama1_12P,
    #umur 1 - 4 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 4 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru1_4L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 4 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru1_4P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 4 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama1_4L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 4 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama1_4P,
     #umur 5 - 9 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 5 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru5_9L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 5 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru5_9P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 5 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama5_9L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 5 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama5_9P,
    #umur 10_14 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 6 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru10_14L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 6 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru10_14P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 6 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama10_14L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 6 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama10_14P,
    #umur 15_19 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 7 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru15_19L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 7 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru15_19P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 7 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama15_19L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 7 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama15_19P,
    #umur 20_44 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 8 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru20_44L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` = 8 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru20_44P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 8 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama20_44L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`kelUmur` = 8 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama20_44P,
     #umur 20_44 th
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND (lok.`kelUmur` BETWEEN 9 AND 10) AND sp.`JENIS_KLMIN`='1',1,0)) AS baru45_59L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND (lok.`kelUmur` BETWEEN 9 AND 10) AND sp.`JENIS_KLMIN`='2',1,0)) AS baru45_59P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND (lok.`kelUmur` BETWEEN 9 AND 10) AND sp.`JENIS_KLMIN`='1',1,0)) AS lama45_59L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND (lok.`kelUmur` BETWEEN 9 AND 10) AND sp.`JENIS_KLMIN`='2',1,0)) AS lama45_59P, 

        #umur > 65 1TH
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`kelUmur` >= 11 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru59L,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND  lok.`kelUmur` >= 11 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru59P,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND  lok.`kelUmur` >= 11 AND sp.`JENIS_KLMIN`='1',1,0)) AS lama59L,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND  lok.`kelUmur` >= 11 AND sp.`JENIS_KLMIN`='2',1,0)) AS lama59P,

SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND spn.`kdStatusPulang`=4 AND sp.`JENIS_KLMIN`='1',1,0)) AS jmlKasusBaruL,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND spn.`kdStatusPulang`=4 AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlKasusBaruP,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND spn.`kdStatusPulang`=4 AND sp.`JENIS_KLMIN`='1',1,0)) AS jmlKasusLamaL,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND spn.`kdStatusPulang`=4 AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlKasusLamaP,

SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND sp.`JENIS_KLMIN`='1',1,0)) AS jmlBaruL,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlBaruP,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND  sp.`JENIS_KLMIN`='1',1,0)) AS jmlLamaL,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlLamaP

FROM simpus_loket lok
INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
LEFT JOIN simpus_katarak skk ON skk.`idPelayanan`=spn.`idpelayanan`
LEFT JOIN simpus_diagnosa sd ON sd.`kdDiag`=sdd.`kdDiagnosa`
        #code unit
INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId`
INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP` 
WHERE 
sd.`telinga`='1'
AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'

$idpkm
$unit_details_x
$unitx
GROUP BY sd.`kdDiag`  ";
$query=$this->db->query($sql);
       //echo $this->db->last_query();
return $query;
}

     //14=========================JUMLAH KASUS DAN KEMATIAN TIDAK MENULAR MENURUT JENIS KELAMIN==================================
function getDiagnosaPTM()
{

	$sql="SELECT sd.`kdDiag`,sd.`nmDiag` FROM simpus_diagnosa sd WHERE sd.`ptm` ='1'";
	$query=$this->db->query($sql);
	return $query;

}
function getDataLapJmlKasusPTM($kdDiagnosa,$unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";


        //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT 
        #umur < 5TH
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` < 5 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lbaru5,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` < 5 AND sp.`JENIS_KLMIN`='1',1,0)) AS Llama5,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` < 5 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lmeninggal5,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` < 5 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pbaru5,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` < 5 AND sp.`JENIS_KLMIN`='2',1,0)) AS Plama5,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` < 5 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pmeninggal5,
        #umur 5-9
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=5 AND lok.`umur` <= 9 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lbaru59,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=5 AND lok.`umur` <= 9 AND sp.`JENIS_KLMIN`='1',1,0)) AS Llama59,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=5 AND lok.`umur` <= 9 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lmeninggal59,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=5 AND lok.`umur` <= 9 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pbaru59,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=5 AND lok.`umur` <= 9 AND sp.`JENIS_KLMIN`='2',1,0)) AS Plama59,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=5 AND lok.`umur` <= 9 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pmeninggal59,
        #umur 10-14
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=10 AND lok.`umur` <= 14 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lbaru1014,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=10 AND lok.`umur` <= 14 AND sp.`JENIS_KLMIN`='1',1,0)) AS Llama1014,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=10 AND lok.`umur` <= 14 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lmeninggal1014,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=10 AND lok.`umur` <= 14 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pbaru1014,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=10 AND lok.`umur` <= 14 AND sp.`JENIS_KLMIN`='2',1,0)) AS Plama1014,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=10 AND lok.`umur` <= 14 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pmeninggal1014,
        #umur 15-19
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=15 AND lok.`umur` <= 19 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lbaru1519,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=15 AND lok.`umur` <= 19 AND sp.`JENIS_KLMIN`='1',1,0)) AS Llama1519,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=15 AND lok.`umur` <= 19 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lmeninggal1519,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=15 AND lok.`umur` <= 19 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pbaru1519,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=15 AND lok.`umur` <= 19 AND sp.`JENIS_KLMIN`='2',1,0)) AS Plama1519,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=15 AND lok.`umur` <= 19 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pmeninggal1519,
        #umur 20-44
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=20 AND lok.`umur` <= 44 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lbaru2044,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=20 AND lok.`umur` <= 44 AND sp.`JENIS_KLMIN`='1',1,0)) AS Llama2044,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=20 AND lok.`umur` <= 44 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lmeninggal2044,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=20 AND lok.`umur` <= 44 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pbaru2044,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=20 AND lok.`umur` <= 44 AND sp.`JENIS_KLMIN`='2',1,0)) AS Plama2044,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=20 AND lok.`umur` <= 44 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pmeninggal2044,
        #umur 44-54
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=44 AND lok.`umur` <= 54 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lbaru4454,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=44 AND lok.`umur` <= 54 AND sp.`JENIS_KLMIN`='1',1,0)) AS Llama4454,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=44 AND lok.`umur` <= 54 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lmeninggal4454,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=44 AND lok.`umur` <= 54 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pbaru4454,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=44 AND lok.`umur` <= 54 AND sp.`JENIS_KLMIN`='2',1,0)) AS Plama4454,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=44 AND lok.`umur` <= 54 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pmeninggal4454,
        #umur 55-59
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=55 AND lok.`umur` <= 59 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lbaru5559,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=55 AND lok.`umur` <= 59 AND sp.`JENIS_KLMIN`='1',1,0)) AS Llama5559,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=55 AND lok.`umur` <= 59 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lmeninggal5559,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=55 AND lok.`umur` <= 59 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pbaru5559,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=55 AND lok.`umur` <= 59 AND sp.`JENIS_KLMIN`='2',1,0)) AS Plama5559,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=55 AND lok.`umur` <= 59 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pmeninggal5559,
        #umur 60-69
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=60 AND lok.`umur` <= 69 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lbaru6069,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=60 AND lok.`umur` <= 69 AND sp.`JENIS_KLMIN`='1',1,0)) AS Llama6069,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=60 AND lok.`umur` <= 69 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lmeningga6069,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=60 AND lok.`umur` <= 69 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pbaru6069,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=60 AND lok.`umur` <= 69 AND sp.`JENIS_KLMIN`='2',1,0)) AS Plama6069,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=60 AND lok.`umur` <= 69 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pmeninggal6069,
        #umur 70+
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=70 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lbaru70,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=70 AND sp.`JENIS_KLMIN`='1',1,0)) AS Llama70,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=70 AND sp.`JENIS_KLMIN`='1',1,0)) AS Lmeningga70,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3') AND lok.`umur` >=70 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pbaru70,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4') AND lok.`umur` >=70 AND sp.`JENIS_KLMIN`='2',1,0)) AS Plama70,
SUM(IF(spn.`kdStatusPulang`='1' AND lok.`umur` >=70 AND sp.`JENIS_KLMIN`='2',1,0)) AS Pmeninggal70,

SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3')  AND sp.`JENIS_KLMIN`='1',1,0)) AS Lbaru,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4')  AND sp.`JENIS_KLMIN`='1',1,0)) AS Llama,
SUM(IF(spn.`kdStatusPulang`='1'  AND sp.`JENIS_KLMIN`='1',1,0)) AS Lmeninggal,
SUM(IF((sdd.`diagnosaKasus`='1' OR sdd.`diagnosaKasus`='3')  AND sp.`JENIS_KLMIN`='2',1,0)) AS Pbaru,
SUM(IF((sdd.`diagnosaKasus`='2' OR sdd.`diagnosaKasus`='4')  AND sp.`JENIS_KLMIN`='2',1,0)) AS Plama,
SUM(IF(spn.`kdStatusPulang`='1'  AND sp.`JENIS_KLMIN`='2',1,0)) AS Pmeninggal

FROM simpus_loket lok
INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
LEFT JOIN simpus_katarak skk ON skk.`idPelayanan`=spn.`idpelayanan`
LEFT JOIN simpus_diagnosa sd ON sd.`kdDiag`=sdd.`kdDiagnosa`
        #code unit
INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId`
INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
WHERE 
tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
$unitx
$idpkm
$unit_details_x
AND sdd.`kdDiagnosa`='".$kdDiagnosa."' ";
$query=$this->db->query($sql);
       //echo $this->db->last_query();
return $query;
}

         //15=========================LAPORAN KESEHATAN PEKERJA (UKK)=================================
public function get_lap_ukk_pekerja($unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";

        //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT 
SUM(IF(ukk.`JENIS_KLMIN`='1',1,0)) AS jmlL,
SUM(IF(ukk.`JENIS_KLMIN`='2',1,0)) AS jmlP
FROM
(SELECT sp.`JENIS_KLMIN` FROM simpus_loket lok
    INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
    inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
    LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
    LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
    INNER JOIN pkrjn_master pm ON pm.`NO`=sp.`JENIS_PKRJN`
        #code unit
    INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId`
    INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
    WHERE 
    pm.`UKK`='1'
    AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    $unitx
    $idpkm
    $unit_details_x
    GROUP BY spn.`idpelayanan`) ukk
    ";
    $query=$this->db->query($sql);
    // echo $this->db->last_query();
    return $query;
}

public function get_lap_ukk_diag($unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";

        //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT 
SUM(IF((ukk.`kdDiagnosa`!='') AND ukk.`JENIS_KLMIN`='1',1,0)) AS jmlL,
SUM(IF((ukk.`kdDiagnosa`!='') AND ukk.`JENIS_KLMIN`='2',1,0)) AS jmlP
FROM
(SELECT sp.`JENIS_KLMIN`,sdd.`kdDiagnosa` FROM simpus_loket lok
    INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
    inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
    LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
    LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
    INNER JOIN pkrjn_master pm ON pm.`NO`=sp.`JENIS_PKRJN`
        #code unit
    INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId`
    INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
    WHERE 
    pm.`UKK`='1'
    AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    $unitx
    $idpkm
    $unit_details_x
    GROUP BY spn.`idpelayanan`) ukk
    ";
    $query=$this->db->query($sql);
       // echo $this->db->last_query();
    return $query;
}

function get_master_jenis_ukk()
{   
    $sql="SELECT id_jenis,jenis_ukk FROM `master_jenis_ukk` ORDER BY id_jenis";
    $query=$this->db->query($sql);
       // echo $this->db->last_query();
    return $query;
}
public function get_lap_ukk_kasus($jns_ukk,$unit,$unit_details,$tgl_awal,$tgl_akhir,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";

        //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT 
SUM(IF(ukk.`JENIS_KLMIN`='1',1,0)) AS jmlL,
SUM(IF(ukk.`JENIS_KLMIN`='2',1,0)) AS jmlP
FROM
(SELECT sp.`JENIS_KLMIN`,sdd.`kdDiagnosa`
    FROM simpus_ukk su
INNER JOIN simpus_loket lok ON lok.`idLoket`=su.`loketId`
INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
INNER JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
LEFT JOIN simpus_poli_fktp fktp ON fktp.`kdPoli`=lok.`kdPoli`
LEFT JOIN pkrjn_master pm ON pm.`NO`=sp.`JENIS_PKRJN`
LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
LEFT JOIN setup_kec_bwi_new kec ON kec.`NO_KEC`=sp.`NO_KEC`
LEFT JOIN setup_kel_bwi_new kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL`
INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId`
INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
    WHERE 
    su.`jenisUKK`='".$jns_ukk."' AND sdd.`kdDiagnosa`!=''
    AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    $unitx
    $idpkm
    $unit_details_x
    GROUP BY spn.`idpelayanan`) ukk
    ";
    $query=$this->db->query($sql);
    // echo $this->db->last_query();
    return $query;
}

 //16=========================REGISTRASI RAWAT JALAN KESEHATAN PEKERJA (UKK)=================================
public function get_lap_register_ukk($unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$poli,$pusk)
{
   if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
    $unit_details_x = "";
else
    $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";

        //code unit
if($unit =='0')
    $unitx = '';
else
    $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT lok.`puskId`,lok.`unitId`,lok.`idLoket`,spn.`idpelayanan`, DATE_FORMAT(lok.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,
sp.`NO_MR`,sp.`NAMA_LGKP`,lok.`umur`,sp.`JENIS_KLMIN`,sp.`ALAMAT`,kel.`NAMA_KEL`,kec.`NAMA_KEC`,pm.`DESCRIP`,
su.`tipeKerja`,su.`lamaKerja`,lok.`kdPoli`,fktp.`nmPoli`,
GROUP_CONCAT(CONCAT('(',sdd.kdDiagnosa,') ',sdd.`nmDiagnosa`) SEPARATOR ', ') diagnosa,sdd.`kdDiagnosa`,su.`jenisUKK`
from simpus_loket lok
  INNER JOIN simpus_pasien sp ON sp.`ID` = lok.`pasienId` 
  INNER JOIN simpus_pelayanan spn  ON spn.`loketId` = lok.`idLoket` 
  LEFT JOIN simpus_ukk su ON su.`loketId`=lok.`idLoket`
LEFT JOIN simpus_poli_fktp fktp ON fktp.`kdPoli`=lok.`kdPoli`
LEFT JOIN pkrjn_master pm ON pm.`NO`=sp.`JENIS_PKRJN`
LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
LEFT JOIN setup_kec_bwi_new kec ON kec.`NO_KEC`=sp.`NO_KEC`
LEFT JOIN setup_kel_bwi_new kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL`
INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId`
INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
WHERE pm.`UKK`='1' AND sdd.`kdDiagnosa`!='' AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
$unitx
$idpkm
$unit_details_x
GROUP BY spn.`idpelayanan`
";
$query=$this->db->query($sql);
return $query;
}

//17=========================REGISTRASI TEKANAN DARAH IMT=================================
public function get_lap_reg_tek_darah_imt($unit,$unit_details,$tgl_awal,$tgl_akhir,$diag,$pusk)
{
   if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
    $unit_details_x = "";
else
    $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";

        //code unit
if($unit =='0')
    $unitx = '';
else
    $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT lok.`puskId`,sp.`NO_MR`,lok.`tglKunjungan`,sp.NIK,sp.`NAMA_LGKP`,DATE_FORMAT(sp.`TGL_LHR`,'%d %M %Y') AS TGL_LHR,sp.`ALAMAT`,sp.`NO_RT`,sp.`NO_RW`,kel.`NAMA_KEL`,kec.`NAMA_KEC`,sa.`sistole`,
sa.`diastole`,sa.`beratBadan`,sa.`tinggiBadan`,sa.`lingkarPerut`,
GROUP_CONCAT(CONCAT('(',sdd.kdDiagnosa,') ',sdd.`nmDiagnosa`) SEPARATOR ', ') diagnosa,
#GROUP_CONCAT(DISTINCT CONCAT(po.`nama_obat`,' ',po.`dosis_pakai`) SEPARATOR ', ') nmObat,
GROUP_CONCAT(DISTINCT st.`nmTindakan` SEPARATOR ', ') tindakan,nilaiLab
FROM simpus_loket lok
INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
LEFT JOIN simpus_anamnesa sa ON sa.`loketId`=lok.`idLoket`
 left join simpus_tindakan st on st.`loketId`=lok.`idLoket`
 #SLEFT JOIN simpus_pakai_obat po ON po.`loketId`=spn.`loketId`
LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`

LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId`
INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
WHERE 
sa.`tinggiBadan` > 0 
AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
$unitx
$idpkm
$unit_details_x
GROUP BY spn.`idpelayanan`
";
$query=$this->db->query($sql);
     // echo $this->db->last_query();
return $query;
}

// function getDataJenisDiare()
// {
//     if($this->getId() != '46')
//         $idpkm =" AND sk.PUSK_ID='".$this->getId()."' ";
//     else
//         $idpkm = '';

//     $sql="SELECT sk.`NO_MR`,sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NAMA_LGKP`,sp.`NO_RT`,sp.`NO_RW`,sk.`UMUR`,IF(sp.`JENIS_KLMIN`='1','L','P') AS jnis_kel,
//     sp.`NO_KK`,kel.`NAMA_KEL`,IF(sk.`noKartu`!='','bpjs','non_bpjs') AS kategori
//     FROM simpus_kunjungan sk
//     INNER JOIN simpus_pasien sp ON sp.`ID`=sk.`pasien_id`
//          #code unit
//     INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId`
//     INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori

//     LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC`
//     LEFT JOIN setup_kel kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL`
//     WHERE 
//     sp.`NO_KAB`='10' AND sp.`NO_PROP`='35'
//     AND kel.`NO_KAB`='10' AND kel.`NO_PROP`='35'
//     AND kec.`NO_KAB`='10' AND kec.`NO_PROP`='35'
//     $idpkm";
//     $query=$this->db->query($sql);
//        //echo $this->db->last_query();
//     return $query;
// }





}
