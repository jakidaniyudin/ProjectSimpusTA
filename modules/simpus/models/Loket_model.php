<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loket_model extends CI_Model {

	var $table = 'simpus_loket as a';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('b.NAMA_LGKP','b.ALAMAT','d.nama_unit','b.NIK','b.noKartu','b.NO_MR','b.NO_KK','a.noUrut'); //set column field database for datatable searchable 
    var $order = array('createdDate'=>'desc'); // default order 



    public function getId()
    {
    	$user_id = $this->session->userdata('user_id');
    	$this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
    	return $this->id;

    }
    public function get_kategori_unit($unit)
    {
    	$sql = "SELECT kategori FROM `data_master_unit` WHERE id_kategori = '".$unit."'";
    	$query=$this->db->query($sql);
    	return $query;
    }
    public function get_unit_details($unit_details)
    {
    	$sql = "SELECT nama_unit FROM `data_master_unit_detail`WHERE id_detail= '".$unit_details."'";
    	$query=$this->db->query($sql);
    	return $query;
    }

    //========== LOKET =============//
    private function _get_datatables_query()
    {

    	$this->db->select('b.ID,c.idpelayanan,c.sudahDilayani,a.*,d.*,b.NO_MR,b.NO_MR_LAMA,b.NAMA_LGKP,b.NIK,b.NO_PROP,b.NO_KAB,b.NO_KEC,b.NO_KEL,b.ALAMAT,b.NO_RT,b.NO_RW,b.noKartu,b.kdProvider as kdProvider_pas,mal.nmMal,id_encounter,b.PHONE');


    	if($this->input->post('tglKunjungan'))
    	{
    		$tglKunjungan=date("Y-m-d",strtotime($this->input->post('tglKunjungan')));
    		$this->db->where('a.tglKunjungan', $tglKunjungan);
    	}
    	if($this->input->post('unitId'))
    	{

    		$this->db->where('a.unitId', $this->input->post('unitId'));
    	}

    	$this->db->join('simpus_pasien as b','a.pasienId = b.ID','left');
    	$this->db->join('simpus_pelayanan as c','a.idLoket = c.loketId','inner');
        $this->db->join('simpus_master_mal as mal','mal.idMal = c.kdKegiatanPel','left');
        $this->db->join('data_master_unit_detail as d','a.unitId = d.id_detail');
        if($this->getId().$this->id!=46){
          $this->db->where('a.puskId', $this->getId());
      }
      $this->db->group_by("idLoket");
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
        //echo $this->db->last_query();
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

    public function getCekKunjungan($no_mr,$id_unit,$year)
    {
    	$this->db->select('count(*) as jmlKunj');
    	$this->db->from('simpus_kunjungan as sk');
    	$this->db->join('simpus_pasien as  sp','sk.pasien_id = sp.ID','inner');
    	$this->db->where('sk.id_unit', $id_unit);
    	$this->db->where('sp.NO_MR', $no_mr);
    	$this->db->where('year(sk.tglKunjungan)', $year);

    	$query = $this->db->get();
       //echo $this->db->last_query();
    	return $query;
    }
    

    //===================================== LAPORAN ================================ //
    //1======================== LAPORAN REGISTER KUNJUNGAN PASIEN =================== //   
    public function get_lap_reg_kunj_pas($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
    {
    	if($pusk=='0')
            $idpkm ='';
        else
            $idpkm = " AND sk.`puskId`='".$pusk."' ";

        $tglAwal=date("Y-m-d",strtotime($tgl_awal));
        $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

        if($unit_details == '0')
          $unit_details_x = "";
      else
          $unit_details_x = "AND sk.`unitId`= '".$unit_details."'";

      if($kel == '0')
          $desa = "";
      else
          $desa = "AND sp.no_kel = '".$kel."'";

        //code unit
      if($unit =='0')
          $unitx = '';
      else
          $unitx = "AND dmu.id_kategori='".$unit."'";

      $sql="SELECT sk.`idLoket`,DATE_FORMAT(sk.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,
      sp.`NAMA_LGKP`,sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,sk.`kelUmur`,
      sk.`UMUR`,sp.`JENIS_KLMIN`, sk.`kdPoli`,sk.kunjBaru,wilayah,kunjSakit,s.`tujuanPoli`
      FROM simpus_loket sk
      INNER JOIN simpus_pasien sp ON sp.`ID`=sk.`pasienId`
      inner JOIN simpus_pelayanan s ON s.`loketId`=sk.`idLoket`
      INNER JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP`
      INNER JOIN setup_kel kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` 
      AND kel.`NO_KAB` = sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        #code unit
      INNER JOIN data_master_unit_detail dmud on dmud.id_detail=sk.`unitId`
      inner join data_master_unit dmu on dmu.id_kategori=dmud.id_kategori

      WHERE tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
      AND (sk.kunjSakit != '' OR sp.JENIS_KLMIN != '')
      $unitx
      $idpkm
      $unit_details_x
      $desa 
      group by sk.`idLoket`
      ";
      $query=$this->db->query($sql);
        //echo $this->db->last_query();
      return $query;
  }
    //======================================= END ================================= //

    //2======================== LAPORAN REGISTER KUNJUNGAN PASIEN SEHAT =================== //

  public function get_lap_reg_kunj_pas_sehat($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
  {
     if($pusk=='0')
        $idpkm ='';
    else
        $idpkm = " AND sk.`puskId`='".$pusk."' ";

    $tglAwal=date("Y-m-d",strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

    if($unit_details == '0')
      $unit_details_x = "";
  else
      $unit_details_x = "AND sk.`unitId`= '".$unit_details."'";

  if($kel == '0')
      $desa = "";
  else
      $desa = "AND sp.no_kel = '".$kel."'";

        //code unit
  if($unit =='0')
      $unitx = '';
  else
      $unitx = "AND dmu.id_kategori='".$unit."'";

  $sql="SELECT sk.`idLoket`,DATE_FORMAT(sk.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,
  sp.`noKartu`,sk.`kelUmur`,sk.`UMUR`,sp.`JENIS_KLMIN`, sk.`kdPoli`,sk.kunjBaru,wilayah,kunjSakit,s.`tujuanPoli`
  FROM simpus_loket sk
  INNER JOIN simpus_pasien sp ON sp.`ID`=sk.`pasienId`
  inner JOIN simpus_pelayanan s ON s.`loketId`=sk.`idLoket`
  INNER JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP`
  INNER JOIN setup_kel kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` 
  AND kel.`NO_KAB` = sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        #code unit
  INNER JOIN data_master_unit_detail dmud on dmud.id_detail=sk.`unitId`
  inner join data_master_unit dmu on dmu.id_kategori=dmud.id_kategori

  WHERE  sk.`kunjSakit`='false'
  AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
  $unitx
  $idpkm
  $unit_details_x
  $desa 
  ";
  $query=$this->db->query($sql);
       // echo $this->db->last_query();
  return $query;
}

    //======================== end =================== //

    //3======================== LAPORAN BULANAN DATA KUNJUNGAN =================== //

public function get_lap_bulanan_data_kunj($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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

if($kel == '0')
    $desa = "";
else
    $desa = "AND sp.no_kel = '".$kel."'";
            //code unit
if($unit =='0')
    $unitx = '';
else
    $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT reg.KATEGORI,

SUM(KasusBaruL) AS KasusBaruL,SUM(KasusBaruP) AS KasusBaruP,
SUM(kunKasusBaruL) AS kunKasusBaruL,SUM(kunKasusBaruP) AS kunKasusBaruP,
SUM(KasusLamaL) AS KasusLamaL,SUM(KasusLamaP) AS KasusLamaP,
SUM(kunKasusLamaL) AS kunKasusLamaL,SUM(kunKasusLamaP) AS kunKasusLamaP,

SUM(Kasusbaru55L) AS Kasusbaru55L,SUM(Kasusbaru55P) AS Kasusbaru55P,
SUM(kunKasusbaru55L) AS kunKasusbaru55L,SUM(kunKasusbaru55P) AS kunKasusbaru55P,
SUM(Kasuslama55L) AS Kasuslama55L,SUM(Kasuslama55P) AS Kasuslama55P,
SUM(kunKasuslama55L) AS kunKasuslama55L,SUM(kunKasuslama55P) AS kunKasuslama55P,


SUM(IF(reg.`kunjBaru`='true' AND  reg.`JENIS_KLMIN`='1',1,0)) AS baruL,
SUM(IF(reg.`kunjBaru`='true' AND reg.`JENIS_KLMIN`='2',1,0)) AS baruP,
SUM(IF(reg.`kunjBaru`='true' ,1,0)) AS baruLP,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`JENIS_KLMIN`='1',1,0)) AS lamaL,
SUM(IF(reg.`kunjBaru`='false' AND reg.`JENIS_KLMIN`='2',1,0)) AS lamaP,
SUM(IF(reg.`kunjBaru`='false' ,1,0)) AS lamaLP,
SUM(IF(reg.`kdStatusPulang` = '4' OR reg.`kdStatusPulang` = '6' ,1,0)) AS rujuk,

        #baru lama > 55 th
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` >=10 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru55L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` >=10 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru55P,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` >=10,1,0)) AS baru55LP,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` >=10 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama55L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` >=10 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama55P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` >=10,1,0)) AS lama55LP,
SUM(IF((reg.`kdStatusPulang` = '4' OR reg.`kdStatusPulang` = '6') AND reg.`kelUmur` >=10,1,0)) AS rujuk55,

        #sakit
SUM(IF(reg.`kunjSakit`='true'  AND reg.`JENIS_KLMIN`='1',1,0)) AS sakitL,
SUM(IF(reg.`kunjSakit`='true'  AND reg.`JENIS_KLMIN`='2',1,0)) AS sakitP,
SUM(IF(reg.`kunjSakit`='true' ,1,0)) AS sakitLP,
SUM(IF(reg.`kunjSakit`='false'  AND reg.`JENIS_KLMIN`='1',1,0)) AS sehatL,
SUM(IF(reg.`kunjSakit`='false'  AND reg.`JENIS_KLMIN`='2',1,0)) AS sehatP,
SUM(IF(reg.`kunjSakit`='false' ,1,0)) AS sehatLP
FROM
(SELECT lok.wilayah,pel.kdStatusPulang,lok.kunjBaru,lok.idLoket,lok.kunjSakit,
    diag.`kdDiagnosa`,diag.`nmDiagnosa`,diag.`diagnosaKasus`,lok.`pasienId`,lok.`kelUmur`,
    lok.`puskId`,lok.`unitId`,lok.`tglKunjungan`,lok.`kategoriUnitId`,JENIS_KLMIN,
            #kunjungan kasus rawat jalan <  55 th
    SUM(IF(diag.`diagnosaKasus` ='3' AND sp.`JENIS_KLMIN`='1',1,0)) AS KasusBaruL,
    SUM(IF(diag.`diagnosaKasus` ='3' AND sp.`JENIS_KLMIN`='2',1,0)) AS KasusBaruP,

    SUM(IF(diag.`diagnosaKasus` ='1' AND sp.`JENIS_KLMIN`='1',1,0)) AS kunKasusBaruL,
    SUM(IF(diag.`diagnosaKasus` ='1' AND sp.`JENIS_KLMIN`='2',1,0)) AS kunKasusBaruP,

    SUM(IF(diag.`diagnosaKasus` ='4' AND sp.`JENIS_KLMIN`='1',1,0)) AS KasusLamaL,
    SUM(IF(diag.`diagnosaKasus` ='4' AND sp.`JENIS_KLMIN`='2',1,0)) AS KasusLamaP,

    SUM(IF(diag.`diagnosaKasus` ='2' AND sp.`JENIS_KLMIN`='1',1,0)) AS kunKasusLamaL,
    SUM(IF(diag.`diagnosaKasus` ='2' AND sp.`JENIS_KLMIN`='2',1,0)) AS kunKasusLamaP,            

        #kunjungan kasus rawat jalan >  55 th
    SUM(IF(lok.`kelUmur` >=10 AND diag.`diagnosaKasus` ='3' AND sp.`JENIS_KLMIN`='1',1,0)) AS Kasusbaru55L,
    SUM(IF(lok.`kelUmur` >=10 AND diag.`diagnosaKasus` ='3' AND sp.`JENIS_KLMIN`='2',1,0)) AS Kasusbaru55P,

    SUM(IF(lok.`kelUmur` >=10 AND diag.`diagnosaKasus` ='1' AND sp.`JENIS_KLMIN`='1',1,0)) AS kunKasusbaru55L,
    SUM(IF(lok.`kelUmur` >=10 AND diag.`diagnosaKasus` ='1' AND sp.`JENIS_KLMIN`='2',1,0)) AS kunKasusbaru55P,

    SUM(IF(lok.`kelUmur` >=10 AND diag.`diagnosaKasus` ='4' AND sp.`JENIS_KLMIN`='1',1,0)) AS Kasuslama55L,
    SUM(IF(lok.`kelUmur` >=10 AND diag.`diagnosaKasus` ='4' AND sp.`JENIS_KLMIN`='2',1,0)) AS Kasuslama55P,

    SUM(IF(lok.`kelUmur` >=10 AND diag.`diagnosaKasus` ='2' AND sp.`JENIS_KLMIN`='1',1,0)) AS kunKasuslama55L,
    SUM(IF(lok.`kelUmur` >=10 AND diag.`diagnosaKasus` ='2' AND sp.`JENIS_KLMIN`='2',1,0)) AS kunKasuslama55P,

    CASE 
    WHEN(sp.`noKartu` > 1 AND lok.`wilayah`!=3  AND sp.`NO_KAB`='10' AND sp.`NO_PROP`='35') THEN '1. BPJS'
    WHEN(sp.`noKartu` = '' AND lok.`wilayah`!=3 AND sp.`NO_KAB`='10' AND sp.`NO_PROP`='35') THEN '2. NON BPJS'
    ELSE '3. BAYAR'
    END AS KATEGORI

    FROM
    simpus_loket lok
    INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
    INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId` 
    INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori 
    INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
    WHERE lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    $unitx
    $idpkm
    $unit_details_x
    $desa
    GROUP BY pel.`idpelayanan` ) AS reg
    GROUP BY KATEGORI
    ORDER BY KATEGORI";
    $query=$this->db->query($sql);
    //echo $this->db->last_query();
    return $query;
}


     //4======================== LAPORAN PBI =============//
public function get_lap_bulanan_data_kunj_pbi($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
{
 if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND sk.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
    $unit_details_x = "";
else
    $unit_details_x = "AND sk.`unitId`= '".$unit_details."'";

if($kel == '0')
    $desa = "";
else
    $desa = "AND sp.no_kel = '".$kel."'";

       //code unit
if($unit =='0')
    $unitx = '';
else
    $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT

SUM(IF(sk.`kunjBaru`='true' AND  sp.`JENIS_KLMIN`='1',1,0)) AS baruL,
SUM(IF(sk.`kunjBaru`='true' AND sp.`JENIS_KLMIN`='2',1,0)) AS baruP,
SUM(IF(sk.`kunjBaru`='true' ,1,0)) AS baruLP,
SUM(IF(sk.`kunjBaru`='false' AND  sp.`JENIS_KLMIN`='1',1,0)) AS lamaL,
SUM(IF(sk.`kunjBaru`='false' AND sp.`JENIS_KLMIN`='2',1,0)) AS lamaP,
SUM(IF(sk.`kunjBaru`='false' ,1,0)) AS lamaLP


FROM simpus_pasien sp 
INNER JOIN simpus_loket sk ON sp.`ID`=sk.`pasienId`
inner JOIN simpus_pelayanan spn ON spn.`loketId`=sk.`idLoket`

INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=sk.`unitId`
INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
WHERE tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
AND sk.`jknpbi`='JKN_PBI' AND (sk.kunjSakit != '' OR sp.JENIS_KLMIN != '')
$unitx
$idpkm
$unit_details_x
$desa";
$query=$this->db->query($sql);
        //echo $this->db->last_query();
return $query;
}

public function get_lap_reg_kunj_pas_nonPbi($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
{
 if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND sk.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
    $unit_details_x = "";
else
    $unit_details_x = "AND sk.`unitId`= '".$unit_details."'";

if($kel == '0')
    $desa = "";
else
    $desa = "AND sp.no_kel = '".$kel."'";


if($unit =='0')
    $unitx = '';
else
    $unitx = "AND dmu.id_kategori='".$unit."'";
$sql="
SELECT

SUM(IF(sk.`kunjBaru`='true' AND  sp.`JENIS_KLMIN`='1',1,0)) AS baruL,
SUM(IF(sk.`kunjBaru`='true' AND sp.`JENIS_KLMIN`='2',1,0)) AS baruP,
SUM(IF(sk.`kunjBaru`='true' ,1,0)) AS baruLP,
SUM(IF(sk.`kunjBaru`='false' AND  sp.`JENIS_KLMIN`='1',1,0)) AS lamaL,
SUM(IF(sk.`kunjBaru`='false' AND sp.`JENIS_KLMIN`='2',1,0)) AS lamaP,
SUM(IF(sk.`kunjBaru`='false' ,1,0)) AS lamaLP


FROM simpus_pasien sp 
INNER JOIN simpus_loket sk ON sp.`ID`=sk.`pasienId`
inner JOIN simpus_pelayanan spn ON spn.`loketId`=sk.`idLoket`

INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=sk.`unitId`
INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
WHERE tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
AND sk.`jknpbi`='JKN_NON_PBI' AND (sk.kunjSakit != '' OR sp.JENIS_KLMIN != '')
$unitx
$idpkm
$unit_details_x
$desa
";
$query=$this->db->query($sql);
return $query;
}

public function lap_rekapitulasi_jkn($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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

if($kel == '0')
    $desa = "";
else
    $desa = "AND sp.no_kel = '".$kel."'";

       //code unit
if($unit =='0')
    $unitx = '';
else
    $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT jknPbi,
#DATEDIFF('2020-07-31','2020-07-01')+1 AS jumlahHari,
SUM(IF(kunjBaru='true' AND  JENIS_KLMIN='1',1,0)) AS baruL,
SUM(IF(kunjBaru='true' AND JENIS_KLMIN='2',1,0)) AS baruP,
SUM(IF(kunjBaru='false' AND  JENIS_KLMIN='1',1,0)) AS lamaL,
SUM(IF(kunjBaru='false' AND JENIS_KLMIN='2',1,0)) AS lamaP,
SUM(IF(JENIS_KLMIN='1' AND kdPoli='098' ,1,0)) AS rnpL,
SUM(IF(JENIS_KLMIN='2' AND kdPoli='098' ,1,0)) AS rnpP,
SUM(IF(JENIS_KLMIN='1' AND tglKeluar<='".$tglAkhir."' AND lamaRnp <> '',lamaRnp,0)) AS lamaRawatL,
SUM(IF(JENIS_KLMIN='2' AND tglKeluar<='".$tglAkhir."' AND lamaRnp <> '',lamaRnp,0)) AS lamaRawatP,
SUM(IF(JENIS_KLMIN='1' AND tglKeluar<='".$tglAkhir."' AND pulangStatus <> '',1,0)) AS ranapPasienL,
SUM(IF(JENIS_KLMIN='2' AND tglKeluar<='".$tglAkhir."' AND pulangStatus <> '',1,0)) AS ranapPasienP,
SUM(IF((kdStatusPulang='4' OR kdStatusPulang='6') AND JENIS_KLMIN='1',1,0))+SUM(IF(pulangStatus=5 AND JENIS_KLMIN='1',1,0)) AS rujukL,
SUM(IF((kdStatusPulang='4' OR kdStatusPulang='6') AND JENIS_KLMIN='2',1,0))+SUM(IF(pulangStatus=5 AND JENIS_KLMIN='2',1,0)) AS rujukP
FROM (SELECT lok.`jknPbi`,lok.wilayah,pel.kdStatusPulang,lok.kunjBaru,lok.idLoket,lok.kunjSakit,lok.`pasienId`,
lok.`puskId`,lok.`unitId`,lok.`tglKunjungan`,lok.`kategoriUnitId`,JENIS_KLMIN,rnp.`pulangStatus`,diag.diagnosaKasus,pel.kdPoli,rnp.tglKeluar,
DATEDIFF(rnp.`tglKeluar`,rnp.`tglMasuk`)+1 AS lamaRnp
FROM
simpus_loket lok
INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
LEFT JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId` 
INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori 
INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
LEFT JOIN simpus_ranap rnp ON rnp.`pelayananId`=pel.`idpelayanan`
WHERE tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
AND (lok.kunjSakit != '' OR sp.JENIS_KLMIN != '')
$unitx
$idpkm
$unit_details_x
$desa
GROUP BY pel.`idpelayanan`) AS reg GROUP BY jknPbi";
$query=$this->db->query($sql);
     //   echo $this->db->last_query();
return $query;
}

public function lap_rekapitulasi_jkn_prov($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$PPK,$pusk)
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

if($kel == '0')
    $desa = "";
else
    $desa = "AND sp.no_kel = '".$kel."'";

       //code unit
if($unit =='0')
    $unitx = '';
else
    $unitx = "AND dmu.id_kategori='".$unit."'";

$sql="SELECT
#DATEDIFF('2020-07-31','2020-07-01')+1 AS jumlahHari,
SUM(IF(kunjBaru='true' AND  JENIS_KLMIN='1',1,0)) AS baruL,
SUM(IF(kunjBaru='true' AND JENIS_KLMIN='2',1,0)) AS baruP,
SUM(IF(kunjBaru='false' AND  JENIS_KLMIN='1',1,0)) AS lamaL,
SUM(IF(kunjBaru='false' AND JENIS_KLMIN='2',1,0)) AS lamaP,
SUM(IF(JENIS_KLMIN='1' AND kdPoli='098' ,1,0)) AS rnpL,
SUM(IF(JENIS_KLMIN='2' AND kdPoli='098' ,1,0)) AS rnpP,
SUM(IF(JENIS_KLMIN='1' AND tglKeluar<='".$tglAkhir."' AND lamaRnp <> '',lamaRnp,0)) AS lamaRawatL,
SUM(IF(JENIS_KLMIN='2' AND tglKeluar<='".$tglAkhir."' AND lamaRnp <> '',lamaRnp,0)) AS lamaRawatP,
SUM(IF(JENIS_KLMIN='1' AND tglKeluar<='".$tglAkhir."' AND pulangStatus <> '',1,0)) AS ranapPasienL,
SUM(IF(JENIS_KLMIN='2' AND tglKeluar<='".$tglAkhir."' AND pulangStatus <> '',1,0)) AS ranapPasienP,
SUM(IF((kdStatusPulang='4' OR kdStatusPulang='6') AND JENIS_KLMIN='1',1,0))+SUM(IF(pulangStatus=5 AND JENIS_KLMIN='1',1,0)) AS rujukL,
SUM(IF((kdStatusPulang='4' OR kdStatusPulang='6') AND JENIS_KLMIN='2',1,0))+SUM(IF(pulangStatus=5 AND JENIS_KLMIN='2',1,0)) AS rujukP
FROM (SELECT lok.`jknPbi`,lok.wilayah,pel.kdStatusPulang,lok.kunjBaru,lok.idLoket,lok.kunjSakit,lok.`pasienId`,lok.kdProvider,
lok.`puskId`,lok.`unitId`,lok.`tglKunjungan`,lok.`kategoriUnitId`,JENIS_KLMIN,rnp.`pulangStatus`,diag.diagnosaKasus,pel.kdPoli,rnp.tglKeluar,
DATEDIFF(rnp.`tglKeluar`,rnp.`tglMasuk`)+1 AS lamaRnp
FROM
simpus_loket lok
INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
LEFT JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId` 
INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori 
INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
LEFT JOIN simpus_ranap rnp ON rnp.`pelayananId`=pel.`idpelayanan`
WHERE tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
AND lok.kdProvider <> '' AND lok.kdProvider !='".$PPK."'
AND (lok.kunjSakit != '' OR sp.JENIS_KLMIN != '')
$unitx
$idpkm
$unit_details_x
$desa
GROUP BY pel.`idpelayanan`) AS reg";
$query=$this->db->query($sql);
    //    echo $this->db->last_query();
return $query;
}



     //======================== end =================== //

    //==============REKAPITULASI KUNJUNGAN RAWAT JALAN MENURUT KELOMPOK UMUR DI PUSKESMAS DAN JARINGANNYA =================== //
public function get_master_unit()
{
 $sql="select * from data_master_unit";
 $query = $this->db->query($sql);
 return $query;
}
function get_lap_induk_kunj_umur($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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

if($unit =='0')
    $unitx = '';
else
    $unitx = "AND dmu.id_kategori='".$unit."'";

if($kel == '0')
    $desa = "";
else
    $desa = "AND sp.no_kel = '".$kel."'";

$sql="SELECT kategori,
SUM(KasusBaruL) AS KasusBaruL,SUM(KasusBaruP) AS KasusBaruP,
SUM(kunKasusBaruL) AS kunKasusBaruL,SUM(kunKasusBaruP) AS kunKasusBaruP,
SUM(KasusLamaL) AS KasusLamaL,SUM(KasusLamaP) AS KasusLamaP,
SUM(kunKasusLamaL) AS kunKasusLamaL,SUM(kunKasusLamaP) AS kunKasusLamaP,
        #umur 0-7 hari
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 1 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru07L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 1 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru07P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 1 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama07L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 1 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama07P,
        #umur 8-28 hari
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 2 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru828L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 2 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru828P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 2 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama828L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 2 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama828P,
        #umur 1-12 bulan
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 3 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru112L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 3 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru112P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 3 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama112L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 3 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama112P,
        #umur 1-4 tahun
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 4 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru14L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 4 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru14P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 4 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama14L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 4 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama14P,
        #umur 5-9 tahun
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 5 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru59L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 5 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru59P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 5 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama59L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 5 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama59P,
        #umur 10-14 tahun
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 6 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru1014L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 6 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru1014P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 6 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama1014L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 6 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama1014P,
        #umur 15-19 tahun
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 7 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru1519L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 7 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru1519P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 7 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama1519L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 7 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama1519P,
        #umur 20-44 tahun
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 8 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru2044L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 8 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru2044P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 8 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama2044L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 8 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama2044P,
        #umur 45-54 tahun
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 9 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru4554L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 9 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru4554P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 9 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama4554L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 9 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama4554P,
        #umur 55-59 tahun
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 10 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru5559L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 10 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru5559P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 10 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama5559L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 10 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama5559P,
        #umur 60-69 tahun
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 11 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru6069L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 11 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru6069P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 11 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama6069L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 11 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama6069P,
        #umur >= 70 tahun
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 12 AND reg.`JENIS_KLMIN`='1',1,0)) AS baru70L,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kelUmur` = 12 AND reg.`JENIS_KLMIN`='2',1,0)) AS baru70P,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 12 AND reg.`JENIS_KLMIN`='1',1,0)) AS lama70L,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kelUmur` = 12 AND reg.`JENIS_KLMIN`='2',1,0)) AS lama70P,

SUM(IF(reg.`kunjBaru`='true' AND reg.`JENIS_KLMIN`='1',1,0)) AS jmlBaruL,
SUM(IF(reg.`kunjBaru`='true' AND reg.`JENIS_KLMIN`='2',1,0)) AS jmlBaruP,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`JENIS_KLMIN`='1',1,0)) AS jmlLamaL,
SUM(IF(reg.`kunjBaru`='false' AND reg.`JENIS_KLMIN`='2',1,0)) AS jmlLamaP
FROM
(SELECT dmu.`kategori`,lok.wilayah,pel.kdStatusPulang,lok.kunjBaru,lok.idLoket,lok.kunjSakit,
    diag.`kdDiagnosa`,diag.`nmDiagnosa`,diag.`diagnosaKasus`,lok.`pasienId`,lok.`kelUmur`,
    lok.`puskId`,lok.`unitId`,lok.`tglKunjungan`,lok.`kategoriUnitId`,JENIS_KLMIN,

    SUM(IF(diag.`diagnosaKasus` ='3' AND sp.`JENIS_KLMIN`='1',1,0)) AS KasusBaruL,
    SUM(IF(diag.`diagnosaKasus` ='3' AND sp.`JENIS_KLMIN`='2',1,0)) AS KasusBaruP,
    SUM(IF(diag.`diagnosaKasus` ='1' AND sp.`JENIS_KLMIN`='1',1,0)) AS kunKasusBaruL,
    SUM(IF(diag.`diagnosaKasus` ='1' AND sp.`JENIS_KLMIN`='2',1,0)) AS kunKasusBaruP,

    SUM(IF(diag.`diagnosaKasus` ='4' AND sp.`JENIS_KLMIN`='1',1,0)) AS KasusLamaL,
    SUM(IF(diag.`diagnosaKasus` ='4' AND sp.`JENIS_KLMIN`='2',1,0)) AS KasusLamaP,
    SUM(IF(diag.`diagnosaKasus` ='2' AND sp.`JENIS_KLMIN`='1',1,0)) AS kunKasusLamaL,
    SUM(IF(diag.`diagnosaKasus` ='2' AND sp.`JENIS_KLMIN`='2',1,0)) AS kunKasusLamaP

    FROM
    simpus_loket lok
    INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
    INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId` 
    INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori 
    INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
    WHERE
    tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    $unitx
    $idpkm
    $unit_details_x
    $desa GROUP BY pel.`idpelayanan`) reg
    GROUP BY kategori ORDER BY FIELD('PUSKESMAS',kategori) DESC
    ";
    $query=$this->db->query($sql);

    return $query;

}

