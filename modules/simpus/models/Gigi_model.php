<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gigi_model extends CI_Model {

	var $table = 'simpus_kunjungan as a';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('b.NAMA_LGKP','b.ALAMAT','c.kategori','d.nama_unit','b.NIK','b.noKartu','b.NO_MR','b.NO_KK'); //set column field database for datatable searchable 
    var $order = array('id'=>'desc'); // default order 



    public function getId()
    {
    	$user_id = $this->session->userdata('user_id');
    	$this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
    	return $this->id;

    }
    private function _get_datatables_query()
    {

    	$this->db->select('a.*,c.*,d.*,b.NO_MR,b.NO_MR_LAMA,b.NAMA_LGKP,b.NIK,b.NO_PROP,b.NO_KAB,b.NO_KEC,b.NO_KEL,b.ALAMAT,b.NO_RT,b.NO_RW,b.noKartu');


    	if($this->input->post('id_detail'))
    	{
    		$this->db->where('d.id_detail', $this->input->post('id_detail'));
    	}

    	if($this->input->post('tglKunjungan'))
    	{
    		$tglKunjungan=date("Y-m-d", strtotime($this->input->post('tglKunjungan')));
    		$this->db->where('a.tglKunjungan', $tglKunjungan);
    	}   

    	if($this->input->post('yyy'))
    	{
    		$this->db->where('yyy', $this->input->post('yyy'));
    	}

    	$this->db->join('simpus_pasien as b','a.pasien_id = b.ID');
    	$this->db->join('data_master_unit as c','a.id_kategori_unit = c.id_kategori','left');
    	$this->db->join('data_master_unit_detail as d','a.id_unit = d.id_detail','left');
    	if($this->getId().$this->id!=46){
    		$where=" (a.kdPoli = 002 OR a.kdPoliRujukInternal = 002)";
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

    public function get_gigi_atas1(){
    	$sql = "SELECT * FROM gigi_jenis WHERE id <=10 ORDER BY id ASC;";
    	$query=$this->db->query($sql);
    	return $query;
    }

    public function get_gigi_atas(){
    	$sql = "SELECT * FROM gigi_jenis WHERE id BETWEEN 11 AND 26 ORDER BY id ASC;";
    	$query=$this->db->query($sql);
    	return $query;
    }

    public function get_gigi_bawah1(){
    	$sql = "SELECT * FROM gigi_jenis WHERE id BETWEEN 27 AND 36 ORDER BY id ASC;";
    	$query=$this->db->query($sql);
    	return $query;
    }

    public function get_gigi_bawah(){
    	$sql = "SELECT * FROM gigi_jenis WHERE id >=37 ORDER BY id ASC;";
    	$query=$this->db->query($sql);
    	return $query;
    }

    public function get_gigi_master_satu(){
    	$sql = "SELECT * FROM gigi_master gm where gm.`KATEGORI`='1' ORDER BY gm.`KODE` ASC;";
    	$query=$this->db->query($sql);
    	return $query;
    }

    public function get_gigi_pelayanan(){
        $sql = "SELECT * FROM simpus_diagnosa sd WHERE sd.`gigi`='1' ORDER BY sd.`id` ASC;";
        $query=$this->db->query($sql);
        return $query;
    }

    public function get_gigi_master_dua(){
    	$sql = "SELECT * FROM gigi_master gm where gm.`KATEGORI`='2' ORDER BY gm.`KODE` ASC;";
    	$query=$this->db->query($sql);
    	return $query;
    }

    public function get_gigi_master_tiga(){
    	$sql = "SELECT * FROM gigi_master gm where gm.`KATEGORI`='3' ORDER BY gm.`KODE` ASC;";
    	$query=$this->db->query($sql);
    	return $query;
    }

    public function get_lap_reg_gigi($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$status,$pusk)
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
      $unitx = "AND kategoriUnitId='".$unit."'";

  if($kel == '0')
      $desa = "";
  else
      $desa = "AND sp.no_kel = '".$kel."'";

  if($status == '0')
      $stts = "";
  else
      $stts = "AND sa.statuspasien = '".$status."'";


  $sql="SELECT sp.`NO_MR`,lok.`puskId`,sp.`noKartu`,sp.`NAMA_LGKP`,lok.`umur`,sp.`ALAMAT`,kel.`NAMA_KEL`,kec.`NAMA_KEC`,sa.`terapi`,dk.`kasus`,sg.`status`,IF(lok.`noKartu`!='','BPJS','NON BPJS') AS kategori,srl.`nmppk`,
  GROUP_CONCAT(DISTINCT  concat('(',sdd.kdDiagnosa,') ',sdd.`nmDiagnosa`) separator ', ') diagnosa,
  GROUP_CONCAT(DISTINCT CONCAT('(',st.`kdTindakan`,') ',st.`nmTindakan`) SEPARATOR ', ') tindakan,
  GROUP_CONCAT(DISTINCT  CONCAT('(',spo.`kode_obat`,') ',spo.`nama_obat`) SEPARATOR ', ') obat
  FROM simpus_loket lok 
  INNER JOIN simpus_pasien sp ON lok.`pasienId`=sp.`ID`
  inner JOIN simpus_pelayanan spn ON lok.`idLoket`=spn.`loketId`
  LEFT JOIN simpus_rujuk_lanjut srl ON spn.`loketId`=srl.`loketID`
  LEFT JOIN simpus_poli_fktp pf ON lok.`kdPoli`=pf.`kdPoli`
  LEFT JOIN simpus_anamnesa sa ON sa.`loketId`=lok.`idLoket`
  LEFT JOIN master_status_gigi sg ON sa.`statuspasien`=sg.`id_status`
  LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
  LEFT JOIN master_diagnosa_kasus dk ON dk.`id`=sdd.`diagnosaKasus`
  LEFT JOIN simpus_tindakan st ON st.`idPelayanan`=spn.`idpelayanan`
  LEFT JOIN simpus_pakai_obat spo ON spo.`pelayananId`=spn.`idpelayanan`
  LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
  LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
  INNER JOIN data_master_unit_detail dmud on dmud.`id_detail`=lok.`unitId`
  inner join data_master_unit dmu on dmu.`id_kategori`=dmud.`id_kategori`
  WHERE 
  spn.`kdPoli`='002'
  AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
  $unitx
  $idpkm
  $unit_details_x
  $desa 
  $stts
  GROUP BY spn.`idpelayanan`
  ";
  $query=$this->db->query($sql);
       // echo $this->db->last_query();
  return $query;
}

    //======================== end =================== //


public function getLap_rekap_tind_poli_gigi($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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
  $unitx = "AND kategoriUnitId='".$unit."'";

if($kel == '0')
  $desa = "";
else
  $desa = "AND sp.no_kel = '".$kel."'";

$sql="SELECT st.`kdTindakan`,st.`nmTindakan`,COUNT(kdTindakan) AS jml,
SUM(IF(sp.`JENIS_KLMIN`='1',1,0)) AS baruL,
SUM(IF(sp.`JENIS_KLMIN`='2',1,0)) AS baruP 
FROM simpus_loket lok
INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
LEFT JOIN simpus_tindakan st ON st.`idPelayanan`=spn.`idpelayanan`

         #code unit
INNER JOIN data_master_unit_detail dmud on dmud.`id_detail`=lok.`unitId`
INNER JOIN data_master_unit dmu on dmu.`id_kategori`=dmud.`id_kategori`

WHERE st.`kdTindakan`!='' AND spn.`kdPoli`='002'# OR spn.`tujuanPoli`='002')
AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
$unitx
$idpkm
$unit_details_x
$desa 
GROUP BY st.`kdTindakan`
ORDER BY jml DESC LIMIT 20;" ;
$query=$this->db->query($sql);

return $query;
}

public function getLap_pelayanan_gigi($unit,$unit_details,$bulan,$tahun,$kel,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND sl.`puskId`='".$pusk."' ";

if($unit_details == '0')
  $unit_details_x = "";
else
  $unit_details_x = "AND sl.`unitId`= '".$unit_details."'";

        //code unit
if($unit =='0')
  $unitx = '';
else
  $unitx = "AND kategoriUnitId='".$unit."'";

if($kel == '0')
  $desa = "";
else
  $desa = "AND sp.no_kel = '".$kel."'";

$sql="SELECT 
SUM(IF(sl.`kunjBaru`='true' AND sp.`JENIS_KLMIN`='1',1,0)) kunjBaruL,
SUM(IF(sl.`kunjBaru`='true' AND sp.`JENIS_KLMIN`='2',1,0)) kunjBaruP,
SUM(IF(sl.`kunjBaru`='false' AND sp.`JENIS_KLMIN`='1',1,0)) kunjLamaL,
SUM(IF(sl.`kunjBaru`='false' AND sp.`JENIS_KLMIN`='2',1,0)) kunjLamaP,
#bumil
SUM(IF(sl.`kunjBaru`='true' AND sa.`statusPasien`='3' AND sp.`JENIS_KLMIN`='1',1,0)) kunjBaruBumilL,
SUM(IF(sl.`kunjBaru`='true' AND sa.`statusPasien`='3' AND sp.`JENIS_KLMIN`='2',1,0)) kunjBaruBumilP,
SUM(IF(sl.`kunjBaru`='false' AND sa.`statusPasien`='3' AND sp.`JENIS_KLMIN`='1',1,0)) kunjLamaBumilL,
SUM(IF(sl.`kunjBaru`='false' AND sa.`statusPasien`='3' AND sp.`JENIS_KLMIN`='2',1,0)) kunjLamaBumilP,
#apras
SUM(IF(sl.`kunjBaru`='true' AND sa.`statusPasien`='2' AND sp.`JENIS_KLMIN`='1',1,0)) kunjBaruAprasL,
SUM(IF(sl.`kunjBaru`='true' AND sa.`statusPasien`='2' AND sp.`JENIS_KLMIN`='2',1,0)) kunjBaruAprasP,
SUM(IF(sl.`kunjBaru`='false' AND sa.`statusPasien`='2' AND sp.`JENIS_KLMIN`='1',1,0)) kunjLamaAprasL,
SUM(IF(sl.`kunjBaru`='false' AND sa.`statusPasien`='2' AND sp.`JENIS_KLMIN`='2',1,0)) kunjLamaAprasP,
#anak sekolah
SUM(IF(sl.`kunjBaru`='true' AND sa.`statusPasien`='1' AND sp.`JENIS_KLMIN`='1',1,0)) kunjBaruAnSekL,
SUM(IF(sl.`kunjBaru`='true' AND sa.`statusPasien`='1' AND sp.`JENIS_KLMIN`='2',1,0)) kunjBaruAnSekP,
SUM(IF(sl.`kunjBaru`='false' AND sa.`statusPasien`='1' AND sp.`JENIS_KLMIN`='1',1,0)) kunjLamaAnSekL,
SUM(IF(sl.`kunjBaru`='false' AND sa.`statusPasien`='1' AND sp.`JENIS_KLMIN`='2',1,0)) kunjLamaAnSekP,
#umum
SUM(IF(sl.`kunjBaru`='true' AND sa.`statusPasien`='4' AND sp.`JENIS_KLMIN`='1',1,0)) kunjBaruUmumL,
SUM(IF(sl.`kunjBaru`='true' AND sa.`statusPasien`='4' AND sp.`JENIS_KLMIN`='2',1,0)) kunjBaruUmumP,
SUM(IF(sl.`kunjBaru`='false' AND sa.`statusPasien`='4' AND sp.`JENIS_KLMIN`='1',1,0)) kunjLamaUmumL,
SUM(IF(sl.`kunjBaru`='false' AND sa.`statusPasien`='4' AND sp.`JENIS_KLMIN`='2',1,0)) kunjLamaUmumP,
SUM(IF(sa.`statusPasien`=' ' OR sa.`statusPasien`IS NULL AND sp.`JENIS_KLMIN`='1',1,0)) tanpaKeteranganL,
SUM(IF(sa.`statusPasien`=' ' OR sa.`statusPasien`IS NULL AND sp.`JENIS_KLMIN`='2',1,0)) tanpaKeteranganP
FROM simpus_loket sl 
INNER JOIN simpus_pasien sp ON sp.`ID`=sl.`pasienId`
INNER JOIN simpus_pelayanan spn ON spn.`loketId`=sl.`idLoket`
LEFT JOIN simpus_anamnesa sa ON sa.`loketId`=sl.`idLoket`

INNER JOIN data_master_unit_detail dmud on dmud.`id_detail`=sl.`unitId`
INNER JOIN data_master_unit dmu on dmu.`id_kategori`=dmud.`id_kategori`

WHERE MONTH(sl.`tglKunjungan`)='".$bulan."' AND YEAR(sl.`tglKunjungan`)='".$tahun."' 
AND spn.`kdPoli`='002'
$unitx
$idpkm
$unit_details_x
$desa 
";
$query=$this->db->query($sql);
		//echo $this->db->last_query();
return $query;
}

public function getLap_diag_gigi($kdDiagnosa,$unit,$unit_details,$bulan,$tahun,$kel,$pusk)
{
   if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND sl.`puskId`='".$pusk."' ";

if($unit_details == '0')
    $unit_details_x = "";
else
    $unit_details_x = "AND sl.`unitId`= '".$unit_details."'";

        //code unit
if($unit =='0')
    $unitx = '';
else
    $unitx = "AND kategoriUnitId='".$unit."'";

if($kel == '0')
    $desa = "";
else
    $desa = "AND sp.no_kel = '".$kel."'";

$sql="SELECT SUM(IF(sp.`JENIS_KLMIN`='1',1,0)) AS jumL,
SUM(IF(sp.`JENIS_KLMIN`='2',1,0)) AS jumP FROM simpus_loket sl
INNER JOIN simpus_pasien sp ON sp.`ID`=sl.`pasienId`
INNER JOIN simpus_pelayanan spn ON spn.`loketId`=sl.`idLoket`
LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`

INNER JOIN data_master_unit_detail dmud on dmud.`id_detail`=sl.`unitId`
INNER JOIN data_master_unit dmu on dmu.`id_kategori`=dmud.`id_kategori`

WHERE sdd.`kdDiagnosa`='".$kdDiagnosa."' AND sdd.`kdDiagnosa`!='' AND
MONTH(sl.`tglKunjungan`)='".$bulan."' AND YEAR(sl.`tglKunjungan`)='".$tahun."' 
AND spn.`kdPoli`='002'
$unitx
$idpkm
$unit_details_x
$desa 
";
$query=$this->db->query($sql);
        //echo $this->db->last_query();
return $query;
}

public function getLap_uraian($kdUraian,$bulan,$tahun,$pusk)
{
  if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND a.`puskId`='".$pusk."' ";
    // if($unit_details == '0')
    //     $unit_details_x = "";
    // else
    //     $unit_details_x = "AND sl.`unitId`= '".$unit_details."'";

    //     //code unit
    // if($unit =='0')
    //     $unitx = '';
    // else
    //     $unitx = "AND kategoriUnitId='".$unit."'";

    // if($kel == '0')
    //     $desa = "";
    // else
    //     $desa = "AND sp.no_kel = '".$kel."'";

$sql="SELECT a.*,b.`URAIAN` FROM simpus_lap_gigi_mulut a 
INNER JOIN gigi_master b ON a.`kdUraian`=b.`KODE`
WHERE a.`bulan`='".$bulan."' AND a.`tahun`='".$tahun."' AND a.`kdUraian`='".$kdUraian."'
$idpkm 
";
$query=$this->db->query($sql);
      //  echo $this->db->last_query();
return $query;
}

public function getLap_kasus_penya_gigi_mulut($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
{
   if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND a.`puskId`='".$pusk."' ";

$tglAwal=date("Y-m-d",strtotime($tgl_awal));
$tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

if($unit_details == '0')
    $unit_details_x = "";
else
    $unit_details_x = "AND a.`unitId`= '".$unit_details."'";

        //code unit
if($unit =='0')
    $unitx = '';
else
    $unitx = "AND kategoriUnitId='".$unit."'";

if($kel == '0')
    $desa = "";
else
    $desa = "AND sp.no_kel = '".$kel."'";

$sql="SELECT c.`kdDiagnosa`,c.`nmDiagnosa`, 
#kunjungan kasus
SUM(IF(a.`umur`<'7' AND c.`diagnosaKasus`='1' AND sp.`JENIS_KLMIN`='1',1,0)) AS kbaru7L,
SUM(IF(a.`umur`<'7' AND c.`diagnosaKasus`='1' AND sp.`JENIS_KLMIN`='2',1,0)) AS kbaru7P,
#kasus
SUM(IF(a.`umur`<'7' AND c.`diagnosaKasus`='3' AND sp.`JENIS_KLMIN`='1',1,0)) AS baru7L,
SUM(IF(a.`umur`<'7' AND c.`diagnosaKasus`='3' AND sp.`JENIS_KLMIN`='2',1,0)) AS baru7P,
#kasus
#kunjungan kasus
SUM(IF((a.`umur`>='7' && a.`umur`<='15') AND c.`diagnosaKasus`='1' AND sp.`JENIS_KLMIN`='1',1,0)) AS kbaru715L,
SUM(IF((a.`umur`>='7' && a.`umur`<='15') AND c.`diagnosaKasus`='1' AND sp.`JENIS_KLMIN`='2',1,0)) AS kbaru715P,
#kasus
SUM(IF((a.`umur`>='7' && a.`umur`<='15') AND c.`diagnosaKasus`='3' AND sp.`JENIS_KLMIN`='1',1,0)) AS baru715L,
SUM(IF((a.`umur`>='7' && a.`umur`<='15') AND c.`diagnosaKasus`='3' AND sp.`JENIS_KLMIN`='2',1,0)) AS baru715P,
#kunjungan kasus
SUM(IF((a.`umur`>='16' && a.`umur`<='59') AND c.`diagnosaKasus`='1' AND sp.`JENIS_KLMIN`='1',1,0)) AS kbaru1659L,
SUM(IF((a.`umur`>='16' && a.`umur`<='59') AND c.`diagnosaKasus`='1' AND sp.`JENIS_KLMIN`='2',1,0)) AS kbaru1659P,
#kasus
SUM(IF((a.`umur`>='16' && a.`umur`<='59') AND c.`diagnosaKasus`='3' AND sp.`JENIS_KLMIN`='1',1,0)) AS baru1659L,
SUM(IF((a.`umur`>='16' && a.`umur`<='59') AND c.`diagnosaKasus`='3' AND sp.`JENIS_KLMIN`='2',1,0)) AS baru1659P,
#kunjungan kasus
SUM(IF(a.`umur`>='60' AND c.`diagnosaKasus`='1' AND sp.`JENIS_KLMIN`='1',1,0)) AS kbaru60L,
SUM(IF(a.`umur`>='60' AND c.`diagnosaKasus`='1' AND sp.`JENIS_KLMIN`='2',1,0)) AS kbaru60P,
#kasus
SUM(IF(a.`umur`>='60' AND c.`diagnosaKasus`='3' AND sp.`JENIS_KLMIN`='1',1,0)) AS baru60L,
SUM(IF(a.`umur`>='60' AND c.`diagnosaKasus`='3' AND sp.`JENIS_KLMIN`='2',1,0)) AS baru60P,
#kunjungan kasus
SUM(IF(c.`diagnosaKasus`='1' AND sp.`JENIS_KLMIN`='1',1,0)) AS jmlKbaruL,
SUM(IF(c.`diagnosaKasus`='1' AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlKbaruP,

SUM(IF(c.`diagnosaKasus`<='2' AND sp.`JENIS_KLMIN`='1',1,0)) AS jmlKbaruLamaL,
SUM(IF(c.`diagnosaKasus`<='2' AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlKbaruLamaP,
SUM(IF(c.`diagnosaKasus`>='3' AND sp.`JENIS_KLMIN`='1',1,0)) AS jmlBaruLamaL,
SUM(IF(c.`diagnosaKasus`>='3' AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlBaruLamaP,
#kasus
SUM(IF(c.`diagnosaKasus`='3' AND sp.`JENIS_KLMIN`='1',1,0)) AS jmlBaruL,
SUM(IF(c.`diagnosaKasus`='3' AND sp.`JENIS_KLMIN`='2',1,0)) AS jmlBaruP,
#kunjungan kasus
SUM(IF(c.`diagnosaKasus`='2' AND sp.`JENIS_KLMIN`='1',1,0)) AS klamaL,
SUM(IF(c.`diagnosaKasus`='2' AND sp.`JENIS_KLMIN`='2',1,0)) AS klamaP, 
#kasus
SUM(IF(c.`diagnosaKasus`='4' AND sp.`JENIS_KLMIN`='1',1,0)) AS lamaL,
SUM(IF(c.`diagnosaKasus`='4' AND sp.`JENIS_KLMIN`='2',1,0)) AS lamaP 
FROM simpus_loket a
INNER JOIN simpus_pasien sp ON a.`pasienId`=sp.`ID`
INNER JOIN simpus_pelayanan b ON b.`loketId`=a.`idLoket`
LEFT JOIN simpus_data_diagnosa c ON b.`idpelayanan`=c.`pelayananId`
LEFT JOIN master_diagnosa_kasus d ON c.`diagnosaKasus`=d.`id`
         #code unit
INNER JOIN data_master_unit_detail dmud on dmud.`id_detail`=a.`unitId`
INNER JOIN data_master_unit dmu on dmu.`id_kategori`=dmud.`id_kategori`

WHERE (b.`kdPoli`='002' OR b.`tujuanPoli`='002') AND c.`kdDiagnosa`!=''
AND a.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."' 

$unitx
$idpkm
$unit_details_x
$desa 
GROUP BY c.`kdDiagnosa`" ;
$query=$this->db->query($sql);
//echo $this->db->last_query();
return $query;
}



////


}