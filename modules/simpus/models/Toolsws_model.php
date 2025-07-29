<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toolsws_model extends CI_Model {

	var $table = 'simpus_loket as a';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('b.NAMA_LGKP','b.ALAMAT','d.nama_unit','b.NIK','b.noKartu','b.NO_MR','b.NO_KK'); //set column field database for datatable searchable 
    var $order = array('idLoket'=>'desc'); // default order 



    public function getId()
    {
    	$user_id = $this->session->userdata('user_id');
    	$this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
    	return $this->id;

    }
    public function get_kategori_unit($unit)
    {
    	$sql = "SELECT kategori FROM `data_master_unit` WHERE id_kategori = '".$unit."'";
    	$query=$this->db->query($sql);
    	return $query;
    }
    public function get_unit_details($unit_details)
    {
    	$sql = "SELECT nama_unit FROM `data_master_unit_detail`WHERE id_detail= '".$unit_details."'";
    	$query=$this->db->query($sql);
    	return $query;
    }

    //========== LOKET =============//
    private function _get_datatables_query()
    {

    	$this->db->select('b.ID,c.idpelayanan,c.sudahDilayani,a.*,d.*,b.NO_MR,b.NO_MR_LAMA,b.NAMA_LGKP,b.NIK,b.NO_PROP,b.NO_KAB,b.NO_KEC,b.NO_KEL,b.ALAMAT,b.NO_RT,b.NO_RW,b.noKartu,b.kdProvider,mal.nmMal');


    	if($this->input->post('tahun'))
    	{
    		$tahun=$this->input->post('tahun');
    		$this->db->where('YEAR(a.tglKunjungan)', $tahun);
    	}
        if($this->input->post('bulan'))
        {
            $bulan=$this->input->post('bulan');
            $this->db->where('MONTH(a.tglKunjungan)', $bulan);
        }
    	if($this->input->post('unitId'))
    	{

    		$this->db->where('a.unitId', $this->input->post('unitId'));
    	}

        // $tgl_now = date('Y-m-d');
        // $date = date_create($tgl_now);
        // date_add($date, date_interval_create_from_date_string('-6 month'));
        // $tgl_akhir = date_format($date, 'Y-m-d');

        // $dateRang="a.`tglKunjungan` between '".$tgl_akhir."' AND '".$tgl_now."'";

        $wew="b.`noKartu` <> '' AND (a.`noUrut` = '' OR a.`noUrut` IS NULL) AND (a.`statusKartu`='AKTIF' OR a.`statusKartu`='') AND b.`kdProvider`='".$this->base_model->pcare('KODE_PPK')."'";
        $this->db->where($wew); 
        // $this->db->where($dateRang); 
    	$this->db->join('simpus_pasien as b','a.pasienId = b.ID','left');
    	$this->db->join('simpus_pelayanan as c','a.idLoket = c.loketId','inner');
        $this->db->join('simpus_master_mal as mal','mal.idMal = c.kdKegiatanPel','left');
        $this->db->join('data_master_unit_detail as d','a.unitId = d.id_detail');
        if($this->getId().$this->id!=46){
          $this->db->where('a.puskId', $this->getId());
      }
      $this->db->group_by("idLoket");
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


    //PELAYANAN
    var $table2 = 'simpus_pelayanan as pel';
    var $column_order2 = array(); //set column field database for datatable orderable
    var $column_search2 = array('NAMA_LGKP','pasien.ALAMAT','nama_unit','NIK','loket.noKartu','NO_MR','NO_KK'); //set column field database for datatable searchable 
    var $order2 = array('idpelayanan'=>'desc'); // default order 



    private function _get_datatables_query2()
    {

        $this->db->select('idpelayanan,pasien.NO_PROP,pasien.NO_KAB,pasien.NO_KEC,pasien.NO_KEL,tglKunjungan,NIK,pasien.noKartu,NAMA_LGKP,NO_MR,pasien.ALAMAT,NO_RT,NO_RW,statusKartu, pel.noKunjungan,loket.noUrut,pel.pelIdSebelum,pel.kdPoli,unit.nama_unit,pel.sudahDilayani,pasien.ID,nmStatusPulang,tujuanPoli,pel.kunjSakitPel');


        if($this->input->post('id_detail'))
        {
            $this->db->where('unit.id_detail', $this->input->post('id_detail'));
        }
 

        if($this->input->post('tahun'))
        {
            $tahun=$this->input->post('tahun');
            $this->db->where('YEAR(loket.tglKunjungan)', $tahun);
        }
        if($this->input->post('bulan'))
        {
            $bulan=$this->input->post('bulan');
            $this->db->where('MONTH(loket.tglKunjungan)', $bulan);
        }
        if($this->input->post('poli'))
        {
            $poli=$this->input->post('poli');
            $this->db->where('pel.kdPoli', $poli);
        }

        $this->db->join('simpus_loket as loket','pel.loketId = loket.idLoket');
        $this->db->join('simpus_pasien as pasien','pasien.ID = loket.pasienId');
        $this->db->join('simpus_poli_fktp as pol','pol.kdPoli = pel.kdPoli');
        $this->db->join('data_master_unit_detail as unit','unit.id_detail = loket.unitId');
        $this->db->join('simpus_statuspulang as plg','pel.kdStatusPulang = plg.kdStatusPulang','left');
        

        if($this->getId().$this->id!=46){
            $this->db->where('puskId', $this->getId());
            $where="(loket.`noUrut` <> '' AND pel.`pelIdSebelum`=0 AND (pel.`noKunjungan`='' OR pel.`noKunjungan` IS NULL))";
            $this->db->where($where);
        }

        if($this->input->post('unitId'))
        {

            $this->db->where('loket.unitId', $this->input->post('unitId'));
        }

        $this->db->where('pol.pelayanan', 'TRUE');

        $this->db->from($this->table2);
        $i = 0;


        foreach ($this->column_search2 as $item) // loop column 
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

                if(count($this->column_search2) - 1 == $i) //last loop
                {
                  $this->db->group_end(); //close bracket
              }
          }
          $i++;
      }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order2))
        {
            $order = $this->order2;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables2()
    {
        $this->_get_datatables_query2();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
      // echo $this->db->last_query();
        return $query->result();
    }

    public function count_filtered2()
    {
        $this->_get_datatables_query2();
        $query = $this->db->get();
        return $query->num_rows();
    }


}