function get_lap_induk_stat_pel($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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

if($unit =='0')
    $unitx = '';
else
    $unitx = "AND dmu.id_kategori='".$unit."'";

if($kel == '0')
    $desa = "";
else
    $desa = "AND sp.no_kel = '".$kel."'";

$sql="SELECT kategori,
        #tanpa tindakan
SUM(IF(reg.`kunjBaru`='true' AND  (reg.`kdTindakan` IS NULL  OR  reg.`kdTindakan`='') AND reg.`JENIS_KLMIN`='1',1,0)) AS baruNonTindakanL,
SUM(IF(reg.`kunjBaru`='true' AND  (reg.`kdTindakan` IS NULL  OR  reg.`kdTindakan`='')  AND reg.`JENIS_KLMIN`='2',1,0)) AS baruNonTindakanP,
SUM(IF(reg.`kunjBaru`='false' AND  (reg.`kdTindakan` IS NULL  OR  reg.`kdTindakan`='')  AND reg.`JENIS_KLMIN`='1',1,0)) AS lamaNonTindakanL,
SUM(IF(reg.`kunjBaru`='false' AND  (reg.`kdTindakan` IS NULL  OR  reg.`kdTindakan`='')  AND reg.`JENIS_KLMIN`='2',1,0)) AS lamaNonTindakanP,
        #tindakan
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kdTindakan` IS NOT NULL  AND reg.`JENIS_KLMIN`='1',1,0)) AS baruTindakanL,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kdTindakan` IS NOT NULL  AND reg.`JENIS_KLMIN`='2',1,0)) AS baruTindakanP,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kdTindakan` IS NOT NULL  AND reg.`JENIS_KLMIN`='1',1,0)) AS lamaTindakanL,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kdTindakan` IS NOT NULL  AND reg.`JENIS_KLMIN`='2',1,0)) AS lamaTindakanP,
        #bpjs 
