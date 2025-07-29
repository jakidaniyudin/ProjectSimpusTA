<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sanitasi_model extends CI_Model {

    var $table = 'simpus_pelayanan as pel';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('NAMA_LGKP','pasien.ALAMAT','nama_unit','NIK','loket.noKartu','NO_MR','NO_KK'); //set column field database for datatable searchable 
    var $order = array('id'=>'desc'); // default order 



    public function getId()
    {
       $user_id = $this->session->userdata('user_id');
       $this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
       return $this->id;
   }
   private function _get_datatables_query()
   {

       $this->db->select('idpelayanan,pasien.NO_PROP,pasien.NO_KAB,pasien.NO_KEC,pasien.NO_KEL,tglKunjungan,NIK,pasien.noKartu,NAMA_LGKP,NO_MR,pasien.ALAMAT,NO_RT,NO_RW,statusKartu, pel.noKunjungan,loket.noUrut,pel.pelIdSebelum,pel.kdPoli,unit.nama_unit,pel.sudahDilayani,pasien.ID,nmStatusPulang,tujuanPoli,pel.kunjSakitPel,san.*');


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
        $this->db->join('simpus_sanitasi as san','san.pelayananId = pel.idpelayanan','left');
        $this->db->join('simpus_statuspulang as plg','pel.kdStatusPulang = plg.kdStatusPulang','left');
        

        if($this->getId().$this->id!=46){
            $this->db->where('puskId', $this->getId());
            $where="(pel.`kdPoli`='097')";
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
        $this->db->from($this->table);
        return $this->db->count_all_results();
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