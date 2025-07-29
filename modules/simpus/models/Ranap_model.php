<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranap_model extends CI_Model {

    var $table = 'simpus_pelayanan as pel';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('NAMA_LGKP','pasien.ALAMAT','nama_unit','NIK','loket.noKartu','NO_MR','NO_KK','f.nama_kamar','e.nama_bed'); //set column field database for datatable searchable 
    var $order = array('id'=>'desc'); // default order 
    var $order_riwayat = array('tglKeluar'=>'desc'); // default order 



    public function getId()
    {
       $user_id = $this->session->userdata('user_id');
       $this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
       return $this->id;

   }

   public function getRanapD()
 {
    $idpkm = $this->ion_auth->unit();
    if($idpkm != '46')
        $unit="AND puskId ='".$idpkm."'";
    else
        $unit="";

    $sql="SELECT COUNT(*) jml_pasien FROM simpus_pelayanan b
    LEFT JOIN simpus_ranap a ON a.`pelayananId`=b.`idpelayanan` WHERE bedId IS NULL AND b.`kdPoli`='098' AND (ranapStatus!=1 OR ranapStatus IS NULL) $unit";
    $query=$this->db->query($sql);
    //echo $this->db->last_query();
    return $query;
}
public function getRanapR()
{
    $idpkm = $this->ion_auth->unit();
    if($idpkm != '46')
        $unit="AND puskId ='".$idpkm."'";
    else
        $unit="";

    $sql="SELECT COUNT(*) jml_pasien FROM simpus_pelayanan b
    LEFT JOIN simpus_ranap a ON a.`pelayananId`=b.`idpelayanan` 
    WHERE bedId != '' AND b.`kdPoli`='098' AND ranapStatus='1' $unit ";
    $query=$this->db->query($sql);
   // echo $this->db->last_query();
    return $query;
}

private function _get_datatables_query()
{

   $this->db->select('idpelayanan,pasien.NO_PROP,pasien.NO_KAB,pasien.NO_KEC,pasien.NO_KEL,tglKunjungan,NIK,pasien.noKartu,NAMA_LGKP,NO_MR,pasien.ALAMAT,NO_RT,NO_RW,statusKartu, loket.noKunjungan,loket.noUrut,pel.pelIdSebelum,pel.kdPoli,unit.nama_unit,pel.sudahDilayani,pasien.ID,nmStatusPulang,tujuanPoli,rnp.bedId');

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
$this->db->join('simpus_statuspulang as plg','pel.kdStatusPulang = plg.kdStatusPulang','left');
$this->db->join('simpus_ranap as rnp','pel.idpelayanan = rnp.pelayananId','left');

if($this->getId().$this->id!=46){
    $where="pel.`kdPoli`=098";
    $this->db->where($where);
    $this->db->where("(rnp.`bedId` IS NULL OR rnp.`bedId`='')");
    $this->db->where('loket.puskId', $this->getId());
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
    
    private function _get_rawattables_query()
    {

      $this->db->select('idpelayanan,pasien.NO_PROP,pasien.NO_KAB,pasien.NO_KEC,pasien.NO_KEL,tglKunjungan,tglMasuk,NIK,pasien.noKartu,NAMA_LGKP,NO_MR,pasien.ALAMAT,NO_RT,NO_RW,statusKartu, loket.noKunjungan,loket.noUrut,pel.pelIdSebelum,pel.kdPoli,unit.nama_unit,pel.sudahDilayani,pasien.ID,nmStatusPulang,tujuanPoli,rnp.bedId,kmr.nama_kamar,bed.nama_bed');



       if($this->input->post('id_detail'))
       {
        $this->db->where('unit.id_detail', $this->input->post('id_detail'));
    }

    // $tglMasuk = date('Y-m-d',strtotime($this->input->post('tglKunjungan')));

    // if($this->input->post('tglKunjungan'))
    //    {
    //     $this->db->where('DATE(rnp.`tglMasuk`)', $tglMasuk);
    // }

    $this->db->join('simpus_loket as loket','pel.loketId = loket.idLoket');
    $this->db->join('simpus_pasien as pasien','pasien.ID = loket.pasienId');
    $this->db->join('data_master_unit_detail as unit','unit.id_detail = loket.unitId');
    $this->db->join('simpus_statuspulang as plg','pel.kdStatusPulang = plg.kdStatusPulang','left');
    $this->db->join('simpus_ranap as rnp','pel.idpelayanan = rnp.pelayananId','left');
    $this->db->join('master_bed as bed','rnp.bedId = bed.id_bed','left');
    $this->db->join('master_kamar as kmr','rnp.kamarId = kmr.id_kamar','left');

    if($this->getId().$this->id!=46){
        $where="pel.`kdPoli`=098";
        $this->db->where($where);
        $this->db->where('loket.puskId', $this->getId());
    }
    $this->db->where('rnp.ranapStatus ','1');
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

    public function get_rawattables()
    {
        $this->_get_rawattables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
      // echo $this->db->last_query();
        return $query->result();
    }
    
    public function count_rawatfiltered()
    {
        $this->_get_rawattables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_rawatall()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

////
    private function _get_riwayattables_query()
    {

        $this->db->select('idpelayanan,pasien.NO_PROP,pasien.NO_KAB,pasien.NO_KEC,pasien.NO_KEL,tglKunjungan,NIK,pasien.noKartu,NAMA_LGKP,NO_MR,pasien.ALAMAT,NO_RT,NO_RW,statusKartu, loket.noKunjungan,loket.noUrut,pel.pelIdSebelum,pel.kdPoli,unit.nama_unit,pel.sudahDilayani,pasien.ID,nmStatusPulang,tujuanPoli,rnp.bedId,kmr.nama_kamar,bed.nama_bed,bed.digunakan,rnp.kamarId');

        
        if($this->input->post('id_detail'))
        {
            $this->db->where('unit.id_detail', $this->input->post('id_detail'));
        }

        $this->db->join('simpus_loket as loket','pel.loketId = loket.idLoket');
        $this->db->join('simpus_pasien as pasien','pasien.ID = loket.pasienId');
        $this->db->join('data_master_unit_detail as unit','unit.id_detail = loket.unitId');
        $this->db->join('simpus_statuspulang as plg','pel.kdStatusPulang = plg.kdStatusPulang','left');
        $this->db->join('simpus_ranap as rnp','pel.idpelayanan = rnp.pelayananId','left');
        $this->db->join('master_bed as bed','rnp.bedId = bed.id_bed','left');
        $this->db->join('master_kamar as kmr','rnp.kamarId = kmr.id_kamar','left');

        if($this->getId().$this->id!=46){
            $where="(pel.`kdPoli`=098)";
            $this->db->where($where);
            $this->db->where('loket.puskId', $this->getId());
        }

       // $this->db->where('a.diagnosa1 !=','');
        $this->db->where('ranapStatus ','0');
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
        else if(isset($this->order_riwayat))
        {
            $order = $this->order_riwayat;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_riwayattables()
    {
        $this->_get_riwayattables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
      // echo $this->db->last_query();
        return $query->result();
    }
    
    public function count_riwayatfiltered()
    {
        $this->_get_riwayattables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_riwayatall()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    //BED 
    public function get_bed_non($tglCek){
        $K = $this->db->query("SELECT id_bed  FROM (
            SELECT rnp.`bedId` AS id_bed,mb.`nama_bed` AS nama_bed,
            rnp.`pelayananId`,rnp.`bedId`,rnp.`kamarId`,rnp.`puskId`,
            mk.`nama_kamar`,
            rnp.`tglMasuk` AS masuk,
            IF(rnp.`tglKeluar`='0000-00-00 00:00:00' OR rnp.`tglKeluar` IS NULL,'2050-12-31 00:00:00',rnp.`tglKeluar`) AS keluar, 'Terpakai' AS tersedia
            FROM simpus_loket lok
            INNER JOIN simpus_pelayanan pel ON lok.`idLoket`=pel.`loketId`
            INNER JOIN simpus_ranap rnp ON pel.idpelayanan = rnp.pelayananId
            LEFT JOIN master_kamar mk ON rnp.`kamarId`=mk.`id_kamar`
            LEFT JOIN master_bed mb ON rnp.`bedId`=mb.`id_bed` 
            WHERE lok.`puskId`='".$this->getId()."' AND rnp.`tglMasuk` IS NOT NULL
            ) rawat
            WHERE ('".$tglCek."' BETWEEN masuk AND keluar)");
        if ($K->num_rows() > 0){
            foreach ($K->result_array() as $row)
            {
                $data[$row['id_bed']] = $row['id_bed'];
            }
        }else{
            $data = '0';
        }
        $K->free_result();
        return $data;
    }

    function get_bed_on_OLD($no_kamar)
    {
        $K=$this->db->query("SELECT id_bed, nama_bed
            FROM master_bed WHERE id_kamar = '".$no_kamar."' ORDER BY nama_bed ASC");
        $data[''] = '';
        foreach ($K->result_array() as $row)
        {
            $data[$row['id_bed']] = $row['nama_bed'];
        }

        $K->free_result();
        return $data;
    }

    function get_bed_on($no_kamar,$tglCek)
    {
        $K=$this->db->query("SELECT * FROM master_bed b
            WHERE b.`id_bed` NOT IN (SELECT id_bed  FROM (
            SELECT rnp.`bedId` AS id_bed,mb.`nama_bed` AS nama_bed,
            rnp.`pelayananId`,rnp.`bedId`,rnp.`kamarId`,rnp.`puskId`,
            mk.`nama_kamar`,
            rnp.`tglMasuk` AS masuk,
            IF(rnp.`tglKeluar`='0000-00-00 00:00:00' OR rnp.`tglKeluar` IS NULL,'2050-12-31 00:00:00',rnp.`tglKeluar`) AS keluar, 'Terpakai' AS tersedia
            FROM simpus_loket lok
            INNER JOIN simpus_pelayanan pel ON lok.`idLoket`=pel.`loketId`
            INNER JOIN simpus_ranap rnp ON pel.idpelayanan = rnp.pelayananId
            LEFT JOIN master_kamar mk ON rnp.`kamarId`=mk.`id_kamar`
            LEFT JOIN master_bed mb ON rnp.`bedId`=mb.`id_bed` 
            WHERE lok.`puskId`='".$this->getId()."' AND rnp.`tglMasuk` IS NOT NULL
            ) rawat
            WHERE ('".$tglCek."' BETWEEN masuk AND keluar)
            )
            AND b.`id_kamar`='".$no_kamar."'");
        $data[''] = '';
        foreach ($K->result_array() as $row)
        {
            $data[$row['id_bed']] = $row['nama_bed'];
        }

        $K->free_result();
        return $data;
    }

    //======================== LAPORAN ============================================= //
    //======================== LAPORAN PASIEN MASUK RAWAT INAP =================== //
    
    public function get_lap_pas_msk($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel)
    {
        if($this->getId() != '46')
            $idpkm =" AND lok.puskId='".$this->getId()."' ";
        else
            $idpkm = '';

        $tglAwal=date("Y-m-d",strtotime($tgl_awal));
        $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

        if($unit_details == '0')
            $unit_details_x = "";
        else
            $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";

        if($kel == '0')
            $desa = "";
        else
            $desa = "AND sp.NO_KEL = '".$kel."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";

        $sql="SELECT pel.`idpelayanan`, DATE_FORMAT(lok.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,
        sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,lok.`kelUmur`,lok.`umur`,sp.`JENIS_KLMIN`,
        pel.`kdPoli`,pel.`tujuanPoli`,lok.`kunjBaru`,lok.`wilayah`,lok.`kunjSakit`,rnp.`tglMasuk`
        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        inner JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
        LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
        LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        INNER JOIN simpus_ranap rnp ON rnp.`pelayananId`=pel.`idpelayanan`

        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

        WHERE rnp.`kamarId`!='' and
        tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        $unitx
        $idpkm
        $unit_details_x
        $desa 
        ";
        $query=$this->db->query($sql);
       // echo $this->db->last_query();
        return $query;
    }

    //======================== LAPORAN PASIEN KELUAR RAWAT INAP =================== //
    public function get_lap_pas_klr($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel)
    {
       if($this->getId() != '46')
            $idpkm =" AND lok.puskId='".$this->getId()."' ";
        else
            $idpkm = '';

        $tglAwal=date("Y-m-d",strtotime($tgl_awal));
        $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));



        if($unit_details == '0')
            $unit_details_x = "";
        else
            $unit_details_x = "AND lok.`unitId`= '".$unit_details."'";

        if($kel == '0')
            $desa = "";
        else
            $desa = "AND sp.NO_KEL = '".$kel."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";

        $sql="SELECT pel.`idpelayanan`, DATE_FORMAT(lok.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,
        sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,lok.`kelUmur`,lok.`umur`,sp.`JENIS_KLMIN`,
        pel.`kdPoli`,pel.`tujuanPoli`,lok.`kunjBaru`,lok.`wilayah`,lok.`kunjSakit`,rnp.`tglMasuk`,rnp.`tglKeluar`
        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        inner JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
        LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
        LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        INNER JOIN simpus_ranap rnp ON rnp.`pelayananId`=pel.`idpelayanan`

        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

        WHERE rnp.`kamarId`!='' and rnp.`tglKeluar` != '0000-00-00 00:00:00'
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
    //======================== LAPORAN PASIEN DALAM PERAWATAN RAWAT INAP =================== //
    public function get_lap_pas_rwt($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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
            $desa = "AND sp.NO_KEL = '".$kel."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";

        $sql="SELECT pel.`idpelayanan`, DATE_FORMAT(lok.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,
        sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,lok.`kelUmur`,lok.`umur`,sp.`JENIS_KLMIN`,
        pel.`kdPoli`,pel.`tujuanPoli`,lok.`kunjBaru`,lok.`wilayah`,lok.`kunjSakit`,rnp.`tglMasuk`,rnp.`tglKeluar`
        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        inner JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
        LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
        LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        INNER JOIN simpus_ranap rnp ON rnp.`pelayananId`=pel.`idpelayanan`

        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

        WHERE ranapStatus='1'
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

    //======================== LAPORAN KAMAR =================== //
    public function get_lap_kamar($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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
            $desa = "AND sp.NO_KEL = '".$kel."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";

        $sql="SELECT pel.`idpelayanan`, DATE_FORMAT(lok.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,
        sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,lok.`kelUmur`,lok.`umur`,sp.`JENIS_KLMIN`,
        pel.`kdPoli`,pel.`tujuanPoli`,lok.`kunjBaru`,lok.`wilayah`,lok.`kunjSakit`,rnp.`tglMasuk`,rnp.`tglKeluar`,bed.`nama_bed`,kmr.`nama_kamar`
        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        inner JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
        LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
        LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        INNER JOIN simpus_ranap rnp ON rnp.`pelayananId`=pel.`idpelayanan`
        LEFT JOIN master_bed bed ON bed.`id_bed`=rnp.`bedId` 
        LEFT JOIN master_kamar kmr ON kmr.`id_kamar`=rnp.`kamarId`
        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

        WHERE tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        $unitx
        $idpkm
        $unit_details_x
        $desa 
        ";
        $query=$this->db->query($sql);
       //echo $this->db->last_query();
        return $query;
    }

     //======================== LAPORAN GRAFIk =================== //
    public function get_grafik_kamar($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pusk)
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
            $desa = "AND sp.NO_KEL = '".$kel."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";

        $sql="SELECT pel.`idpelayanan`, DATE_FORMAT(lok.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,
        sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,lok.`kelUmur`,lok.`umur`,sp.`JENIS_KLMIN`,
        pel.`kdPoli`,pel.`tujuanPoli`,lok.`kunjBaru`,lok.`wilayah`,lok.`kunjSakit`,rnp.`tglMasuk`,rnp.`tglKeluar`,bed.`nama_bed`,kmr.`nama_kamar`
        FROM simpus_loket lok
        INNER JOIN simpus_pasien sp ON sp.`ID`=lok.`pasienId`
        inner JOIN simpus_pelayanan pel ON pel.`loketId`=lok.`idLoket`
        LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
        LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`
        INNER JOIN simpus_ranap rnp ON rnp.`pelayananId`=pel.`idpelayanan`
        LEFT JOIN master_bed bed ON bed.`id_bed`=rnp.`bedId` 
        LEFT JOIN master_kamar kmr ON kmr.`id_kamar`=rnp.`kamarId`
        INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
        INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

        WHERE tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        $unitx
        $idpkm
        $unit_details_x
        $desa 
        ";
        $query=$this->db->query($sql);
       //echo $this->db->last_query();
        return $query;
    }

    public function lapRawatJalanPoli($unit,$unit_details,$tgl_awal,$tgl_akhir,$kel,$pol,$pusk)
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
            $desa = "AND sp.NO_KEL = '".$kel."'";



        //code unit
  if($unit =='0')
    $unitx = '';
  else
    $unitx = "AND dmu.id_kategori='".$unit."'";

  $sql="SELECT lok.`idLoket`,lok.`tglKunjungan`,sp.`NO_MR`,sp.`noKartu`,sp.`NIK`,sp.`NAMA_LGKP`,lok.`umur`, kel.`NAMA_KEL`,sp.`NO_RT`,sp.`NO_RW`,kec.`NAMA_KEC`,sadar.`nmSadar`,IF(sp.`JENIS_KLMIN`='1','L','P') jnis_kel,sp.`ALAMAT`,sa.`terapi`,IF (sp.`noKartu`!='','BPJS','NON BPJS') kategori,
  sa.`sistole`,sa.`diastole`,sa.`respRate`,sa.`heartRate`,sa.`catatan`,GROUP_CONCAT(DISTINCT CONCAT('(',sdd.`kdDiagnosa`,') ',sdd.`nmDiagnosa`) SEPARATOR ', ') diagnosa, GROUP_CONCAT(DISTINCT CONCAT('(',st.`kdTindakan`,') ',st.`nmTindakan`) SEPARATOR ', ') tindakan,GROUP_CONCAT(DISTINCT CONCAT(po.`nama_obat`,' ',po.`dosis_pakai`) SEPARATOR ', ') obat,IF (lok.`kunjBaru`='true','baru','lama') kasus,lok.`keluhan`,
  srl.`jnsRujukLanjut`,srl.`nmppk`,sss.`nmSubSpesialis`,ss.`nmSpesialis`,spn.`tujuanPoli`,prv.`nmProvider`,fktl.`nmPoli` AS nmRujLan,rst.`status` as nmStatusPulang
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
  LEFT JOIN simpus_rujuk_lanjut srl ON srl.`loketID`=lok.`idLoket`
  LEFT JOIN simpus_subspesialis sss ON srl.`kdSubSpesialis`=sss.`kdSubSpesialis`
  LEFT JOIN simpus_spesialis ss ON ss.`kdSpesialis`=sss.`kdSpesialis`
  LEFT JOIN simpus_provider prv ON prv.`kdProvider`=srl.`kdppk`
  LEFT JOIN simpus_poli_fktl fktl ON fktl.`kdPoli`=srl.`kdPoliRujLan`
  INNER JOIN simpus_ranap rnp ON rnp.`pelayananId`=spn.`idpelayanan`
  LEFT JOIN simpus_ranap_status rst ON rst.`id`=rnp.`pulangStatus`
  
#code unit
  INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=lok.`unitId` 
  INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

  WHERE 
  spn.`kdPoli`='".$pol."'

  AND lok.`tglKunjungan` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
  $unitx
  $idpkm
  $unit_details_x
  $desa
  GROUP BY spn.`idpelayanan`
  ";
  $query=$this->db->query($sql);
		//echo $this->db->last_query();
  return $query;
}







}