SUM(IF(reg.`kunjBaru`='true' AND reg.`noKartu`!=''  AND reg.`JENIS_KLMIN`='1',1,0)) AS baruBpjsL,
SUM(IF(reg.`kunjBaru`='true' AND reg.`noKartu` !='' AND reg.`JENIS_KLMIN`='2',1,0)) AS baruBpjsP,
SUM(IF(reg.`kunjBaru`='false' AND reg.`noKartu` !=''  AND reg.`JENIS_KLMIN`='1',1,0)) AS lamaBpjsL,
SUM(IF(reg.`kunjBaru`='false' AND reg.`noKartu` !=''  AND reg.`JENIS_KLMIN`='2',1,0)) AS lamaBpjsP,
#non bpjs 
SUM(IF(reg.`kunjBaru`='true' AND reg.`noKartu`='' AND reg.`JENIS_KLMIN`='1',1,0)) AS baruNonBpjsL,
SUM(IF(reg.`kunjBaru`='true' AND reg.`noKartu`='' AND reg.`JENIS_KLMIN`='2',1,0)) AS baruNonBpjsP,
SUM(IF(reg.`kunjBaru`='false' AND reg.`noKartu`='' AND reg.`JENIS_KLMIN`='1',1,0)) AS lamaNonBpjsL, 
SUM(IF(reg.`kunjBaru`='false' AND reg.`noKartu`='' AND reg.`JENIS_KLMIN`='2',1,0)) AS lamaNonBpjsP,
        #bayar
