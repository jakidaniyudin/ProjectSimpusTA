<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Profil_model extends CI_Model {
 
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
    private function _get_datatables_query()
    {
         
       $this->db->select('a.*,c.*,d.*,b.NO_MR,b.NO_MR_LAMA,b.NAMA_LGKP,b.NIK,b.NO_PROP,b.NO_KAB,b.NO_KEC,b.NO_KEL,b.ALAMAT,b.NO_RT,b.NO_RW,b.noKartu,b.kdProvider');

		
        if($this->input->post('tglKunjungan'))
        {
            $tglKunjungan=date("Y-m-d",strtotime($this->input->post('tglKunjungan')));
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
        $this->db->where('a.pusk_id', $this->getId());
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
 


    //============ LAPORAN ====== //
    public function get_lap_reg_kunj_pas($unit_details,$tgl_awal,$tgl_akhir,$kel)
    {
        if($this->getId() != '46')
            $idpkm =" AND sk.PUSK_ID='".$this->getId()."' ";
        else
            $idpkm = '';

        $tglAwal=date("Y-m-d",strtotime($tgl_awal));
        $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

        if($unit_details == '0')
            $unit_details_x = "";
        else
            $unit_details_x = "AND sk.`id_unit`= '".$unit_details."'";

        if($kel == '0')
            $desa = "";
        else
            $desa = "AND sp.no_kel = '".$kel."'";


        $sql="SELECT sp.`ID`,DATE_FORMAT(sk.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,sp.`KEL_UMUR`,sp.`JENIS_KLMIN`, sk.`kdPoli`,sk.`kdPoliRujukInternal`,sk.kunjBaru
        FROM simpus_kunjungan sk
        INNER JOIN simpus_pasien sp ON sp.`ID`=sk.`pasien_id`
        INNER JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC`
        INNER JOIN setup_kel kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL`
        WHERE 
        sp.`NO_KAB`='10' AND sp.`NO_PROP`='35'
        AND kel.`NO_KAB`='10' AND kel.`NO_PROP`='35'
        AND kec.`NO_KAB`='10' AND kec.`NO_PROP`='35'
        AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        $idpkm
        $unit_details_x
        $desa 
        ";
        $query=$this->db->query($sql);
        //echo $this->db->last_query();
        return $query;
    }
    public function get_lap_bulanan_data_kunj($unit_details,$tgl_awal,$tgl_akhir,$kel)
    {
       if($this->getId() != '46')
            $idpkm =" AND sk.PUSK_ID='".$this->getId()."' ";
        else
            $idpkm = '';

        $tglAwal=date("Y-m-d",strtotime($tgl_awal));
        $tglAkhir=date("Y-m-d",strtotime($tgl_akhir));

        if($unit_details == '0')
            $unit_details_x = "";
        else
            $unit_details_x = "AND sk.`id_unit`= '".$unit_details."'";

        if($kel == '0')
            $desa = "";
        else
            $desa = "AND sp.no_kel = '".$kel."'";


        $sql="SELECT sp.`ID`,DATE_FORMAT(sk.`tglKunjungan`,'%d-%m-%Y') AS tgl_kunjung,sp.`NAMA_LGKP`,sp.`ALAMAT`,kec.`NAMA_KEC`,sp.`NO_KEL`,kel.`NAMA_KEL`,sp.`NO_MR`,sp.`noKartu`,sp.`KEL_UMUR`,sp.`JENIS_KLMIN`, sk.`kdPoli`,sk.`kdPoliRujukInternal`,sk.kunjBaru
        FROM simpus_kunjungan sk
        INNER JOIN simpus_pasien sp ON sp.`ID`=sk.`pasien_id`
        INNER JOIN setup_kec kec ON kec.`NO_KEC`=sp.`NO_KEC`
        INNER JOIN setup_kel kel ON kel.`NO_KEC`=kec.`NO_KEC` AND kel.`NO_KEL`=sp.`NO_KEL`
        WHERE 
        sp.`NO_KAB`='10' AND sp.`NO_PROP`='35'
        AND kel.`NO_KAB`='10' AND kel.`NO_PROP`='35'
        AND kec.`NO_KAB`='10' AND kec.`NO_PROP`='35'
        AND tglKunjungan BETWEEN '".$tglAwal."' AND '".$tglAkhir."'
        $idpkm
        $unit_details_x
        $desa 
        ";
        $query=$this->db->query($sql);
        return $query;
    }








 
}