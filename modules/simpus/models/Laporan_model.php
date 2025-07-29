<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

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

   public function get_filter_lap($unit,$unit_details,$tgl_awal,$tgl_akhir,$asal,$kec,$kel,$poli,$kunj,$jenis_kel,$no_kartu,$jkn,$kasus,$diag,$tinda,$nama,$umur1,$umur2,$rujlan,$isiDi)
   {
    if($this->getId() != '46')
      $idpkm =" AND sl.`puskId`='".$this->getId()."' ";
    else
      $idpkm = '';

    $tglAwal=date("Y-m-d",strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

    if($unit_details == '0')
      $unit_details_x = "";
    else
      $unit_details_x = "AND sl.`unitId`= '".$unit_details."'";

        // if($kel == '0')
        //  $desa = "";
        // else
        //  $desa = "AND sp.no_kel = '".$kel."'";

        //code unit
    if($unit =='0')
      $unitx = '';
    else
      $unitx = "AND dmu.id_kategori='".$unit."'";

    if($asal =='0')
      $asalx = '';
    elseif($asal =='1')
      $asalx = "AND sl.`wilayah`='1'";
    elseif($asal =='2')
      $asalx = "AND sl.`wilayah`='2'";
    elseif($asal =='3')
      $asalx = "AND (sl.`wilayah`='3' OR sp.`NO_KAB` <> '10')";

    if($kec =='0')
      $kecx = '';
    else
      $kecx = "AND kec.`NO_KEC`='".$kec."'";

    if($rujlan =='0')
      $rujlanx = '';
    else
      $rujlanx = "AND srl.`kdppk`='".$rujlan."'";

    if($kel =='0')
      $kelx = '';
    else
      $kelx = "AND kel.`NO_KEL`='".$kel."'";

    if($umur1 =='u')
      $umur1x = '';
    else
      $umur1x = "AND sl.`umur` BETWEEN'".$umur1."'";

    if($umur2 =='u')
      $umur2x = '';
    else
      $umur2x = "AND '".$umur2."'";

    if($poli =='0'){
      $polix = '';
      $getDiagdll="LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
        left join simpus_tindakan st on st.`idPelayanan`=spn.`idpelayanan`
        left join simpus_pakai_obat po on po.`pelayananId`=spn.`idpelayanan`";
    }
    else{
      $polix = "AND spn.`kdPoli`='".$poli."'";
       if($poli=='098'){
        $getDiagdll="LEFT JOIN simpus_data_diagnosa sdd ON sdd.`loketId`=sl.`idLoket`
        left join simpus_tindakan st on st.`loketId`=sl.`idLoket`
        left join simpus_pakai_obat po on po.`loketId`=sl.`idLoket`";
      }else{
        $getDiagdll="LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
        left join simpus_tindakan st on st.`idPelayanan`=spn.`idpelayanan`
        left join simpus_pakai_obat po on po.`pelayananId`=spn.`idpelayanan`";
      }
    }
    if($kunj =='0')
      $kunjx = '';
    else
      $kunjx = "AND sl.`kunjBaru`='".$kunj."'";

    if($nama =='0'){
      $namax = '';
    }
    else{
      $nama = str_replace("%20"," ",$nama);
      $namax = "AND MATCH(sp.`NAMA_LGKP`) AGAINST ('+\"".$nama."\"' IN BOOLEAN MODE)";
    }
    if($jenis_kel =='0')
      $jenis_kelx = '';
    else
      $jenis_kelx = "AND sp.`JENIS_KLMIN`='".$jenis_kel."'";

    if($no_kartu =='false')
      $no_kartux = "AND sl.`noKartu`=' '";
    else if($no_kartu =='true')
      $no_kartux = "AND sl.`noKartu` >= 1 ";
    else
      $no_kartux = '';

    if($jkn =='0')
      $jknx = '';
    else
      $jknx = "AND sl.`jknPbi`='".$jkn."' ";

    if($kasus =='0')
      $kasusx = '';
    else
      $kasusx = "AND sdd.`diagnosaKasus`='".$kasus."'";

    if($diag =='0')
      $diagx = '';
    else
      $diagx = "AND sdd.`kdDiagnosa`='".$diag."'";

    if($tinda =='0') 
      $tindax = '';
    else
      $tindax = "AND st.`kdTindakan`='".$tinda."'";

    if($isiDi =='0') 
      $isiDix = '';
    else
      $isiDix = "AND sl.`kunjSakit`='true' AND (sdd.`kdDiagnosa` is null OR sdd.`kdDiagnosa` = '')";

    $sql="SELECT sl.`tglKunjungan`,sl.jknPbi,spn.`kdPoli`,spf.`nmPoli`,spn.`tujuanPoli`,spf2.`nmPoli` AS nmTujuanPoli,sp.`NIK`,sp.`NAMA_LGKP`,sp.NO_MR,sp.`ALAMAT`,sp.`NO_RT`,sp.`NO_RW`,kel.`NAMA_KEL`,kec.`NAMA_KEC`,
    IF(sp.`JENIS_KLMIN`='1','L','P') AS sex, DATE_FORMAT(sp.`TGL_LHR`,'%d-%m-%Y') AS tglLahir,sl.`umur`,mku.`kel_umur`,IF(sl.`noKartu`!='','BPJS','NON BPJS') AS kategori_pasien,
    IF(sl.`kunjBaru`='true','BARU','LAMA') AS status_kunj ,COUNT(po.`pelayananId`) AS jmlObat,
    GROUP_CONCAT(DISTINCT  concat('(',sdd.kdDiagnosa,') ',sdd.`nmDiagnosa`) separator ', ') diagnosa,
    GROUP_CONCAT(DISTINCT CONCAT(mo.`NAMA`,' ','(',rd.`jumlah`,' ',rd.`dosis_pakai`,')') SEPARATOR ', ') obatList, msd.`kasus` AS kasusDiagnosa, 
    GROUP_CONCAT(DISTINCT st.`nmTindakan` SEPARATOR ', ') tindakan,nilaiLab,GROUP_CONCAT(DISTINCT CONCAT (po.`nama_obat`,' (',po.`jumlah`,')') SEPARATOR ', ') nmObat, prv.`nmProvider`,prv.`nmProvider` AS nama_faskes_pasien,prvrujuk.`nmProvider` AS nama_faskes_rujukan,sistole,diastole,suhu,beratBadan,tinggiBadan,lingkarPerut,imtKet,respRate,heartRate,sa.keluhan as catatanAnamnesa
    FROM simpus_loket sl 
    INNER JOIN simpus_pasien sp ON sp.`ID`=sl.`pasienId` 
    INNER JOIN master_kel_umur mku ON mku.`id_kel_umur`=sl.`kelUmur` 
    inner JOIN simpus_pelayanan spn ON spn.`loketId`=sl.`idLoket` 
    LEFT JOIN simpus_poli_fktp spf ON spn.`kdPoli`=spf.`kdPoli`
    LEFT JOIN simpus_anamnesa sa ON sa.loketId=sl.idLoket
  
    LEFT JOIN simpus_poli_fktp spf2 ON spn.`tujuanPoli`=spf2.`kdPoli`
    LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
    LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP` 
    LEFT JOIN simpus_provider prv ON prv.`kdProvider`=sp.`kdProvider`
    #newadd 
     LEFT JOIN simpus_resep_obat ro ON ro.`loketId`=sl.`idLoket`
    LEFT JOIN simpus_resep_detail rd ON rd.`resep_id`=ro.`id_resep`
    LEFT JOIN simpus_master_obat mo ON mo.`OBAT_ID`=rd.`obat_id`
    LEFT JOIN simpus_rujuk_lanjut srl ON srl.`loketID`=sl.`idLoket` 
    LEFT JOIN simpus_subspesialis sss ON srl.`kdSubSpesialis`=sss.`kdSubSpesialis` 
    LEFT JOIN simpus_spesialis ss ON ss.`kdSpesialis`=sss.`kdSpesialis` 
    LEFT JOIN simpus_statuspulang stp ON stp.`kdStatusPulang`=spn.`kdStatusPulang` 
    LEFT JOIN simpus_provider prvrujuk ON prvrujuk.`kdProvider`=srl.`kdppk` 
    LEFT JOIN simpus_poli_fktl fktl ON fktl.`kdPoli`=srl.`kdPoliRujLan`

#code unit 
    INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=sl.`unitId` 
    INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
    $getDiagdll
    LEFT JOIN master_diagnosa_kasus msd on msd.id=sdd.diagnosaKasus
     
    WHERE 
    sl.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    $unitx
    $idpkm
    $unit_details_x
    $asalx
    $rujlanx
    $kecx
    $kelx
    $polix
    $kunjx
    $jenis_kelx
    $no_kartux
    $jknx
    $kasusx
    $diagx
    $tindax
    $namax
    $isiDix
    $umur1x $umur2x
    GROUP BY spn.`idpelayanan`
    ORDER BY DAY(sl.`tglKunjungan`) ASC
    ";
    $query=$this->db->query($sql);
//echo $this->db->last_query();
    return $query;
  }

  public function lapRawatJalanPoli($unit,$unit_details,$tgl_awal,$tgl_akhir,$diagnosa,$pol)
  {
    if($this->getId() != '46')
      $idpkm =" AND lok.`puskId`='".$this->getId()."' ";
    else
      $idpkm = '';

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

    $sql="SELECT lok.`idLoket`,lok.`tglKunjungan`,sp.`NO_MR`,sp.`noKartu`,sp.`NIK`,sp.`NAMA_LGKP`,lok.`umur`, kel.`NAMA_KEL`,sp.`NO_RT`,sp.`NO_RW`,kec.`NAMA_KEC`,sadar.`nmSadar`,IF(sp.`JENIS_KLMIN`='1','L','P') jnis_kel,sp.`ALAMAT`,sa.`terapi`,IF (sp.`noKartu`!='','BPJS','NON BPJS') kategori,
    sa.`sistole`,sa.`diastole`,sa.`respRate`,sa.`heartRate`,sa.`catatan`,GROUP_CONCAT(DISTINCT CONCAT('(',sdd.`kdDiagnosa`,') ',sdd.`nmDiagnosa`) SEPARATOR ', ') diagnosa, 
    ro.nama_puyer,
  GROUP_CONCAT(DISTINCT CONCAT(mo.`NAMA`,' ','(',rd.`jumlah`,' ',rd.`dosis_pakai`,')') SEPARATOR ', ') obatList,
  GROUP_CONCAT(DISTINCT CONCAT('(',st.`kdTindakan`,') ',st.`nmTindakan`) SEPARATOR ', ') tindakan,
  GROUP_CONCAT(DISTINCT CONCAT(po.`nama_obat`,' ',po.`dosis_pakai`) SEPARATOR ', ') obat,IF (lok.`kunjBaru`='true','baru','lama') kasus,lok.`keluhan` as keluhan_loket,sa.keluhan,sa.keluhanTambahan,
    srl.`jnsRujukLanjut`,srl.`nmppk`,sss.`nmSubSpesialis`,ss.`nmSpesialis`,stp.`nmStatusPulang`,spn.`tujuanPoli`,prv.`nmProvider`,fktl.`nmPoli` AS nmRujLan
    FROM simpus_loket lok
    INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
    inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_anamnesa sa ON sa.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_kesadaran sadar ON sadar.`kdSadar`=sa.`kdSadar`
    LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
    LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP` 
    LEFT JOIN simpus_data_diagnosa sdd ON sdd.`loketId`=spn.`loketId`
    left join simpus_tindakan st on st.`loketId`=spn.`loketId`
    LEFT JOIN simpus_pakai_obat po ON po.`loketId`=spn.`loketId`
  #newadd
  LEFT JOIN simpus_resep_obat ro ON ro.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_resep_detail rd ON rd.`resep_id`=ro.`id_resep`
    LEFT JOIN simpus_master_obat mo ON mo.`OBAT_ID`=rd.`obat_id`
    LEFT JOIN simpus_rujuk_lanjut srl ON srl.`loketID`=lok.`idLoket`
    LEFT JOIN simpus_subspesialis sss ON srl.`kdSubSpesialis`=sss.`kdSubSpesialis`
    LEFT JOIN simpus_spesialis ss ON ss.`kdSpesialis`=sss.`kdSpesialis`
    LEFT JOIN simpus_statuspulang stp ON stp.`kdStatusPulang`=spn.`kdStatusPulang`
    LEFT JOIN simpus_provider prv ON prv.`kdProvider`=srl.`kdppk`
    LEFT JOIN simpus_poli_fktl fktl ON fktl.`kdPoli`=srl.`kdPoliRujLan`

#code unit
    INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
    INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

    WHERE 
    spn.`kdPoli`='".$pol."'

  # AND sdd.`kdDiagnosa` NOT LIKE 'K%'
  #AND sdd.`kdDiagnosa` NOT LIKE 'P%'
  # AND sdd.`kdDiagnosa` NOT LIKE 'O%'
  #AND sdd.`nmDiagnosa` NOT LIKE '%pregnan%'

    AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    AND rd.cetak='1'
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

  public function lapRaJalPoli($unit,$unit_details,$tgl_awal,$tgl_akhir,$diagnosa,$pusk,$pol)
  {
    if($pusk=='0')
      $idpkm ='';
    else
      $idpkm = " AND lok.`puskId`='".$pusk."' ";

  // if($this->getId() != '46')
  //   $idpkm =" AND lok.`puskId`='".$this->getId()."' ";
  // else
  //   $idpkm = '';

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

    $sql="SELECT lok.`idLoket`,lok.`tglKunjungan`,sp.`NO_MR`,sp.`noKartu`,sp.`NIK`,sp.`NAMA_LGKP`,lok.`umur`, kel.`NAMA_KEL`,sp.`NO_RT`,sp.`NO_RW`,kec.`NAMA_KEC`,sadar.`nmSadar`,IF(sp.`JENIS_KLMIN`='1','L','P') jnis_kel,sp.`ALAMAT`,sa.`terapi`,IF (sp.`noKartu`!='','BPJS','NON BPJS') kategori,
    sa.`sistole`,sa.`diastole`,sa.`respRate`,sa.`heartRate`,sa.`catatan`,GROUP_CONCAT(DISTINCT CONCAT('(',sdd.`kdDiagnosa`,') ',sdd.`nmDiagnosa`) SEPARATOR ', ') diagnosa, GROUP_CONCAT(DISTINCT CONCAT('(',st.`kdTindakan`,') ',st.`nmTindakan`) SEPARATOR ', ') tindakan,
    ro.nama_puyer,
  GROUP_CONCAT(DISTINCT CONCAT(mo.`NAMA`,' ','(',rd.`jumlah`,' ',rd.`dosis_pakai`,')') SEPARATOR ', ') obatList,
    IF (lok.`kunjBaru`='true','baru','lama') kasus,sa.`keluhan`,sa.keluhanTambahan,
    srl.`jnsRujukLanjut`,srl.`nmppk`,sss.`nmSubSpesialis`,ss.`nmSpesialis`,stp.`nmStatusPulang`,spn.`tujuanPoli`,prv.`nmProvider`,fktl.`nmPoli` AS nmRujLan
    FROM simpus_loket lok
    INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
    inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_anamnesa sa ON sa.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_kesadaran sadar ON sadar.`kdSadar`=sa.`kdSadar`
    LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
    LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP` 
    LEFT JOIN simpus_data_diagnosa sdd ON sdd.`loketId`=spn.`loketId`
    left join simpus_tindakan st on st.`loketId`=spn.`loketId`
    LEFT JOIN simpus_pakai_obat po ON po.`loketId`=spn.`loketId`
  #newadd
    LEFT JOIN simpus_resep_obat ro ON ro.`loketId`=lok.`idLoket`
    LEFT JOIN simpus_resep_detail rd ON rd.`resep_id`=ro.`id_resep`
    LEFT JOIN simpus_master_obat mo ON mo.`OBAT_ID`=rd.`obat_id`
    LEFT JOIN simpus_rujuk_lanjut srl ON srl.`loketID`=lok.`idLoket`
    LEFT JOIN simpus_subspesialis sss ON srl.`kdSubSpesialis`=sss.`kdSubSpesialis`
    LEFT JOIN simpus_spesialis ss ON ss.`kdSpesialis`=sss.`kdSpesialis`
    LEFT JOIN simpus_statuspulang stp ON stp.`kdStatusPulang`=spn.`kdStatusPulang`
    LEFT JOIN simpus_provider prv ON prv.`kdProvider`=srl.`kdppk`
    LEFT JOIN simpus_poli_fktl fktl ON fktl.`kdPoli`=srl.`kdPoliRujLan`

#code unit
    INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
    INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

    WHERE 
    spn.`kdPoli`='".$pol."'

  # AND sdd.`kdDiagnosa` NOT LIKE 'K%'
  #AND sdd.`kdDiagnosa` NOT LIKE 'P%'
  # AND sdd.`kdDiagnosa` NOT LIKE 'O%'
  #AND sdd.`nmDiagnosa` NOT LIKE '%pregnan%'

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


}