SUM(IF(reg.`kunjBaru`='true' AND  reg.`WILAYAH` = 3 AND (reg.`noKartu` IS NULL OR reg.`noKartu`='') AND reg.`JENIS_KLMIN`='1',1,0)) AS baruBayarL,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`WILAYAH` = 3 AND (reg.`noKartu` IS NULL OR reg.`noKartu`='') AND reg.`JENIS_KLMIN`='2',1,0)) AS baruBayarP,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`WILAYAH` = 3 AND (reg.`noKartu` IS NULL OR reg.`noKartu`='') AND reg.`JENIS_KLMIN`='1',1,0)) AS lamaBayarL,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`WILAYAH` = 3 AND (reg.`noKartu` IS NULL OR reg.`noKartu`='') AND reg.`JENIS_KLMIN`='2',1,0)) AS lamaBayarP,
        #jen pel
SUM(IF(reg.`kdPoli`='001',1,0)) AS BP,
SUM(IF(reg.`kdPoli`='002',1,0)) AS GIGI,
SUM(IF(reg.`kdPoli`='003',1,0)) AS KIA,
SUM(IF(reg.`kdPoli`='008',1,0)) AS KB,
SUM(IF(reg.`kdPoli`='004',1,0)) AS LAB,
SUM(IF(reg.`kdPoli`='005',1,0)) AS UGD,        
        #jen pel
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kunjSakit` = 'false' AND reg.`JENIS_KLMIN`='1',1,0)) AS baruSehatL,
SUM(IF(reg.`kunjBaru`='true' AND  reg.`kunjSakit` = 'false' AND reg.`JENIS_KLMIN`='2',1,0)) AS baruSehatP,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kunjSakit` = 'false' AND reg.`JENIS_KLMIN`='1',1,0)) AS lamaSehatL,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`kunjSakit` = 'false' AND reg.`JENIS_KLMIN`='2',1,0)) AS lamaSehatP,

        #jml
