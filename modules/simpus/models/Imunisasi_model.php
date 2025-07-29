<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imunisasi_model extends CI_Model {

    function getDataImunisasi($idLoket)
   {
    $this->db->select('a.*,b.*');
    $this->db->join('master_imunisasi_vaksin AS b', 'a.id_imunisasi=b.id_imunisasi','left');
    $this->db->where('loketId',$idLoket);
    return $this->db->get('simpus_imunisasi_vaksin AS a');
   }

    ////=================================================================================================================
    //                                              LAPORAN - LAPORAN
    ////=================================================================================================================
    // 1
    public function get_lap_reg_san($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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
        spn.`idpelayanan`,lok.`tglKunjungan`,sp.`NAMA_LGKP`,sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,
        lok.`kelUmur`,lok.`umur`,sp.`JENIS_KLMIN`,san.`tindakanSaran`,san.`hasilWawancara`,san.`interfeksi`,

        CASE 
        WHEN(san.`keluargaBinaan`=1) THEN 'Ya'
        WHEN(san.`keluargaBinaan`=0) THEN 'Tidak'
        ELSE ' '
        END AS kBinaan,

        CASE 
        WHEN(san.`keluargaRisti`=1) THEN 'Ya'
        WHEN(san.`keluargaRisti`=0) THEN 'Tidak'
        ELSE ' '
        END AS kRisti

        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
        LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
        LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP` 
        left JOIN simpus_sanitasi san ON spn.`idpelayanan`=san.`pelayananId`

        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

        WHERE spn.`kdPoli`='097'  
        AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        $unitx
        $idpkm
        $unit_details_x
        $desa 
        ";
        $query=$this->db->query($sql);
       // echo $this->db->last_query();
        return $query;
    }
    // 2
    function getLapSan($pusk)
    {
         if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " where sk.`PUSK_ID`='".$pusk."' ";

        $sql="SELECT 9997 AS NO_KEL,'Jumlah dalam wilayah' AS NAMA_KEL
        UNION
        SELECT 9998 AS NO_KEL,'Jumlah luar wilayah' AS NAMA_KEL 
        UNION
        SELECT 9999 AS NO_KEL,'Jumlah luar Banyuwangi' AS NAMA_KEL 
        UNION SELECT NO_KEL,NAMA_KEL FROM setup_kel_bwi_new sk 
        $idpkm ORDER BY NO_KEL";
        $query=$this->db->query($sql);
        //echo $this->db->last_query();
        return $query;
    }

    public function get_lap_san($kdKel,$unit,$unit_details,$tgl_awal,$tgl_akhir,$pusk)
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

        // if($kel == '0')
        //     $desa = "";
        // else
        //     $desa = "AND sp.no_kel = '".$kel."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";

         //code unit
        if($kdKel =='9999')
            $kelx = "AND lok.`wilayah`='3'";
        else if($kdKel =='9998')
            $kelx = "AND lok.`wilayah`='2'";
        else if($kdKel =='9997')
            $kelx = "AND lok.`wilayah`='1'";
        else
            $kelx = "AND sp.`NO_KEL`='".$kdKel."' AND lok.`wilayah`='1' ";

        $sql=" SELECT COUNT(idpelayanan) AS kunpas,
        SUM(IF(diagnosa IN('A09','A91','A90','B74','B52','A15.0'),1,0)) AS kunling,
        SUM(IF(kdPoli='097',1,0)) AS sanitasipas,
        SUM(IF(keluargaBinaan='1',1,0)) AS binaanpas,
        SUM(IF(keluargaRisti='1',1,0)) AS ristipas
        FROM(
        SELECT spn.`idpelayanan`,spn.`kdPoli`,spn.`kdKegiatanPel`,lok.`wilayah`,
        sp.`NO_KEL`,san.`keluargaBinaan`,san.`keluargaRisti`,
        GROUP_CONCAT(CONCAT(sdd.`kdDiagnosa`) SEPARATOR ', ') diagnosa
        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
        LEFT JOIN simpus_sanitasi san ON spn.`idpelayanan`=san.`pelayananId`
        LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
        LEFT JOIN setup_kel_bwi_new kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` 
        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`
        
        WHERE lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        $idpkm
        $unit_details_x
        $unitx
        $kelx
        GROUP BY spn.`idpelayanan`) kun
        ";
        $query=$this->db->query($sql);
       // echo $this->db->last_query();
        return $query;
    }
    // 3
     // 3 durung
    function getLapKasusSan($pusk)
    {
         if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " where sk.`PUSK_ID`='".$pusk."' ";

        $sql="SELECT 9997 AS NO_KEL,'Jumlah dalam wilayah' AS NAMA_KEL
        UNION
        SELECT 9998 AS NO_KEL,'Jumlah luar wilayah' AS NAMA_KEL 
        UNION
        SELECT 9999 AS NO_KEL,'Jumlah luar Banyuwangi' AS NAMA_KEL 
        UNION SELECT NO_KEL,NAMA_KEL FROM setup_kel_bwi_new sk
        $idpkm ORDER BY NO_KEL";
        $query=$this->db->query($sql);
        //echo $this->db->last_query();
        return $query;
    }

    public function get_lap_kasus_san($kdKel,$unit,$unit_details,$tgl_awal,$tgl_akhir,$pusk)
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

        // if($kel == '0')
        //     $desa = "";
        // else
        //     $desa = "AND sp.no_kel = '".$kel."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";

         //code unit
        if($kdKel =='9999')
            $kelx = "AND lok.`wilayah`='3'";
        else if($kdKel =='9998')
            $kelx = "AND lok.`wilayah`='2'";
        else if($kdKel =='9997')
            $kelx = "AND lok.`wilayah`='1'";
        else
            $kelx = "AND sp.`NO_KEL`='".$kdKel."' AND lok.`wilayah`='1' ";
        
        $sql="SELECT
         SUM(IF((diagnosa='B80') AND JENIS_KLMIN='1',1,0)) AS cacingL,
        SUM(IF((diagnosa='B80') AND JENIS_KLMIN='2',1,0)) AS cacingP,

        SUM(IF((diagnosa='A09') AND JENIS_KLMIN='1',1,0)) AS diareL,
        SUM(IF((diagnosa='A09') AND JENIS_KLMIN='2',1,0)) AS diareP,

        SUM(IF((diagnosa='A91') AND JENIS_KLMIN='1',1,0)) AS tesL,
        SUM(IF((diagnosa='A91') AND JENIS_KLMIN='2',1,0)) AS tesP,

        SUM(IF((diagnosa='A90') AND JENIS_KLMIN='1',1,0)) AS dhfL,
        SUM(IF((diagnosa='A90') AND JENIS_KLMIN='2',1,0)) AS dhfP,

        SUM(IF((diagnosa='B74.9') AND JENIS_KLMIN='1',1,0)) AS filariasisL,
        SUM(IF((diagnosa='B74.9') AND JENIS_KLMIN='2',1,0)) AS filariasisP,

        SUM(IF((diagnosa='B50' or diagnosa='B51' or diagnosa='B52' or diagnosa='B53' or diagnosa='B54') AND JENIS_KLMIN='1',1,0)) AS malariaL,
        SUM(IF((diagnosa='B50' or diagnosa='B51' or diagnosa='B52' or diagnosa='B53' or diagnosa='B54') AND JENIS_KLMIN='2',1,0)) AS malariaP,

        SUM(IF((diagnosa='A15.0' or diagnosa='A16.0' or diagnosa='A18.0') AND JENIS_KLMIN='1',1,0)) AS tbparuL,
        SUM(IF((diagnosa='A15.0' or diagnosa='A16.0' or diagnosa='A18.0') AND JENIS_KLMIN='2',1,0)) AS tbparuP,

        SUM(IF((diagnosa BETWEEN 'A30.1' AND 'A30.9') AND JENIS_KLMIN='1',1,0)) AS kustaL,
        SUM(IF((diagnosa BETWEEN 'A30.1' AND 'A30.9') AND JENIS_KLMIN='2',1,0)) AS kustaP,

        SUM(IF((diagnosa BETWEEN 'L20' AND 'L30') AND JENIS_KLMIN='1',1,0)) AS kulitL,
        SUM(IF((diagnosa BETWEEN 'L20' AND 'L30') AND JENIS_KLMIN='2',1,0)) AS kulitP,
        
        SUM(IF((diagnosa='J06') AND JENIS_KLMIN='1',1,0)) AS ispaL,
        SUM(IF((diagnosa='J06') AND JENIS_KLMIN='2',1,0)) AS ispaP
        
         FROM(
        SELECT spn.`idpelayanan`,spn.`kdPoli`,spn.`kdKegiatanPel`,lok.`wilayah`,
        sp.`NO_KEL`,san.`keluargaBinaan`,san.`keluargaRisti`,
        sdd.`kdDiagnosa` AS diagnosa ,JENIS_KLMIN
        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        inner JOIN simpus_pelayanan spn ON spn.`loketId`=lok.`idLoket`
        LEFT JOIN simpus_sanitasi san ON spn.`idpelayanan`=san.`pelayananId`
        LEFT JOIN simpus_data_diagnosa sdd ON sdd.`pelayananId`=spn.`idpelayanan`
        LEFT JOIN setup_kel_bwi_new kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` 
        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`
        
        WHERE spn.`kdPoli`='097'  
        AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        $idpkm
        $unit_details_x
        $unitx
        $kelx
        ) kun
        ";
        $query=$this->db->query($sql);
       // echo $this->db->last_query();
        return $query;
    }


}