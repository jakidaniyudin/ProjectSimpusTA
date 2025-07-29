<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lab_model extends CI_Model {

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
        $where="(a.kdPoli = 004 OR a.kdPoliRujukInternal = 004)";
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

////=================================================================================================================
    //                                              LAPORAN - LAPORAN
    ////=================================================================================================================

    //1==========================================LAPORAN KEGIATAN LABORAT ==================================================
    function get_lap_keg_har($unit,$unit_details,$bulan,$tahun,$pusk)
    {
        if($pusk=='0')
            $idpkm ='';
        else
            $idpkm = " AND lok.puskId='".$pusk."' ";

       
        if($unit_details == '0')
            $unit_details_x = "";
        else
            $unit_details_x = "AND lok.unitId= '".$unit_details."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";   

        $sql="
        SELECT a.*,
        SUM(IF(DAY(tglKunjungan)=01 ,1,0)) AS tgl1,
        SUM(IF(DAY(tglKunjungan)=02 ,1,0)) AS tgl2,
        SUM(IF(DAY(tglKunjungan)=03 ,1,0)) AS tgl3,
        SUM(IF(DAY(tglKunjungan)=04 ,1,0)) AS tgl4,
        SUM(IF(DAY(tglKunjungan)=05 ,1,0)) AS tgl5,
        SUM(IF(DAY(tglKunjungan)=06 ,1,0)) AS tgl6,
        SUM(IF(DAY(tglKunjungan)=07 ,1,0)) AS tgl7,
        SUM(IF(DAY(tglKunjungan)=08 ,1,0)) AS tgl8,
        SUM(IF(DAY(tglKunjungan)=09 ,1,0)) AS tgl9,
        SUM(IF(DAY(tglKunjungan)=10 ,1,0)) AS tgl10,
        SUM(IF(DAY(tglKunjungan)=11 ,1,0)) AS tgl11,
        SUM(IF(DAY(tglKunjungan)=12 ,1,0)) AS tgl12,
        SUM(IF(DAY(tglKunjungan)=13 ,1,0)) AS tgl13,
        SUM(IF(DAY(tglKunjungan)=14 ,1,0)) AS tgl14,
        SUM(IF(DAY(tglKunjungan)=15 ,1,0)) AS tgl15,
        SUM(IF(DAY(tglKunjungan)=16 ,1,0)) AS tgl16,
        SUM(IF(DAY(tglKunjungan)=17 ,1,0)) AS tgl17,
        SUM(IF(DAY(tglKunjungan)=18 ,1,0)) AS tgl18,
        SUM(IF(DAY(tglKunjungan)=19 ,1,0)) AS tgl19,
        SUM(IF(DAY(tglKunjungan)=20 ,1,0)) AS tgl20,
        SUM(IF(DAY(tglKunjungan)=21 ,1,0)) AS tgl21,
        SUM(IF(DAY(tglKunjungan)=22 ,1,0)) AS tgl22,
        SUM(IF(DAY(tglKunjungan)=23 ,1,0)) AS tgl23,
        SUM(IF(DAY(tglKunjungan)=24 ,1,0)) AS tgl24,
        SUM(IF(DAY(tglKunjungan)=25 ,1,0)) AS tgl25,
        SUM(IF(DAY(tglKunjungan)=26 ,1,0)) AS tgl26,
        SUM(IF(DAY(tglKunjungan)=27 ,1,0)) AS tgl27,
        SUM(IF(DAY(tglKunjungan)=28 ,1,0)) AS tgl28,
        SUM(IF(DAY(tglKunjungan)=29 ,1,0)) AS tgl29,
        SUM(IF(DAY(tglKunjungan)=30 ,1,0)) AS tgl30,
        SUM(IF(DAY(tglKunjungan)=31 ,1,0)) AS tgl31,
        SUM(IF((kdStatusPulang!=4 AND kdStatusPulang!=6) OR kdStatusPulang IS NULL,1,0)) AS pkm,
        SUM(IF(kdStatusPulang=4 OR kdStatusPulang=6 ,1,0)) AS rujuk
        FROM (SELECT lok.puskId,lok.unitId,lok.tglKunjungan,tind.kdTindakan,tind.nmTindakan,pel.kdStatusPulang 
        FROM simpus_pelayanan pel
        INNER JOIN simpus_loket lok ON pel.loketId=lok.idLoket
        LEFT JOIN simpus_tindakan tind ON tind.loketId=lok.idLoket
        INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.unitId
        INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori

        WHERE month(lok.tglKunjungan) = '".$bulan."' AND year(lok.tglKunjungan) = '".$tahun."' 
        AND kdTindakan != '' and pemeriksaanId != ''

        $unitx
        $idpkm
        $unit_details_x
        ) a
        
        GROUP BY kdTindakan 
        ORDER BY kdTindakan ASC";
        $query=$this->db->query($sql);
       //echo $this->db->last_query();
        return $query;
    }


    function get_lap_reg($unit,$unit_details,$tgl_awal,$tgl_akhir,$pusk)
    {
         if($pusk=='0')
    $idpkm ='';
else
    $idpkm = " AND lok.puskId='".$pusk."' ";

        $tglAwal=date("Y-m-d",strtotime($tgl_awal));
        $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

        if($unit_details == '0')
            $unit_details_x = "";
        else
            $unit_details_x = "AND lok.unitId= '".$unit_details."'";

        //code unit
        if($unit =='0')
            $unitx = '';
        else
            $unitx = "AND dmu.id_kategori='".$unit."'";

     

        $sql="SELECT pel.loketId,pel.idpelayanan, lok.pasienId,lok.puskId,lok.unitId,lok.tglKunjungan,pas.JENIS_KLMIN,lok.jknPbi,pas.noKartu,
        st.kdTindakan,st.nmTindakan,pas.ID,pas.NAMA_LGKP,pas.ALAMAT,NO_RT,NO_RW,kec.NAMA_KEC,kel.NAMA_KEL
        FROM simpus_pelayanan pel
        INNER JOIN simpus_loket lok ON pel.loketId=lok.idLoket
        INNER JOIN simpus_pasien pas ON pas.ID=lok.pasienId
        LEFT JOIN simpus_tindakan st ON st.loketId=lok.idLoket
        INNER JOIN data_master_unit_detail dmud ON dmud.id_detail=lok.unitId
        INNER JOIN data_master_unit dmu ON dmu.id_kategori=dmud.id_kategori
        LEFT JOIN setup_kec kec ON kec.NO_KEC=pas.NO_KEC AND kec.NO_KAB = pas.NO_KAB AND kec.NO_PROP=pas.NO_PROP
        LEFT JOIN setup_kel kel ON kel.NO_KEC=kec.NO_KEC AND kel.NO_KEL=pas.NO_KEL AND kel.NO_KAB = pas.NO_KAB AND kel.NO_PROP=pas.NO_PROP
        WHERE 
        #st.kdTindakan LIKE '1.2.0.101.01.05%' and 
        #pel.kdPoli=004
        #AND 
        pel.tglPelayanan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        AND pemeriksaanId != ''

        $unitx
        $idpkm
        $unit_details_x
     
        GROUP BY pel.loketId
        ";
        $query=$this->db->query($sql);
        #echo $this->db->last_query();
        return $query;
    }










}