SUM(IF(reg.`kunjBaru`='true' AND reg.`JENIS_KLMIN`='1',1,0)) AS jmlBaruL,
SUM(IF(reg.`kunjBaru`='true' AND reg.`JENIS_KLMIN`='2',1,0)) AS jmlBaruP,
SUM(IF(reg.`kunjBaru`='false' AND  reg.`JENIS_KLMIN`='1',1,0)) AS jmlLamaL,
SUM(IF(reg.`kunjBaru`='false' AND reg.`JENIS_KLMIN`='2',1,0)) AS jmlLamaP
FROM
(SELECT dmu.`kategori`,lok.wilayah,pel.kdStatusPulang,lok.kunjBaru,lok.idLoket,lok.kunjSakit,
    diag.`kdDiagnosa`,diag.`nmDiagnosa`,diag.`diagnosaKasus`,lok.`pasienId`,lok.`kelUmur`,
    lok.`puskId`,lok.`unitId`,lok.`tglKunjungan`,lok.`kategoriUnitId`,JENIS_KLMIN,st.kdTindakan,sp.noKartu,
    pel.kdPoli
    FROM
    simpus_loket lok
    INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_data_diagnosa diag ON diag.`pelayananId`=pel.`idpelayanan`
    LEFT JOIN simpus_tindakan st ON st.`idPelayanan`=pel.`idpelayanan`
    INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.`unitId` 
    INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori 
    INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
    WHERE
    tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    $unitx
    $idpkm
    $unit_details_x
    $desa GROUP BY pel.`idpelayanan`) reg
    GROUP BY kategori ORDER BY FIELD('PUSKESMAS',kategori) DESC";
    $query=$this->db->query($sql);
    return $query;

}

