<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools_model extends CI_Model {

    public function getId()
    {
       $user_id = $this->session->userdata('user_id');
       $this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
       return $this->id;

   }

   public function getNamaKosong()
   {
    if($this->getId() != '46')
        $idpkm =" AND sp.PUSK_ID='".$this->getId()."' ";
    else
        $idpkm = '';

    // $sql="SELECT sp.ID,lok.idLoket as cekid,2020 as tahun,sp.NO_MR,sp.NIK,sp.NAMA_LGKP,IF(sp.JENIS_KLMIN='1','L','P') AS sex,sp.ALAMAT,sp.NO_RT,sp.NO_RW,kel.NAMA_KEL,kec.NAMA_KEC
    // FROM simpus_pasien sp
    // inner JOIN simpus_loket lok ON lok.pasienId=sp.ID
    // LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP
    // LEFT JOIN setup_kel kel ON kel.NO_KEC=kec.NO_KEC AND kel.NO_KEL=sp.NO_KEL 
    // AND kel.NO_KAB = sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP
    // WHERE sp.NAMA_LGKP=''
    // GROUP BY sp.ID
    // $idpkm LIMIT 10
    // UNION all
    // SELECT sp.ID,sk.id as cekid,2019 as tahun ,sp.NO_MR,sp.NIK,sp.NAMA_LGKP,IF(sp.JENIS_KLMIN='1','L','P') AS sex,sp.ALAMAT,sp.NO_RT,sp.NO_RW,kel.NAMA_KEL,kec.NAMA_KEC
    // FROM simpus_pasien sp
    // inner JOIN simpus_kunjungan sk ON sk.pasien_id=sp.ID
    // LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP
    // LEFT JOIN setup_kel kel ON kel.NO_KEC=kec.NO_KEC AND kel.NO_KEL=sp.NO_KEL 
    // AND kel.NO_KAB = sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP
    // WHERE sp.NAMA_LGKP=''
    // GROUP BY sp.ID
    // $idpkm LIMIT 10
    // ";
    $sql="SELECT * FROM simpus_pasien sp where sp.NAMA_LGKP='' AND sp.ACTIVE='1'
    $idpkm limit 100";
    $query=$this->db->query($sql);
       // echo $this->db->last_query();
    return $query;
}

public function getNikKosong()
{
    if($this->getId() != '46')
        $idpkm =" AND sp.PUSK_ID='".$this->getId()."' ";
    else
        $idpkm = '';

   // $sql="SELECT lok.idLoket as cekid,2020 as tahun,sp.NO_MR,sp.NIK,sp.NAMA_LGKP,IF(sp.JENIS_KLMIN='1','L','P') AS sex,sp.ALAMAT,sp.NO_RT,sp.NO_RW,kel.NAMA_KEL,kec.NAMA_KEC
   //  FROM simpus_pasien sp
   //  LEFT JOIN simpus_loket lok ON lok.pasienId=sp.ID
   //  LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP
   //  LEFT JOIN setup_kel kel ON kel.NO_KEC=kec.NO_KEC AND kel.NO_KEL=sp.NO_KEL 
   //  AND kel.NO_KAB = sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP
   //  WHERE sp.NIK='' 
   //  $idpkm 
   //  GROUP BY sp.NO_MR 
   //  LIMIT 20
   //  UNION all
   //  SELECT sk.id as cekid,2019 as tahun ,sp.NO_MR,sp.NIK,sp.NAMA_LGKP,IF(sp.JENIS_KLMIN='1','L','P') AS sex,sp.ALAMAT,sp.NO_RT,sp.NO_RW,kel.NAMA_KEL,kec.NAMA_KEC
   //  FROM simpus_pasien sp
   //  LEFT JOIN simpus_kunjungan sk ON sk.pasien_id=sp.ID
   //  LEFT JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP
   //  LEFT JOIN setup_kel kel ON kel.NO_KEC=kec.NO_KEC AND kel.NO_KEL=sp.NO_KEL 
   //  AND kel.NO_KAB = sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP
   //  WHERE sp.NIK='' 
   //  $idpkm 
   //  GROUP BY sp.NO_MR 
   //  LIMIT 20
   //  ";

    $sql="SELECT * FROM simpus_pasien sp where sp.NIK='' AND sp.ACTIVE='1'
    $idpkm limit 100";
    $query=$this->db->query($sql);
    //echo $this->db->last_query();
    return $query;
}

public function getNoMRDouble()
{
    if($this->getId() != '46')
        $idpkm ="AND sp.PUSK_ID='".$this->getId()."' ";
    else
        $idpkm = '';


    $sql="SELECT sp.NO_MR,COUNT(sp.NO_MR) AS jumlah FROM simpus_pasien sp

    WHERE
    sp.ACTIVE='1'
    $idpkm

    GROUP BY sp.NO_MR 
    HAVING COUNT(sp.NO_MR) > 1 limit 100
    ";
    $query=$this->db->query($sql);
        //echo $this->db->last_query();
    return $query;
}

public function getNoMrData($nomr)
{
    if($this->getId() != '46')
        $idpkm ="AND sp.PUSK_ID='".$this->getId()."' ";
    else
        $idpkm = '';


    $sql="SELECT * FROM simpus_pasien sp

    WHERE
    sp.NO_MR='".$nomr."' 
    ";
    $query=$this->db->query($sql);
        //echo $this->db->last_query();
    return $query;
}

public function getNikDouble()
{
   if($this->getId() != '46')
    $idpkm ="AND sp.PUSK_ID='".$this->getId()."' ";
else
    $idpkm = '';


$sql="SELECT sp.NIK,COUNT(sp.NIK) AS jumlah FROM simpus_pasien sp

WHERE
sp.NIK != '' AND sp.ACTIVE='1'
$idpkm

GROUP BY sp.NIK 
HAVING COUNT(sp.NIK) > 1 limit 100
";
$query=$this->db->query($sql);
        //echo $this->db->last_query();
return $query;
}

public function getNikData($nik)
{
    if($this->getId() != '46')
        $idpkm ="sp.PUSK_ID='".$this->getId()."' ";
    else
        $idpkm = '';

    $sql="SELECT * FROM simpus_pasien sp

    WHERE
    sp.NIK='".$nik."' 
    ";
    $query=$this->db->query($sql);
        //echo $this->db->last_query();
    return $query;
}

public function getNikDoubleAll()
{
    $sql="SELECT sp.NIK,COUNT(sp.NIK) AS jumlah FROM simpus_pasien sp

    WHERE
    sp.NIK != '' AND sp.ACTIVE='1'

    GROUP BY sp.NIK 
    HAVING COUNT(sp.NIK) > 1
    ";
    $query=$this->db->query($sql);
        //echo $this->db->last_query();
    return $query;
}
public function getNoMrKosong()
{
  
    $sql="SELECT sp.* FROM simpus_pasien sp WHERE  sp.PUSK_ID='".$this->getId()."' and sp.NO_MR IS NULL";
    $query=$this->db->query($sql);
    return $query;
}


public function getJmlh($NO_MR)
{
    if($this->getId() != '46')
        $idpkm =" AND sp.PUSK_ID='".$this->getId()."' ";
    else
        $idpkm = '';

    $sql="SELECT COUNT(spn.idpelayanan) AS jmlah FROM simpus_loket lok 
    INNER JOIN simpus_pasien sp ON sp.ID=lok.pasienId
    inner JOIN simpus_pelayanan spn ON spn.loketId=lok.idLoket
    WHERE sp.NO_MR='".$NO_MR."'
    $idpkm
    ";
    $query=$this->db->query($sql);
        //echo $this->db->last_query();
    return $query;
}

// 5
public function getCekData()
{
    if($this->getId() != '46')
        $idpkm =" AND sk.puskId='".$this->getId()."' ";
    else
        $idpkm = '';


    $sql="SELECT pol.nmPoli,sk.idLoket,sk.pasienId,DATE_FORMAT(sk.tglKunjungan,'%d-%m-%Y') AS tgl_kunjung,sp.NAMA_LGKP,sp.NIK,sp.ALAMAT,kec.NAMA_KEC,kel.NAMA_KEL,sp.NO_MR,sp.noKartu,sk.kelUmur,sk.UMUR,sp.JENIS_KLMIN, sk.kdPoli,spn.tujuanPoli,sk.kunjBaru,wilayah,kunjSakit,sp.NO_PROP,sp.NO_KAB,sp.NO_KEC,sp.NO_KEL,dmu.kategori,dmud.nama_unit
    FROM simpus_loket sk
    INNER JOIN simpus_pasien sp ON sp.ID=sk.pasienId
    inner JOIN simpus_pelayanan spn ON spn.loketId=sk.idLoket
    left JOIN setup_kec kec ON kec.NO_KEC=sp.NO_KEC and kec.NO_KAB = sp.NO_KAB and kec.NO_PROP=sp.NO_PROP
    left JOIN setup_kel kel ON kel.NO_KEC=kec.NO_KEC AND kel.NO_KEL=sp.NO_KEL
    and kel.NO_KAB = sp.NO_KAB and kel.NO_PROP=sp.NO_PROP
    left join simpus_poli_fktp pol on pol.kdPoli=spn.kdPoli
        #code unit
    left JOIN data_master_unit_detail dmud on dmud.id_detail=sk.unitId
    left join data_master_unit dmu on dmu.id_kategori=dmud.id_kategori

    WHERE
    (sk.kunjSakit = '' OR sp.JENIS_KLMIN = '' OR sp.NO_KAB='' OR sp.NO_PROP='' OR sp.NO_KEC='' OR sp.NO_KEL='' or sk.wilayah=''
        OR sk.kunjSakit IS NULL OR sp.JENIS_KLMIN IS NULL OR sp.NO_KAB IS NULL OR sp.NO_PROP IS NULL OR sp.NO_KEC IS NULL OR sp.NO_KEL IS NULL or sk.wilayah IS NULL or
        sk.kunjSakit = '0' OR sp.JENIS_KLMIN = '0' OR sp.NO_KAB='0' OR sp.NO_PROP='0' OR sp.NO_KEC='0' OR sp.NO_KEL='0' or sk.wilayah='0' AND sp.ACTIVE='1' OR (sk.unitId='' or sk.unitId is NULL)) 
    $idpkm order by sk.tglKunjungan desc
    limit 100
    ";
    $query=$this->db->query($sql);
       // echo $this->db->last_query();
    return $query;
}

    // 5
public function getCekPel()
{
    if($this->getId() != '46')
        $idpkm =" AND sk.puskId='".$this->getId()."' ";
    else
        $idpkm = '';


    $sql="SELECT pol.nmPoli,sk.idLoket,sk.pasienId,DATE_FORMAT(sk.tglKunjungan,'%d-%m-%Y') AS tgl_kunjung,
    sp.NAMA_LGKP,sp.NIK,sp.ALAMAT,
    sp.NO_MR,sp.noKartu,sk.kelUmur,sk.UMUR,sp.JENIS_KLMIN, 
    sk.kdPoli,sk.kunjBaru,wilayah,kunjSakit,dmu.kategori,dmud.nama_unit,diag.kdDiagnosa,pel.idpelayanan
    FROM simpus_loket sk
    INNER JOIN simpus_pasien sp ON sp.ID=sk.pasienId
    LEFT JOIN simpus_poli_fktp pol ON pol.kdPoli=sk.kdPoli
    LEFT JOIN simpus_data_diagnosa diag ON sk.idLoket=diag.loketId 
    LEFT JOIN simpus_diagnosa diagnosa ON diagnosa.`kdDiag`=diag.`kdDiagnosa`
    LEFT JOIN data_master_unit_detail dmud ON dmud.id_detail=sk.unitId
    LEFT JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
    INNER JOIN simpus_pelayanan pel ON pel.loketId=sk.idLoket
    WHERE 
    (diag.kdDiagnosa = '' OR diag.kdDiagnosa IS NULL) AND sk.kunjSakit='true' AND pel.pelIdSebelum=0
     #AND diagnosa.`kategori`='0'
    $idpkm order by sk.kdPoli desc
    limit 1000
    ";
    $query=$this->db->query($sql);
       // echo $this->db->last_query();
    return $query;
}
public function getLogDel()
{
    $user_id = $this->session->userdata('user_id');
    $pusk_id = $this->db->query("select * from users where id='".$user_id."'")->row('unit');

    if($this->getId() != '46')
        $user = "and puskid='".$pusk_id."' ";
    else
        $user = '';

    $sql = "select nama_unit,logloket.id,deleteBy,(deleteDate) as tgl_hapus,pasien.NAMA_LGKP,polisakit,poli.nmPoli,puskid
    from log_loket_deletelogloket
    inner join simpus_pasien pasien on pasien.ID=logloket.pasienId
    left join simpus_poli_fktp poli on poli.kdPoli=logloket.kdPoli
    INNER JOIN unit_profiles up ON up.unit_id=logloket.puskId
    where puskid <> ''  $user order by nama_unit,tgl_hapus;";
    $query = $this->db->query($sql);
    return $query;
}
public function getDiagKlb()
{
    $tahun=date('Y', strtotime('NOW'));
    if($this->getId() != '46')
        $idpkm ="sl.puskId='".$this->getId()."' AND";
    else
        $idpkm = '';

    $sql = "SELECT sl.idLoket,tglKunjungan,sp.NAMA_LGKP AS nama,sp.ALAMAT AS alamat,sd.kdDiag,sd.nmDiag,diagnosaKasus,REPLACE(nama_unit,'PUSKESMAS ','') as nama_unit,klb_kategori
    FROM simpus_data_diagnosa sdd
    INNER JOIN simpus_diagnosa sd ON sd.kdDiag=sdd.kdDiagnosa
    INNER JOIN simpus_loket sl ON sdd.loketId=sl.idLoket
    INNER JOIN simpus_pasien sp ON sl.pasienId=sp.ID
    inner JOIN unit_profiles up on up.unit_id=sl.puskId
    WHERE 
    YEAR(sl.tglKunjungan) = '".$tahun."'
    AND ".$idpkm."
    sd.klb='1' AND diagnosaKasus='3'
    GROUP BY sl.idLoket
    ORDER BY sl.tglKunjungan ASC,sl.puskId ASC;";

    $query = $this->db->query($sql);
    return $query;
}


}

