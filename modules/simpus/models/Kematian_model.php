<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kematian_model extends CI_Model {

	var $table = 'simpus_catatan_kematian as a';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('b.NAMA_LGKP','b.ALAMAT','d.nama_unit','b.NIK','b.noKartu','b.NO_MR','b.NO_KK'); //set column field database for datatable searchable 
    var $order = array('idCatatan'=>'desc'); // default order 



    public function getId()
    {
    	$user_id = $this->session->userdata('user_id');
    	$this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
    	return $this->id;
    }


    private function _get_datatables_query()
    {

    	$this->db->select('*,kec.NAMA_KEC,kel.NAMA_KEL');


    	if($this->input->post('tglKunjungan'))
    	{
    		$tglKunjungan=date("Y-m-d",strtotime($this->input->post('tglKunjungan')));
    		$this->db->where('a.tglKematian', $tglKunjungan);
    	}

    	$this->db->join('simpus_pasien as sp','a.pasienId = sp.ID','left');
        $this->db->join('setup_kec as kec','kec.NO_KEC=sp.NO_KEC AND kec.NO_KAB = sp.NO_KAB AND kec.NO_PROP=sp.NO_PROP','left');
        $this->db->join('setup_kel as kel','kel.NO_KEC=sp.NO_KEC AND kel.NO_KEL=sp.NO_KEL AND kel.NO_KAB=sp.NO_KAB AND kel.NO_PROP=sp.NO_PROP','left');


        if($this->getId().$this->id!=46){
          $this->db->where('a.puskId', $this->getId());
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

    public function lapRawatJalanPoli($unit,$unit_details,$tgl_awal,$tgl_akhir,$diagnosa)
{
  if($this->getId() != '46')
    $idpkm =" AND kem.`puskId`='".$this->getId()."' ";
  else
    $idpkm = '';

  $tglAwal=date("Y-m-d",strtotime($tgl_awal));
  $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

  if($unit_details == '0')
    $unit_details_x = "";
  else
    $unit_details_x = "AND kem.`puskId`= '".$unit_details."'";


if($unit =='0')
    $unitx = '';
  else
    $unitx = "AND dmu.id_kategori='".$unit."'";


  $sql="SELECT kem.*,sp.`NO_MR`,sp.`noKartu`,sp.`NIK`,sp.`NAMA_LGKP`, kel.`NAMA_KEL`,sp.`NO_RT`,sp.`NO_RW`,kec.`NAMA_KEC`,IF(sp.`JENIS_KLMIN`='1','L','P') jnis_kel,sp.`ALAMAT`,IF (sp.`noKartu`!='','BPJS','NON BPJS') kategori
  FROM simpus_catatan_kematian kem
  INNER JOIN simpus_pasien sp ON sp.`ID`=kem.`pasienId`
  LEFT JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC` AND kec.`NO_KAB` = sp.`NO_KAB` AND kec.`NO_PROP`=sp.`NO_PROP` 
  LEFT JOIN setup_kel kel ON kel.`NO_KEC`=sp.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL` AND kel.`NO_KAB`=sp.`NO_KAB` AND kel.`NO_PROP`=sp.`NO_PROP`

  #code unit
  INNER JOIN data_master_unit_detail dmud ON dmud.`id_detail`=kem.`puskId` 
  INNER JOIN data_master_unit dmu ON dmu.`id_kategori`=dmud.`id_kategori`

  WHERE 
  kem.`tglKematian` BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
  $unitx
  $idpkm
  $unit_details_x
  ";
  $query=$this->db->query($sql);
//echo $this->db->last_query();
  return $query;
}

}