//======================== LAPORAN REGISTER KUNJUNGAN PASIEN SEHAT =================== //

public function get_cek_data($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel)
{
    if($this->getId() != '46')
        $idpkm =" AND sk.puskId='".$this->getId()."' ";
    else
        $idpkm = '';

    $tglAwal=date("Y-m-d",strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

    if($unit_details == '0')
        $unit_details_x = "";
    else
        $unit_details_x = "AND sk.`unitId`= '".$unit_details."'";

    if($kel == '0')
        $desa = "";
    else
        $desa = "AND sp.no_kel = '".$kel."'";

        //code unit
    if($unit =='0')
        $unitx = '';
    else
        $unitx = "AND dmu.id_kategori='".$unit."'";

    $sql="SELECT sk.`idLoket`,DATE_FORMAT(sk.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,sp.`ALAMAT`,kec.`NAMA_KEC`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,sk.`kelUmur`,sk.`UMUR`,sp.`JENIS_KLMIN`, sk.`kdPoli`,spn.`tujuanPoli`,sk.kunjBaru,wilayah,kunjSakit,sp.NO_PROP,sp.NO_KAB,sp.NO_KEC,sp.NO_KEL,dmu.`kategori`,dmud.`nama_unit`
    FROM simpus_loket sk
    INNER JOIN simpus_pasien sp ON sp.`ID`=sk.`pasienId`
    inner JOIN simpus_pelayanan spn ON spn.`loketId`=sk.`idLoket`
    left JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` and kec.`NO_KAB` = sp.`NO_KAB` and kec.`NO_PROP`=sp.`NO_PROP`
    left JOIN setup_kel kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` 
    and kel.`NO_KAB` = sp.`NO_KAB` and kel.`NO_PROP`=sp.`NO_PROP`
        #code unit
    INNER JOIN data_master_unit_detail dmud on dmud.id_detail=sk.unitId
    inner join data_master_unit dmu on dmu.id_kategori=dmud.id_kategori

    WHERE
    tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    AND (sk.kunjSakit = '' OR sp.JENIS_KLMIN = '' OR sp.`NO_KAB`='' OR sp.`NO_PROP`='' OR sp.`NO_KEC`='' OR sp.`NO_KEL`='' or sk.wilayah=''
    OR sk.kunjSakit IS NULL OR sp.JENIS_KLMIN IS NULL OR sp.`NO_KAB` IS NULL OR sp.`NO_PROP` IS NULL OR sp.`NO_KEC` IS NULL OR sp.`NO_KEL` IS NULL or sk.wilayah IS NULL or
    sk.kunjSakit = '0' OR sp.JENIS_KLMIN = '0' OR sp.`NO_KAB`='0' OR sp.`NO_PROP`='0' OR sp.`NO_KEC`='0' OR sp.`NO_KEL`='0' or sk.wilayah='0') 
    $unitx
    $idpkm
    $unit_details_x
    $desa 
    ";
    $query=$this->db->query($sql);
       // echo $this->db->last_query();
    return $query;
}

    //======================== LAPORAN REKAPITULASI RUJUK LANJUT =================== //

function get_lap_rek_ruj_lan($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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

    if($kel == '0')
        $desa = "";
    else
        $desa = "AND sp.no_kel = '".$kel."'";

        //code unit
    if($unit =='0')
        $unitx = '';
    else
        $unitx = "AND dmu.id_kategori='".$unit."'";

    $sql="SELECT * FROM (

    SELECT srl.`kdppk` AS kode,spr.`nmProvider` AS nama,srl.`jnsRujukLanjut` AS jenis,
    spf.`nmPoli` AS poli,srl.`kdSarana` AS sarana,
    SUM(sp.`noKartu`='') AS non_bpjs,
    SUM(sp.`noKartu`!='') AS bpjs
    FROM simpus_loket lok
    INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
    LEFT JOIN simpus_rujuk_lanjut srl ON lok.`idLoket`=srl.`loketID`
    LEFT JOIN simpus_provider spr ON spr.`kdProvider`=srl.`kdppk`
    LEFT JOIN simpus_poli_fktl spf ON srl.`kdPoliRujLan`=spf.`kdPoli`

    INNER JOIN data_master_unit_detail dmud on dmud.id_detail=lok.unitId
    inner join data_master_unit dmu on dmu.id_kategori=dmud.id_kategori

    WHERE lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    AND jnsRujukLanjut='umum' AND srl.`kdppk` <> ''
    $unitx
    $idpkm
    $unit_details_x
    $desa 
    GROUP BY srl.`kdppk`,spf.`kdPoli`

    union 
    SELECT srl.`kdppk` AS kode,srl.`nmppk` AS nama,srl.`jnsRujukLanjut` AS jenis,
    sss.`nmSubSpesialis` AS poli,ssn.`nmSarana` AS sarana,
    SUM(sp.`noKartu`='') AS non_bpjs,
    SUM(sp.`noKartu`!='') AS bpjs
    FROM simpus_loket lok
    INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
    LEFT JOIN simpus_rujuk_lanjut srl ON lok.`idLoket`=srl.`loketID`
    LEFT JOIN simpus_provider spr ON spr.`kdProvider`=srl.`kdppk`
    LEFT JOIN simpus_subspesialis sss ON sss.`kdSubSpesialis`=srl.`kdSubSpesialis`
    LEFT JOIN simpus_spesialissarana ssn ON ssn.`kdSarana`=srl.`kdSarana`
     INNER JOIN data_master_unit_detail dmud on dmud.id_detail=lok.unitId
    inner join data_master_unit dmu on dmu.id_kategori=dmud.id_kategori
    WHERE lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    AND jnsRujukLanjut='spesialis' AND srl.`kdppk` <> ''
    $unitx
    $idpkm
    $unit_details_x
    $desa 
    GROUP BY srl.`kdppk`,sss.`kdSubSpesialis`,ssn.`kdSarana`

    union
    SELECT srl.`kdppk` AS kode,srl.`nmppk` AS nama,srl.`jnsRujukLanjut` AS jenis,
    ssk.`kdKhusus` AS poli,srl.`kdSarana` AS sarana,
    SUM(sp.`noKartu`='') AS non_bpjs,
    SUM(sp.`noKartu`!='') AS bpjs
    FROM simpus_loket lok
    INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
    LEFT JOIN simpus_rujuk_lanjut srl ON lok.`idLoket`=srl.`loketID`
    LEFT JOIN simpus_provider spr ON spr.`kdProvider`=srl.`kdppk`
    LEFT JOIN simpus_spesialiskhusus ssk ON ssk.`kdKhusus`=srl.`kdKhusus`

    INNER JOIN data_master_unit_detail dmud on dmud.id_detail=lok.unitId
    inner join data_master_unit dmu on dmu.id_kategori=dmud.id_kategori
    
    WHERE lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    AND jnsRujukLanjut='khusus' AND srl.`kdppk` <> ''
    $unitx
    $idpkm
    $unit_details_x
    $desa 
    GROUP BY srl.`kdppk`,ssk.`kdKhusus`

    ) a
    order by nama ASC
    ";
    $query=$this->db->query($sql);
        //echo $this->db->last_query();
    return $query;
}

