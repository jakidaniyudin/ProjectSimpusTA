<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Farmasi_model extends CI_Model {

  var $table = 'simpus_master_obat';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('NAMA'); //set column field database for datatable searchable 
    var $order = array('NAMA'=>'asc'); // default order 

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
  public function get_Unit_Details($unitDetails)
  {
      $this->db->select('id_detail,id_unit,nama_unit');
      $this->db->from('data_master_unit_detail as a');
      $this->db->where('a.id_detail',$unitDetails);

      $query = $this->db->get();
      return $query;
  }
  public function _get_datatables_query()
  {
     $this->db->select('OBAT_ID,KODE_OBAT,NAMA,TAHUN,SATUAN,HARGA,GOLONGAN,JENIS,AKTIF');
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

    public function getUnitDropdown()
    {
      $K=$this->db->query("SELECT * FROM data_master_unit WHERE farmasi_unit ='TRUE'");

      foreach ($K->result_array() as $row)
      {
        $data[$row['id_kategori']] = $row['kategori'];
    }

    $K->free_result();
    return $data;
}
public function getUnitDetails($unit)
{

  if($this->getId() != '46')
   $idpkm = "id_unit='".$this->getId()."'  ";
else
   $idpkm = '';

if($unit == '0')
   $unitx='';
else
   $unitx="AND id_kategori='".$unit."' "; 
$K=$this->db->query("SELECT * FROM data_master_unit_detail WHERE  $idpkm  $unitx ORDER BY nama_unit ASC");



foreach ($K->result_array() as $row)
{
    $data[$row['id_detail']] = $row['nama_unit'];
}
$K->free_result();
return isset($data) ? $data : NULL;
}

public function getPasienApotek($unit_details,$date)
{
    $sql ="SELECT lok.idLoket,spn.idpelayanan,lok.jknPbi,NO_MR,sp.NAMA_LGKP,JENIS_KLMIN,sp.ALAMAT,kec.NAMA_KEC,kel.NAMA_KEL,lok.resep_diambil,sample_resep,sr.createdDate
    FROM simpus_loket lok 
    INNER JOIN simpus_pasien sp ON sp.ID=lok.pasienId
    INNER JOIN simpus_pelayanan spn ON spn.loketId=lok.idLoket   
    inner join simpus_resep_obat sr on sr.loketId=lok.idLoket     
    LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP 
    LEFT JOIN setup_kel kel ON kel.NO_KEC=sp.NO_KEC AND kel.NO_KEL=sp.NO_KEL AND kel.NO_KAB=sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP 
    WHERE 
    DATE_FORMAT(lok.tglKunjungan,'%d-%m-%Y')='$date'  
    AND lok.unitId='$unit_details'    
    GROUP BY lok.idLoket
    order by resep_diambil,sr.createdDate asc";
    $query = $this->db->query($sql);

    return $query;
}
public function getpasienByIdpel($idLoket)
{
    $sql ="SELECT lok.idLoket,spn.idpelayanan,lok.tglKunjungan,lok.jknPbi,sp.NAMA_LGKP,JENIS_KLMIN,sp.ALAMAT,kec.NAMA_KEC,kel.NAMA_KEL,spn.statusResep,ALERGI,umur,TGL_LHR,statusResep,statusSampel
    FROM simpus_loket lok 
    INNER JOIN simpus_pasien sp ON sp.ID=lok.pasienId
    INNER JOIN simpus_pelayanan spn ON spn.loketId=lok.idLoket        
    LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP 
    LEFT JOIN setup_kel kel ON kel.NO_KEC=sp.NO_KEC AND kel.NO_KEL=sp.NO_KEL AND kel.NO_KAB=sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP 
    WHERE 
    DATE_FORMAT(lok.tglKunjungan,'%d-%m-%Y')='$date'  
    AND lok.unitId='$unit_details' 
    GROUP BY lok.loketId";
    $query = $this->db->query($sql);

    return $query;
}
public function getDiagnosaListbyloketId($idLoket)
{
   $sql ="SELECT sp.idpelayanan,sp.loketId,sd.kdPoli,poli.nmPoli,sd.kdDiagnosa,sd.nmDiagnosa 
   FROM simpus_pelayanan sp 
   INNER JOIN simpus_data_diagnosa sd ON sd.pelayananId=sp.idpelayanan
   INNER JOIN simpus_poli_fktp poli ON poli.kdPoli=sp.kdPoli
   WHERE sp.loketId='".$idLoket."'";
   $query = $this->db->query($sql);
   return $query;
}
public function getObatListbyloketId($idLoket)
{
   $sql ="SELECT spo.id_pakai,sp.idpelayanan,lok.unitId,sp.kdPoli,poli.nmPoli,nama_obat,jumlah,dosis_pakai,puyer,nama_puyer,jumlah_puyer 
   FROM simpus_pakai_obat spo 
   INNER JOIN simpus_pelayanan sp ON sp.idpelayanan=spo.pelayananId
   INNER JOIN simpus_poli_fktp poli ON poli.kdPoli=sp.kdPoli
   inner join simpus_loket lok on lok.idLoket=sp.loketId
   WHERE sp.loketId='".$idLoket."'";
   $query = $this->db->query($sql);
   return $query;
}
function getDataObatLangung($unit_details,$date)
{
    $sql = "SELECT * FROM simpus_resep_obat obat
    INNER JOIN data_master_unit_detail unitDetail ON unitDetail.id_detail=obat.unit_details
    WHERE DATE_FORMAT(tgl_pengeluaran,'%d-%m-%Y')='".$date."'  AND unit_details='".$unit_details."' and kategori='2'
    order by createdDate asc";
    $query = $this->db->query($sql);
    return $query;
}

// function getDataObatLangung($unit_details,$date)
// {
//     $sql = "SELECT * FROM simpus_resep_detail a
//     INNER JOIN simpus_master_obat b ON a.obat_id=b.OBAT_ID
//     WHERE DATE_FORMAT(tglPengeluaran,'%d-%m-%Y')='".$date."'  AND unit_details='".$unit_details."'
//     order by createdDate asc";
//     $query = $this->db->query($sql);
//     return $query;
// }

public function _get_datatables_obat_list()
{
   $this->db->select('OBAT_ID,KODE_OBAT,NAMA,TAHUN,SATUAN,SUMBER,HARGA,GOLONGAN,JENIS,AKTIF');
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
        $this->db->group_by('KODE_OBAT');

    }
    public function get_datatables_obat_list()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    public function count_filtered_obat_list()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_obat_list()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getMasterPenglangsung()
    {
      $K=$this->db->query("SELECT * FROM simpus_master_peng_langsung");
      foreach ($K->result_array() as $row)
      {
        $data[$row['uraian']] = $row['uraian'];
    }

    $K->free_result();
    return $data;
}
function getDataPengeluaranById($id_resep)
{
    $sql="SELECT sro.id_resep,DATE_FORMAT(sro.tgl_pengeluaran,'%d-%m-%Y') as tgl_keluar,sro.kode_resep,sro.unit_details,unit.nama_unit,namaPasien FROM simpus_resep_obat sro
   INNER JOIN data_master_unit_detail unit ON unit.id_detail=sro.unit_details
    WHERE sro.id_resep='".$id_resep."' ";
    $query=$this->db->query($sql);
    return $query;
}
function getDataPengeluaranDetail($id_resep)
{
    $sql="SELECT id_resep_detail,obat.KODE_OBAT,obat.NAMA as NAMA_OBAT,SATUAN,detail.jumlah,dosis_pakai,nama_pasien FROM simpus_resep_detail detail
    INNER JOIN simpus_master_obat obat ON  obat.OBAT_ID=detail.obat_id
    WHERE detail.resep_id='".$id_resep."' order by NAMA asc";
    $query=$this->db->query($sql);
    return $query;
}
function getDataResep($loketId)
{
    $sql="SELECT sro.id_resep,sro.kode_resep,sro.kategori,sro.nama_puyer,sro.jumlah_puyer,sro.dosis_pakai_puyer,sro.diambil as resepDilayani,lok.resep_diambil,pel.kdPoli,poli.nmPoli,nmDokter from simpus_resep_obat sro
    INNER JOIN simpus_loket lok on sro.loketId=lok.idLoket
    INNER JOIN simpus_pelayanan pel on pel.idpelayanan=sro.pelayananId
    INNER JOIN simpus_poli_fktp poli on poli.kdPoli=pel.kdPoli
    LEFT JOIN master_dokter md on md.kdDokter=pel.tenagaMedis
    WHERE lok.idLoket='".$loketId."' 
    ORDER BY sro.createdDate ASC";
    $query=$this->db->query($sql);
    return $query;
}
function getDataResepDetail($id_resep)
{
    $sql="SELECT KODE_OBAT,NAMA,SATUAN,srd.jumlah,srd.dosis_pakai,srd.id_resep_detail,cetak,waktu,tiapJam,kondisi FROM simpus_resep_detail srd 
    INNER JOIN simpus_master_obat obat on obat.OBAT_ID=srd.obat_id
    WHERE srd.resep_id='".$id_resep."' AND cetak='1' ORDER BY NAMA ASC";
    $query=$this->db->query($sql);
    return $query;
}
// function getDataTelaahResep($loketId)
// {
//     $sql="SELECT sl.idLoket,sl.tglKunjungan,sl.umur,sl.umur_bulan,sl.umur_hari,sp.JENIS_KLMIN as jenisKelamin,sp.NAMA_LGKP as namaPasien,sp.ALAMAT alamatPasien,sp.NIK,sp.noKartu,sp.NO_MR as nomorRekamMedis,sa.tinggiBadan,sa.beratBadan,kodeAlergiMakanan,kodeAlergiObat
//     FROM simpus_loket sl 
//     INNER JOIN simpus_pasien sp ON sp.ID=sl.pasienId
//     LEFT JOIN simpus_anamnesa sa ON sl.idLoket=sa.loketId
//     LEFT JOIN simpus_alergi_data sad ON sad.pasienId=sp.ID
//     LEFT JOIN simpus_telaah_resep str ON str.idLoket=sl.idLoket
//     WHERE sl.idLoket='".$loketId."'";
//     $query=$this->db->query($sql);
//     return $query;
// }
function get_data_resep_detail_by_id($id_resep_detail)
{
    $sql="SELECT a.id_resep_detail,b.obat_id,b.kode_obat,b.nama,jumlah,dosis_pakai,satuan,kondisi,waktu,tiapJam,keterangan FROM simpus_resep_detail a
    INNER JOIN simpus_master_obat b ON a.obat_id=b.OBAT_ID     
    WHERE a.id_resep_detail = '".$id_resep_detail."'";
    $query = $this->db->query($sql);
    return $query;
}
/* ---  LAPORAN --- */
function get_pemakaian($unit,$unit_details,$tgl_awal,$tgl_akhir)
{
  $tglAwal=date("Y-m-d", strtotime($tgl_awal));
  $tglAkhir=date("Y-m-d", strtotime($tgl_akhir));
  if($unit == '0')
  {
    $sqlunit = "lok.puskId= '".$this->getId()."'";
}
else
{
    if($unit_details == '0')
     $sqlunit="lok.puskId= '".$this->getId()."' and lok.kategoriUnitId = '".$unit."'";
 else
  $sqlunit = "lok.unitId='".$unit_details."' ";
}
$sql ="SELECT smo.KODE_OBAT,NAMA,IFNULL(SUM(spo.jumlah),0) AS jumlah,satuan
FROM simpus_resep_detail spo 
INNER JOIN simpus_resep_obat sro ON sro.id_resep=spo.resep_id
INNER JOIN simpus_loket lok ON lok.idLoket=sro.loketId
INNER JOIN simpus_master_obat smo ON smo.OBAT_ID=spo.obat_id
WHERE $sqlunit AND lok.tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."' 
GROUP BY smo.OBAT_ID ORDER BY NAMA ASC";
$query=$this->db->query($sql);
return $query;
}

function get_lap_register_pasien($unit,$unit_details,$tgl_awal,$tgl_akhir)
{
    $tglAwal=date("Y-m-d", strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d", strtotime($tgl_akhir));
    if($unit == '0')
    {
        $sqlunit = "lok.puskId= '".$this->getId()."'";
    }
    else
    {
     if($unit_details == '0')
       $sqlunit="lok.puskId= '".$this->getId()."' and lok.kategoriUnitId = '".$unit."'";
   else
      $sqlunit = "lok.unitId='".$unit_details."' ";
}

$sql="SELECT sro.loketId,lok.tglKunjungan,lok.noKartu,
GROUP_CONCAT(DISTINCT poli.nmPoli SEPARATOR ', ') poli,
GROUP_CONCAT(DISTINCT  CONCAT('(',sdd.kdDiagnosa,') ',sdd.nmDiagnosa) SEPARATOR ', ') diagnosa,
pas.NAMA_LGKP AS namaPasien,pas.ALAMAT,kec.NAMA_KEC,kel.NAMA_KEL
FROM simpus_loket lok 
INNER JOIN simpus_resep_obat sro ON lok.idLoket=sro.loketId
INNER JOIN simpus_pasien pas ON pas.ID=lok.pasienId
INNER JOIN simpus_pelayanan spn ON spn.loketId=lok.idLoket 
LEFT JOIN simpus_data_diagnosa sdd ON sdd.pelayananId=spn.idpelayanan
LEFT JOIN simpus_poli_fktp poli ON poli.kdPoli=spn.kdPoli
LEFT JOIN setup_kec kec ON kec.NO_KEC=pas.NO_KEC AND kec.NO_KAB = pas.NO_KAB AND kec.NO_PROP=pas.NO_PROP
LEFT JOIN setup_kel kel ON kel.NO_KEC=kec.NO_KEC AND kel.NO_KEL=pas.NO_KEL  AND kel.NO_KAB = pas.NO_KAB AND kel.NO_PROP=pas.NO_PROP
WHERE $sqlunit AND lok.tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."' 
GROUP BY lok.idLoket
order by tglKunjungan,NAMA_LGKP";
$query=$this->db->query($sql);
return $query;
}
function get_total_pasien($unit,$unit_details,$tgl_awal,$tgl_akhir)
{
  $tglAwal=date("Y-m-d", strtotime($tgl_awal));
  $tglAkhir=date("Y-m-d", strtotime($tgl_akhir));
  if($unit == '0')
  {
    $sqlunit = "lok.puskId= '".$this->getId()."'";
}
else
{
   if($unit_details == '0')
     $sqlunit="lok.puskId= '".$this->getId()."' and lok.kategoriUnitId = '".$unit."'";
 else
  $sqlunit = "lok.unitId='".$unit_details."' ";
}
$sql="SELECT SUM(IF(noKartu <> '',1,0)) jumlah_bpjs, SUM(IF(noKartu = '' OR noKartu='0' ,1,0)) jumlah_nonbpjs 
FROM (SELECT loketId,noKartu 
    FROM simpus_loket lok 
    INNER JOIN simpus_resep_obat sro ON lok.idLoket=sro.loketId
    WHERE $sqlunit AND lok.tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'  
    group by idLoket) a ";
    $query=$this->db->query($sql);
    return $query;
}
function get_total_lembar_resep($unit,$unit_details,$tgl_awal,$tgl_akhir)
{
    $tglAwal=date("Y-m-d", strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d", strtotime($tgl_akhir));
    if($unit == '0')
    {
        $sqlunit = "lok.puskId= '".$this->getId()."'";
    }
    else
    {
        if($unit_details == '0')
            $sqlunit="lok.puskId= '".$this->getId()."' and lok.kategoriUnitId = '".$unit."'";
        else
            $sqlunit = "lok.unitId='".$unit_details."' ";
    }
    $sql="
    SELECT COUNT(*) AS jumlah_resep FROM
    (SELECT id_resep FROM simpus_resep_obat sro 
        INNER JOIN simpus_loket lok ON lok.idLoket=sro.loketId 
         INNER JOIN simpus_pelayanan pel ON pel.idpelayanan=sro.pelayananId
        INNER JOIN simpus_resep_detail srd on srd.resep_id=sro.id_resep
        WHERE $sqlunit AND lok.tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."' 
        GROUP BY sro.pelayananId)a";
        $query=$this->db->query($sql);
        return $query;
    }
    function get_total_r_nonpuyer($unit,$unit_details,$tgl_awal,$tgl_akhir)
    {
        $tglAwal=date("Y-m-d", strtotime($tgl_awal));
        $tglAkhir=date("Y-m-d", strtotime($tgl_akhir));
        if($unit == '0')
        {
            $sqlunit = "lok.puskId= '".$this->getId()."'";
        }
        else
        {
            if($unit_details == '0')
                $sqlunit="lok.puskId= '".$this->getId()."' and lok.kategoriUnitId = '".$unit."'";
            else
                $sqlunit = "lok.unitId='".$unit_details."' ";
        }

        $sql="SELECT SUM(jumlah) jumlah_r_nonpuyer
        FROM (SELECT COUNT(id_resep_detail) AS jumlah FROM simpus_resep_obat sro 
        INNER JOIN simpus_loket lok ON lok.idLoket=sro.loketId 
        INNER JOIN simpus_pelayanan pel ON pel.idpelayanan=sro.pelayananId
        INNER JOIN simpus_resep_detail srd ON srd.resep_id=sro.id_resep
         WHERE $sqlunit AND lok.tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."' 
        AND sro.kategori='0'
        GROUP BY lok.idLoket) a";
        $query=$this->db->query($sql);
        return $query;
    }
    function get_total_r_puyer($unit,$unit_details,$tgl_awal,$tgl_akhir)
    {
        $tglAwal=date("Y-m-d", strtotime($tgl_awal));
        $tglAkhir=date("Y-m-d", strtotime($tgl_akhir));
        if($unit == '0')
        {
            $sqlunit = "lok.puskId= '".$this->getId()."'";
        }
        else
        {
            if($unit_details == '0')
                $sqlunit="lok.puskId= '".$this->getId()."' and lok.kategoriUnitId = '".$unit."'";
            else
                $sqlunit = "lok.unitId='".$unit_details."' ";
        }
        $sql="SELECT COUNT(*) jumlah_r_puyer FROM (
        SELECT sro.id_resep FROM simpus_resep_obat sro 
        INNER JOIN simpus_loket lok ON lok.idLoket=sro.loketId 
        INNER JOIN simpus_pelayanan pel ON pel.idpelayanan=sro.pelayananId
        INNER JOIN simpus_resep_detail srd ON srd.resep_id=sro.id_resep
        WHERE $sqlunit AND lok.tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."' 
        AND sro.kategori='1'
        GROUP BY sro.pelayananId)a";
        $query=$this->db->query($sql);
        return $query;
    }
    function get_lap_pengeluaran_langsung($unit,$unit_details,$tgl_awal,$tgl_akhir)
    {
        $tglAwal=date("Y-m-d", strtotime($tgl_awal));
        $tglAkhir=date("Y-m-d", strtotime($tgl_akhir));

        if($unit == '0')
        {
            $sqlunit = "";
        }
        else
        {
            if($unit_details == '0')
                $sqlunit="dmu.id_kategori='".$unit."'";
            else
                $sqlunit = "sro.unit_details='".$unit_details."' ";
        }

        $sql="SELECT sro.tgl_pengeluaran,srd.obat_id,obat.KODE_OBAT,obat.NAMA,obat.SATUAN,SUM(srd.jumlah) AS jumlah
         FROM simpus_resep_obat sro 
            INNER JOIN simpus_resep_detail srd ON srd.resep_id=sro.id_resep
            INNER JOIN simpus_master_obat obat ON obat.OBAT_ID=srd.obat_id
            INNER JOIN `data_master_unit_detail`dmud ON dmud.`id_detail`=sro.`unit_details`
            INNER JOIN `data_master_unit` dmu ON dmu.`id_kategori`=dmud.id_kategori
            WHERE $sqlunit and sro.tgl_pengeluaran BETWEEN'".$tglAwal."' AND '".$tglAkhir."'  GROUP BY srd.obat_id";
        $query=$this->db->query($sql);
        return $query;
    }
    function get_lap_pengeluaran_harian($unit,$unit_details,$bulan,$tahun)
    {
      
     $day = $bulan == 2 ? ($tahun % 4 ? 28 : ($tahun % 100 ? 29 : ($tahun % 400 ? 28 : 29))) : (($bulan - 1) % 7 % 2 ? 30 : 31);

        if($unit == '0')
        {
            $sqlunit = "";
        }
        else
        {
            if(($unit_details == '0' && $unit=='1') || ($unit_details != '0' && $unit=='1'))
            {
                $sqlunit="((lok.puskId= '".$this->getId()."' and lok.kategoriUnitId = '".$unit."') or sro.unit_details = '".$this->getId()."') AND";
            }
            else if($unit_details == '0' && $unit !='1')
            {
                $sqlunit="(lok.puskId= '".$this->getId()."' and lok.kategoriUnitId = '".$unit."') AND";
            }
            else
            {
                $sqlunit = "(lok.unitId='".$unit_details."') AND";
            }
        }
    $sql="SELECT obat_id,KODE_OBAT,NAMA,SATUAN,";

        for ($x = 1; $x <= $day; $x++) {
           $sql.="sum(keluar_".$x.") as keluar_".$x.",";
       };
    $sql.="sum(jumlah_total) as jumlah_total from 
       (SELECT lok.tglKunjungan,obat.obat_id,obat.KODE_OBAT,obat.NAMA,obat.SATUAN,";

       for ($x = 1; $x <= $day; $x++) {
        $sql.="CASE WHEN (tglKunjungan = '".$tahun."-".$bulan."-".$this->fungsi->complete($x,"2")."' OR tgl_pengeluaran = '".$tahun."-".$bulan."-".$this->fungsi->complete($x,"2")."') THEN SUM(jumlah) END AS keluar_".$x.",";
        };

    $sql.="CASE WHEN ((MONTH(tglKunjungan) = '".$bulan."' AND YEAR(tglKunjungan) = '".$tahun."') OR (MONTH(tgl_pengeluaran) = '".$bulan."' AND YEAR(tgl_pengeluaran) = '".$tahun."')) THEN SUM(jumlah) END AS jumlah_total
    FROM simpus_resep_obat sro 
    INNER JOIN simpus_resep_detail srd ON sro.id_resep=srd.resep_id
    INNER JOIN simpus_master_obat obat ON obat.OBAT_ID=srd.obat_id
    LEFT JOIN simpus_loket lok ON lok.idLoket=sro.loketId
    WHERE $sqlunit  ((MONTH(lok.tglKunjungan)='".$bulan."' AND YEAR(lok.tglKunjungan)='".$tahun."') OR (MONTH(tgl_pengeluaran) = '".$bulan."' AND YEAR(tgl_pengeluaran) = '".$tahun."'))
    and srd.cetak='1' GROUP BY obat.obat_id,tglKunjungan,tgl_pengeluaran ORDER BY nama)a  GROUP BY obat_id ORDER BY nama
    ";
    $query=$this->db->query($sql);
        return $query;
    }

//===============================================================================================================
}



