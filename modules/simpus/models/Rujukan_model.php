<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rujukan_model extends CI_Model {

    var $table = 'simpus_rujuk_lanjut AS a';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('c.NIK','c.NAMA_LGKP','b.nmProvider'); //set column field database for datatable searchable 
    var $order = array('a.loketID'); // default order 
    



    private function _get_datatables_query()
    {

        //add custom filter here

      $this->db->select('a.*,a.id as id_rujuk,b.*,c.*,d.*,e.*,f.*,g.*,h.*');




      // $where="(a.`jnsRujukLanjut`='umum')";
      //       $this->db->where($where);

      if($this->input->post('PUSK_ID'))
      {
        $this->db->where('puskId', $this->input->post('PUSK_ID'));
    }

    if($this->input->post('provd'))
    {
        $this->db->where('kdppk', $this->input->post('provd'));
    }
     if($this->input->post('jnsKepes'))
    {
        $this->db->where('jnsRujukLanjut', $this->input->post('jnsKepes'));
    }

    if($this->input->post('tglRujukan'))
      {
        $this->db->where('a.`tglEstRujuk`',$this->input->post('tglRujukan'));
    }
    // if($this->input->post('tgl_akhir'))
    //   {
    //     $tglAkhir=$this->input->post('tgl_akhir');
    // }

           
    //$this->db->where('a.`active`="0" ');

    $this->db->join('simpus_loket as b','a.`loketID`=b.`idLoket`','inner');
    $this->db->join('simpus_pasien as c','b.`pasienId`=c.`ID`','inner');
    $this->db->join('simpus_provider as d','a.`kdppk`=d.`kdProvider`','inner');
    $this->db->join('unit_profiles as e','b.`puskId`=e.`unit_id`','inner');
     $this->db->join('simpus_subspesialis as f','a.`kdSubSpesialis`=f.`kdSubSpesialis`','left');
     $this->db->join('simpus_poli_fktl as g','a.`kdPoliRujLan`=g.`kdPoli`','left');
     $this->db->join('simpus_pelayanan as h','b.`idLoket`=h.`loketId`','inner');

    $this->db->limit(10);

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


    public function iSuratRujukan($path)
    {
        error_reporting(0);
        include(APPPATH.'liibraries/PHPJasperXML/class/tcpdf/tcpdf.php');
        include(APPPATH.'libraries/PHPJasperXML/class/PHPJasperXML.inc.php');
        
        $server = "localhost";
        $user = "root";
        $pass = "sungram@database";
        $db = "newsimpus_dev";
        
        $PHPJasperXML = new PHPJasperXML(); 
        // $PHPJasperXML->debugsql=true;
         $PHPJasperXML->arrayParameter = array('para1'=>'1');
        $PHPJasperXML->load_xml_file($path); 
       // $dbdriver="mysqli";

        $PHPJasperXML->transferDBtoArray($server, $user, $pass, $db);
        $PHPJasperXML->outpage('I'); 
    } 


}