public function get_lap_provider($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
{
     if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND sk.`puskId`='".$pusk."' ";

    $tglAwal=date("Y-m-d",strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

    if($unit_details == '0')
        $unit_details_x = "";
    else
        $unit_details_x = "AND sk.`unitId`= '".$unit_details."'";

    if($kel == '0')
        $desa = "";
    else
        $desa = "AND sp.no_kel = '".$kel."'";

        //code unit
    if($unit =='0')
        $unitx = '';
    else
        $unitx = "AND dmu.id_kategori='".$unit."'";

    $sql="SELECT sk.`idLoket`,DATE_FORMAT(sk.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,
    sp.`NAMA_LGKP`,sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,sk.`kelUmur`,
    sk.`UMUR`,sp.`JENIS_KLMIN`,sk.`statusKartu`,sk.`providerKartu`,sk.`jnsPeserta`,sk.`jknPbi`,wilayah,pc.KODE_PPK
    FROM simpus_loket sk
    INNER JOIN simpus_pasien sp ON sp.`ID`=sk.`pasienId`
    inner JOIN simpus_pelayanan s ON s.`loketId`=sk.`idLoket`
    INNER JOIN pcare pc on pc.PUSK_ID=sk.puskId
    INNER JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP`
    INNER JOIN setup_kel kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` 
    AND kel.`NO_KAB` = sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        #code unit
    INNER JOIN data_master_unit_detail dmud on dmud.id_detail=sk.`unitId`
    inner join data_master_unit dmu on dmu.id_kategori=dmud.id_kategori

    WHERE tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    AND (sk.kunjSakit != '' OR sp.JENIS_KLMIN != '')
    $unitx
    $idpkm
    $unit_details_x
    $desa 
    group by sk.`idLoket`
    ";
    $query=$this->db->query($sql);
        //echo $this->db->last_query();
    return $query;
}
    //======================================= END ================================= //



}