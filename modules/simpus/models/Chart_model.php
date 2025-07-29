<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_model extends CI_Model {

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
    //lap1
    function getChartKasus($unit,$unit_details,$tgl_awal,$tgl_akhir,$diagnosa)
    {
    	if($this->getId() != '46')
    		$idpkm =" AND puskId='".$this->getId()."' ";
    	else
    		$idpkm = '';

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

    	$sql="SELECT lok.`tglKunjungan`,diag.`kdDiagnosa`, diag.`nmDiagnosa`,COUNT(diag.`kdDiagnosa`) AS jml 
    	FROM simpus_pelayanan a
    	INNER JOIN simpus_loket lok ON a.`loketId`=lok.`idLoket`
    	LEFT JOIN simpus_data_diagnosa diag ON a.`idPelayanan`=diag.`pelayananId`

    	INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
    	INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori` 
    	WHERE lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    	$unitx
    	$idpkm
    	$unit_details_x
    	$diagnosax

    	GROUP BY lok.tglKunjungan
    	ORDER BY lok.tglKunjungan ASC;";
    	$query=$this->db->query($sql);
       // echo $this->db->last_query();
    	return $query;
    }

    function getChartKunjungan($unit,$unit_details,$tgl_awal,$tgl_akhir)
    {
    	if($this->getId() != '46')
    		$idpkm =" AND puskId='".$this->getId()."' ";
    	else
    		$idpkm = '';

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

    	$sql="SELECT pol.`nmPoli`,COUNT(pel.`kdPoli`) AS nilai FROM 
    	simpus_loket lok
    	INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
    	INNER JOIN simpus_poli_fktp pol ON pol.`kdPoli`=pel.`kdPoli` 
    	WHERE pol.`poliSakit`='TRUE' AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'

    	$unitx
    	$idpkm
    	$unit_details_x

    	GROUP BY pel.`kdPoli`;";
    	$query=$this->db->query($sql);
       // echo $this->db->last_query();
    	return $query;
    }


    public function getKunjunganhari($unit,$unit_details,$tgl_awal,$tgl_akhir,$kunj)
    {

        if($this->getId() != '46')
            $idpkm =" AND puskId='".$this->getId()."' ";
        else
            $idpkm = '';

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

        $sql="SELECT COUNT(*) jml_pasien 
        FROM simpus_loket sl
      
        WHERE
        kunjSakit='$kunj' AND sl.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        
        $unitx
        $idpkm
        $unit_details_x";

        $query=$this->db->query($sql);
 
        return $query;
    }

    public function getKunjunganPolihari($unit,$unit_details,$tgl_awal,$tgl_akhir)
    {
         if($this->getId() != '46')
            $idpkm =" AND puskId='".$this->getId()."' ";
        else
            $idpkm = '';

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

        $sql="SELECT
        SUM(IF(pel.`kdPoli`='001',1,0)) AS BP,
        SUM(IF(pel.`kdPoli`='002',1,0)) AS GIGI,
        SUM(IF(pel.`kdPoli`='003',1,0)) AS KIA,
        SUM(IF(pel.`kdPoli`='004',1,0)) AS LAB,
        SUM(IF(pel.`kdPoli`='005',1,0)) AS UGD,
        SUM(IF(pel.`kdPoli`='008',1,0)) AS KB,
        SUM(IF(pel.`kdPoli`='009',1,0)) AS SANITASI,
        SUM(IF(sl.`kunjSakit`='false',1,0)) AS SEHAT
        FROM simpus_loket sl
        INNER JOIN simpus_pelayanan pel ON pel.`loketId`=sl.`idLoket`
        -- INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=sk.`id_unit`
        WHERE
        sl.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        
        $unitx
        $idpkm
        $unit_details_x
        ";
        $query=$this->db->query($sql);
        //echo $this->db->last_query();
        return $query;
    }



}