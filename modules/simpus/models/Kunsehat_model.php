<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kunsehat_model extends CI_Model {
 
    var $table = 'simpus_pelayanan as pel';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('NAMA_LGKP','pasien.ALAMAT','nama_unit','NIK','loket.noKartu','NO_MR','NO_KK'); //set column field database for datatable searchable 
     var $order = array('pel.createdDate'=>'asc'); // default order 
 

 
    public function getId()
    {
       $user_id = $this->session->userdata('user_id');
       $this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
       return $this->id;

    }
    private function _get_datatables_query()
    {
         
       $this->db->select('pel.createdDate,idpelayanan,pasien.NO_PROP,pasien.NO_KAB,pasien.NO_KEC,pasien.NO_KEL,tglKunjungan,NIK,pasien.noKartu,NAMA_LGKP,NO_MR,pasien.ALAMAT,NO_RT,NO_RW,statusKartu, loket.noKunjungan,loket.noUrut,pel.pelIdSebelum,pel.kdPoli,unit.nama_unit,pel.sudahDilayani,pasien.ID,nmStatusPulang,tujuanPoli,kdKegiatan');

        if($this->input->post('id_detail'))
        {
            $this->db->where('unit.id_detail', $this->input->post('id_detail'));
        }

        if($this->input->post('tglKunjungan'))
        {
            $tglKunjungan=date("Y-m-d", strtotime($this->input->post('tglKunjungan')));
            $this->db->where('loket.tglKunjungan', $tglKunjungan);
        }
        
        if($this->input->post('kdPoli'))
        {
            $kdPoli=$this->input->post('kdPoli');
            $this->db->where('loket.kdPoli', $kdPoli);
        }

        if($this->input->post('kdMal'))
        {
            $kdMal=$this->input->post('kdMal');
            $this->db->where('loket.kdKegiatan', $kdMal);
        }
	   
 		$this->db->join('simpus_loket as loket','pel.loketId = loket.idLoket');
        $this->db->join('simpus_pasien as pasien','pasien.ID = loket.pasienId');
        $this->db->join('data_master_unit_detail as unit','unit.id_detail = loket.unitId');
        $this->db->join('simpus_statuspulang as plg','pel.kdStatusPulang = plg.kdStatusPulang','left');
        
        if($this->getId().$this->id!=46){
        $this->db->where('loket.puskId', $this->getId());
        }
        $this->db->where('loket.kunjSakit', 'false');
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
 
////
    public function getPasienSeksi($kdSeksi)
    {
        $idpkm = $this->ion_auth->unit();
        if($idpkm != '46')
            $unit="AND puskId ='".$idpkm."'";
        else
            $unit="";

        $sql="SELECT COUNT(*) jml_pasien FROM simpus_loket a INNER JOIN simpus_master_mal b ON a.`kdKegiatan`=b.`idMal` WHERE b.`seksi`=$kdSeksi AND DATE(a.`tglKunjungan`) =DATE(CURDATE()) $unit";
        $query=$this->db->query($sql);
        return $query;
    }


    public function getKegiatanSeksi($kdSeksi,$id)
    {
        $idpkm = $this->ion_auth->unit();
        if($idpkm != '46')
            $unit="AND puskId ='".$idpkm."'";
        else
            $unit="";

        $sql="SELECT COUNT(*) jml_pasien FROM simpus_loket a INNER JOIN simpus_master_mal b ON a.`kdKegiatan`=b.`idMal` WHERE b.`seksi`=$kdSeksi AND kdKegiatan=$id AND DATE(a.`tglKunjungan`) =DATE(CURDATE()) $unit";
        $query=$this->db->query($sql);
        return $query;
    }
    public function getHomeVisit($tahun,$kunj)
    {
        $idpkm = $this->ion_auth->unit();
        if($idpkm != '46')
            $unit="AND puskId ='".$idpkm."' ";
        else
            $unit="";

        $tahunx = 'AND DATE(tglKunjungan) =DATE(CURDATE()) ' ;



        $sql="SELECT COUNT(*) jml_pasien FROM simpus_loket
        where kdPoli='020'
        AND kunjSakit='$kunj'  $unit $tahunx and unitId <> '' ";
        $query=$this->db->query($sql);
        return $query;
    }

    // Poli
    public function getPoli()
    {
     $idpkm = $this->ion_auth->unit();
     if($idpkm != '46')
        $unit="AND puskId ='".$idpkm."'";
    else
        $unit="";

    $tgl=date("Y-m-d");
    $sql= "SELECT *,SUM(IF(sk.kdPoli <> '',1,0)) AS total FROM
    (SELECT kdPoli,nmPoli,color,nmController FROM simpus_poli_fktp WHERE pelayanan ='TRUE') poli
    LEFT JOIN (SELECT sp.kdPoli FROM simpus_pelayanan sp
    INNER JOIN simpus_loket sl ON sp.`loketId`=sl.`idLoket`
    WHERE sl.`tglKunjungan`='".$tgl."' AND sp.kdPoli <> '' $unit) sk
    ON sk.`kdPoli`=poli.kdPoli GROUP BY nmPoli ORDER BY poli.kdPoli";
    $query=$this->db->query($sql);
    return $query;
    }
    public function getPoliLansia()
    {
     $idpkm = $this->ion_auth->unit();
     if($idpkm != '46')
        $unit="AND puskId ='".$idpkm."'";
    else
        $unit="";

    $tgl=date("Y-m-d");
    $sql= "SELECT COUNT(*) AS jumlahLansia
    FROM simpus_loket 
    WHERE tglKunjungan = '".$tgl."' 
    $unit AND kelUmur >= 11 AND kdPoli ='001'";
    $query=$this->db->query($sql);
    return $query;
    }

    public function getSeksi()
    {
    $idpkm = $this->ion_auth->unit();
    if($idpkm != '46')
        $unit="AND puskId ='".$idpkm."'";
    else
        $unit="";

    $tgl=date("Y-m-d");
    $sql="SELECT nmSeksi,kdSeksi,nmController,color,SUM(IF(kdKegiatan <> 0,1,0)) AS total FROM
    (SELECT nmSeksi,kdSeksi,m.`nmMal`,idMal,s.nmController,s.color FROM simpus_seksi s
    LEFT JOIN simpus_master_mal m ON s.kdSeksi=m.seksi WHERE kdSeksi!=9) sek
    LEFT JOIN (    SELECT tglKunjungan,kdKegiatan FROM simpus_loket sl
    WHERE sl.`tglKunjungan`='".$tgl."' AND kdKegiatan <> '' $unit) sk ON sk.kdKegiatan=sek.idMal
    GROUP BY nmSeksi ORDER BY kdSeksi ASC";
    $query=$this->db->query($sql);
    return $query;
    }
    
    public function getMalSehat($seksi) 
    {
     $idpkm = $this->ion_auth->unit();
    if($idpkm != '46')
        $unit="AND puskId ='".$idpkm."'";
    else
        $unit="";

    $tgl=date("Y-m-d");
    $sql="SELECT *,SUM(IF(kdKegiatan <> 0,1,0)) AS total FROM
            (SELECT kdSeksi,m.`nmMal`,idMal,m.nmController,m.color FROM simpus_seksi s
            LEFT JOIN simpus_master_mal m ON s.kdSeksi=m.seksi WHERE m.`seksi`='".$seksi."') sek
            LEFT JOIN (SELECT tglKunjungan,kdKegiatan FROM simpus_loket sl
    WHERE sl.`tglKunjungan`='".$tgl."' AND kdKegiatan <> '' $unit) sk ON sk.kdKegiatan=sek.idMal
            GROUP BY sek.nmMal ORDER BY nmMal";
    $query=$this->db->query($sql);
    return $query;
}
 
////=================================================================================================================
    //                                              LAPORAN - LAPORAN
    ////=================================================================================================================

    //1==========================================LAPORAN DATA KESAKITAN==================================================
function getDataLapKesehatan($unit,$unit_details,$tgl_awal,$tgl_akhir,$pusk)
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

    $sql="SELECT nmMal,nmSeksi,
       #umur 0-7 hari
    SUM(IF(  kelUmur = 1 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru07L,
    SUM(IF(  kelUmur = 1 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru07P,
    SUM(IF(  kelUmur = 1 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama07L,
    SUM(IF(  kelUmur = 1 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama07P,
        #umur 8-28 hari
    SUM(IF(  kelUmur = 2 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru828L,
    SUM(IF(  kelUmur = 2 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru828P,
    SUM(IF(  kelUmur = 2 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama828L,
    SUM(IF(  kelUmur = 2 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama828P,
        #umur 1-12 bulan
    SUM(IF(  kelUmur = 3 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru112L,
    SUM(IF(  kelUmur = 3 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru112P,
    SUM(IF(  kelUmur = 3 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama112L,
    SUM(IF(  kelUmur = 3 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama112P,
        #umur 1-4 tahun
    SUM(IF(  kelUmur = 4 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru14L,
    SUM(IF(  kelUmur = 4 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru14P,
    SUM(IF(  kelUmur = 4 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama14L,
    SUM(IF(  kelUmur = 4 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama14P,
        #umur 5-9 tahun
    SUM(IF(  kelUmur = 5 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru59L,
    SUM(IF(  kelUmur = 5 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru59P,
    SUM(IF(  kelUmur = 5 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama59L,
    SUM(IF(  kelUmur = 5 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama59P,
        #umur 10-14 tahun
    SUM(IF(  kelUmur = 6 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru1014L,
    SUM(IF(  kelUmur = 6 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru1014P,
    SUM(IF(  kelUmur = 6 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama1014L,
    SUM(IF(  kelUmur = 6 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama1014P,
        #umur 15-19 tahun
    SUM(IF(  kelUmur = 7 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru1519L,
    SUM(IF(  kelUmur = 7 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru1519P,
    SUM(IF(  kelUmur = 7 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama1519L,
    SUM(IF(  kelUmur = 7 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama1519P,
        #umur 20-44 tahun
    SUM(IF(  kelUmur = 8 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru2044L,
    SUM(IF(  kelUmur = 8 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru2044P,
    SUM(IF(  kelUmur = 8 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama2044L,
    SUM(IF(  kelUmur = 8 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama2044P,
        #umur 45-54 tahun
    SUM(IF(  kelUmur = 9 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru4554L,
    SUM(IF(  kelUmur = 9 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru4554P,
    SUM(IF(  kelUmur = 9 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama4554L,
    SUM(IF(  kelUmur = 9 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama4554P,
        #umur 55-59 tahun
    SUM(IF(  kelUmur = 10 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru5559L,
    SUM(IF(  kelUmur = 10 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru5559P,
    SUM(IF(  kelUmur = 10 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama5559L,
    SUM(IF(  kelUmur = 10 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama5559P,
        #umur 60-69 tahun
    SUM(IF(  kelUmur = 11 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru6069L,
    SUM(IF(  kelUmur = 11 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru6069P,
    SUM(IF(  kelUmur = 11 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama6069L,
    SUM(IF(  kelUmur = 11 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama6069P,
        #umur >= 70 tahun
    SUM(IF(  kelUmur = 12 AND kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS baru70L,
    SUM(IF(  kelUmur = 12 AND kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS baru70P,
    SUM(IF(  kelUmur = 12 AND kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS lama70L,
    SUM(IF(  kelUmur = 12 AND kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS lama70P,

    SUM(IF( kunjBaru = 'true' AND JENIS_KLMIN='1',1,0)) AS jmlBaruL,
    SUM(IF( kunjBaru = 'true' AND JENIS_KLMIN='2',1,0)) AS jmlBaruP,
    SUM(IF( kunjBaru = 'false' AND JENIS_KLMIN='1',1,0)) AS jmlLamaL,
    SUM(IF( kunjBaru = 'false' AND JENIS_KLMIN='2',1,0)) AS jmlLamaP

    FROM (SELECT lok.`puskId`,pel.`idpelayanan`, DATE_FORMAT(lok.`tglKunjungan`,'%d-%m-%Y') AS tglKunjungan,sp.`NAMA_LGKP`,
        sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,kelUmur,lok.`umur`,sp.`JENIS_KLMIN`,
        pel.`kdPoli`,pel.`tujuanPoli`,lok.`kunjBaru`,lok.`wilayah`,lok.`kunjSakit`,pel.`kdKegiatanPel`,
        ss.`kdSeksi`,ss.`nmSeksi`,mm.`nmMal`,mm.`idMal`
        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        inner JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
        LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
        LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        
        INNER JOIN simpus_master_mal mm ON mm.`idMal`=pel.`kdKegiatanPel`
        INNER JOIN simpus_seksi ss ON ss.`kdSeksi`=mm.`seksi`

        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`
      WHERE 
      tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
     $unitx
     $idpkm
     $unit_details_x) kun
     GROUP BY idMal ORDER BY nmSeksi ASC

     ";
     $query=$this->db->query($sql);
        //echo $this->db->last_query();
     return $query;
 }
////
 function getLapPustu($unit,$unit_details,$tgl_awal,$tgl_akhir,$diagnosa)
 {

    $tglAwal=date("Y-m-d",strtotime($tgl_awal));
    $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

    $sql="select * 
    FROM simpus_kunjungan sk
    INNER JOIN simpus_pasien sp ON sp.`ID`=sk.`pasien_id`
    INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=sk.id_unit
    INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
    where
    dmud.`id_kategori`=2
    AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
    GROUP BY dmud.`id_detail`
    ";
    $query=$this->db->query($sql);
        //echo $this->db->last_query();
    return $query;
}

function getDataLapPustu($kdDiagnosa,$unit,$unit_details,$tgl_awal,$tgl_akhir,$pusk)
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
        $unit_details_x = "AND `id_unit`= '".$unit_details."'";

         //code unit
    if($unit =='0')
        $unitx = '';
    else
        $unitx = "AND dmu.id_kategori='".$unit."'";

    $sql="SELECT 
        #umur 0-7 hari
    SUM(IF(  sk.`KEL_UMUR` = 1 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru07L,
    SUM(IF(  sk.`KEL_UMUR` = 1 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru07P,
        #umur 8-28 hari
    SUM(IF(  sk.`KEL_UMUR` = 2 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru828L,
    SUM(IF(  sk.`KEL_UMUR` = 2 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru828P,
        #umur 1-12 bulan
    SUM(IF(  sk.`KEL_UMUR` = 3 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru112L,
    SUM(IF(  sk.`KEL_UMUR` = 3 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru112P,
        #umur 1-4 tahun
    SUM(IF(  sk.`KEL_UMUR` = 4 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru14L,
    SUM(IF(  sk.`KEL_UMUR` = 4 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru14P,
        #umur 5-9 tahun
    SUM(IF(  sk.`KEL_UMUR` = 5 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru59L,
    SUM(IF(  sk.`KEL_UMUR` = 5 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru59P,
        #umur 10-14 tahun
    SUM(IF(  sk.`KEL_UMUR` = 6 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru1014L,
    SUM(IF(  sk.`KEL_UMUR` = 6 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru1014P,
        #umur 15-19 tahun
    SUM(IF(  sk.`KEL_UMUR` = 7 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru1519L,
    SUM(IF(  sk.`KEL_UMUR` = 7 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru1519P,
        #umur 20-44 tahun
    SUM(IF(  sk.`KEL_UMUR` = 8 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru2044L,
    SUM(IF(  sk.`KEL_UMUR` = 8 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru2044P,
        #umur 45-54 tahun
    SUM(IF(  sk.`KEL_UMUR` = 9 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru4554L,
    SUM(IF(  sk.`KEL_UMUR` = 9 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru4554P,
        #umur 55-59 tahun
    SUM(IF(  sk.`KEL_UMUR` = 10 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru5559L,
    SUM(IF(  sk.`KEL_UMUR` = 10 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru5559P,
        #umur 60-69 tahun
    SUM(IF(  sk.`KEL_UMUR` = 11 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru6069L,
    SUM(IF(  sk.`KEL_UMUR` = 11 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru6069P,
        #umur >= 70 tahun
    SUM(IF(  sk.`KEL_UMUR` = 12 AND sp.`JENIS_KLMIN`='1',1,0)) AS baru70L,
    SUM(IF(  sk.`KEL_UMUR` = 12 AND sp.`JENIS_KLMIN`='2',1,0)) AS baru70P,
    
    SUM(IF( sp.`JENIS_KLMIN`='1',1,0)) AS jmlBaruL,
    SUM(IF( sp.`JENIS_KLMIN`='2',1,0)) AS jmlBaruP
    
    FROM simpus_kunjungan sk
    INNER JOIN simpus_pasien sp ON sp.`ID`=sk.`pasien_id`
         #code unit
    INNER JOIN data_master_unit_detail dmud on dmud.id_detail=sk.id_unit
    inner join data_master_unit dmu on dmu.id_kategori=dmud.id_kategori

        -- LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP`
     --    LEFT JOIN setup_kel kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` 
     --    AND kel.`NO_KAB` = sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`

     WHERE sk.`id_kategori_unit`=2 AND
     tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'

     $unitx
     $idpkm
     $unit_details_x
     ";
     $query=$this->db->query($sql);
        //echo $this->db->last_query();
     return $query;
 }

 public function getLapRegDataKesehatan($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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
            $desa = "AND lok.NO_KEL = '".$kel."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";

        $sql="SELECT pel.`idpelayanan`, DATE_FORMAT(lok.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,
        sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,lok.`kelUmur`,lok.`umur`,sp.`JENIS_KLMIN`,
        pel.`kdPoli`,pel.`tujuanPoli`,lok.`kunjBaru`,lok.`wilayah`,lok.`kunjSakit`,pel.`kdKegiatanPel`,ss.`kdSeksi`,wilayah
        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        inner JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
        LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
        LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        
        INNER JOIN simpus_master_mal mm ON mm.`idMal`=pel.`kdKegiatanPel`
        INNER JOIN simpus_seksi ss ON ss.`kdSeksi`=mm.`seksi`

        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

        WHERE tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        $unitx
        $idpkm
        $unit_details_x
        $desa

        ORDER BY lok.tglKunjungan ASC 
        ";
        $query=$this->db->query($sql);
       //cho $this->db->last_query();
        return $query;
    }

function getlapRapidTes($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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
            $desa = "AND lok.NO_KEL = '".$kel."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";

        $sql="SELECT pel.`idpelayanan`,sp.NIK,lok.umur,sp.NO_RT,sp.NO_RW,sp.PHONE, DATE_FORMAT(lok.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,
        sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,lok.`umur`,sp.`JENIS_KLMIN`,lok.`wilayah`,lok.`kunjSakit`,pel.`kdKegiatanPel`,wilayah,pm.`DESCRIP`,
        case anam.igg when 1 then 'R' when 0 then 'NR' else '' end as igg,
        case anam.igm when 1 then 'R' when 0 then 'NR' else '' end as igm
        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        INNER JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
        LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
        LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        left join simpus_anamnesa anam on anam.`loketId`=lok.`idLoket`

        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`
        LEFT JOIN pkrjn_master pm ON sp.`JENIS_PKRJN`=pm.`NO`

        WHERE tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."' AND (lok.`kdPoli`='095' OR pel.`kdKegiatanPel`='51')
        $unitx
        $idpkm
        $unit_details_x
        $desa 
        ";
        $query=$this->db->query($sql);
       //Echo $this->db->last_query();
        return $query;
 }

    function getlapJmlRapidTes($tgl_awal,$tgl_akhir,$pusk)
    {
        // $user_id = $this->session->userdata('user_id');
        // $pusk_id = $this->db->query("select * from users where id='".$user_id."'")->row('unit');

        // if($this->getId() != '46')
        //     $user = "puskid='".$pusk_id."' AND";
        // else
        //     $user = '';
if($pusk=='0')
    $user ='';
else
    $user = "puskId='".$pusk."' AND";

        $tglAwal=date("Y-m-d",strtotime($tgl_awal));
        $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));
        $sql="SELECT * FROM 
        (SELECT up.`unit_id`,up.`nama_unit` FROM unit_profiles up where unit_id <> 46 order by nama_unit asc) unit
        LEFT JOIN 
        (SELECT puskid,
        SUM(IF(igg=0,1,0)) AS IggNR,
        SUM(IF(igg=1,1,0)) AS IggR,
        SUM(IF(igm=0,1,0)) AS IgmNR,
        SUM(IF(igm=1,1,0)) AS IgmR
        FROM simpus_anamnesa sa 
        INNER JOIN `simpus_loket` sl ON sl.idLoket=sa.`loketId`
        WHERE $user  sl.tglKunjungan BETWEEN '".$tglAwal."' AND '". $tglAkhir."'
        GROUP BY sl.PUSKID) rapid ON rapid.puskid = unit.unit_id";
        $query=$this->db->query($sql);
       //Echo $this->db->last_query();
        return $query;

    }

}