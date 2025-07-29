<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelayanan_model extends CI_Model {

	var $table = 'simpus_pelayanan as pel';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('NAMA_LGKP','pasien.ALAMAT','nama_unit','NIK','loket.noKartu','NO_MR','NO_KK'); //set column field database for datatable searchable 
    var $order = array('pel.createdDate'=>'desc'); // default order 



    public function getId()
    {
    	$user_id = $this->session->userdata('user_id');
    	$this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
    	return $this->id;

    }
    private function _get_datatables_query($pol)
    {

    	$this->db->select('idpelayanan,pasien.NO_PROP,pasien.NO_KAB,pasien.NO_KEC,pasien.NO_KEL,tglKunjungan,NIK,pasien.noKartu,NAMA_LGKP,NO_MR,pasien.ALAMAT,NO_RT,NO_RW,statusKartu, pel.noKunjungan,loket.noUrut,pel.pelIdSebelum,pel.kdPoli,unit.nama_unit,pel.sudahDilayani,pasien.ID,nmStatusPulang,tujuanPoli,pel.kunjSakitPel,id_encounter');


    	if($this->input->post('id_detail'))
    	{
    		$this->db->where('unit.id_detail', $this->input->post('id_detail'));
    	}

    	if($this->input->post('tglKunjungan'))
    	{
    		$tglKunjungan=date("Y-m-d", strtotime($this->input->post('tglKunjungan')));
    		$this->db->where('pel.tglPelayanan', $tglKunjungan);
    	}	

    	$this->db->join('simpus_loket as loket','pel.loketId = loket.idLoket');
        $this->db->join('simpus_pasien as pasien','pasien.ID = loket.pasienId');
        $this->db->join('data_master_unit_detail as unit','unit.id_detail = loket.unitId');
        $this->db->join('simpus_statuspulang as plg','pel.kdStatusPulang = plg.kdStatusPulang','left');
    	

    	if($this->getId().$this->id!=46){
            $this->db->where('puskId', $this->getId());
    		$where="(pel.`kdPoli`='".$pol."')";
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

    public function get_datatables($pol)
    {
    	$this->_get_datatables_query($pol);
    	if($_POST['length'] != -1)
    		$this->db->limit($_POST['length'], $_POST['start']);
    	$query = $this->db->get();
      // echo $this->db->last_query();
    	return $query->result();
    }

    public function count_filtered($pol)
    {
    	$this->_get_datatables_query($pol);
    	$query = $this->db->get();
    	return $query->num_rows();
    }


        //------------- list rujukan -------------/
    function getDataRujuk($idLoket)
   {
    $this->db->select('b.loketId,b.idpelayanan,b.pelIdSebelum,sp.kdStatusPulang,sp.nmStatusPulang,b.kdPoli,pol.`nmPoli` AS asal,b.tujuanPoli,pol2.`nmPoli` AS tujuan,b.startTime,b.sudahDilayani,b.endTime,b.createdBy,b.tglPindah');
    $this->db->join('simpus_pelayanan AS b', 'a.idLoket=b.loketId','inner');
    $this->db->join('simpus_poli_fktp AS pol', 'b.kdPoli=pol.kdPoli','left');
    $this->db->join('simpus_statuspulang AS sp', 'b.kdStatusPulang=sp.kdStatusPulang','left');
    $this->db->join('simpus_poli_fktp AS pol2', 'b.tujuanPoli=pol2.kdPoli','left');
    $this->db->where('loketId',$idLoket);
    $this->db->order_by('b.createdDate','desc');
    return $this->db->get('simpus_loket AS a');
   }

    //-- veset
    function getDataVisit($idLoket)
   {
    $this->db->select('a.*,b.*,c.nmPoli');
    $this->db->join('simpus_dokter AS b', 'a.kdDokter=b.kdDokter','inner');
    $this->db->join('simpus_poli_fktp AS c', 'a.kdPoli=c.kdPoli','left');
    $this->db->where('loketId',$idLoket);
    $this->db->where('pusk_id', $this->getId());
    return $this->db->get('simpus_visit AS a');
   }

     //-- anam reset
    function getDataAnam($idLoket)
   {
    $this->db->select('*');
    $this->db->join('simpus_dokter AS b', 'a.tenagaMedis=b.kdDokter','inner');
    $this->db->join('simpus_kesadaran AS c', 'a.kdSadar=c.kdSadar','left');
    $this->db->where('loketId',$idLoket);
    $this->db->where('pusk_id', $this->getId());
    return $this->db->get('simpus_anamnesa AS a');
   }
  
}