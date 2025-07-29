<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnosa_model extends CI_Model {

    var $table = 'simpus_diagnosa as a';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('kdDiag','nmDiag'); //set column field database for datatable searchable 
    var $order = array('id'=>'asc'); // default order 



    private function _get_datatables_query()
    {

        $this->db->where('f3','');      

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
        $this->db->where('f3','');
        return $this->db->count_all_results();
    }

     private function _get_datatables_query_sehat()
    {



        if($this->input->post('xxxx'))
        {
            $this->db->where('xxxx', $this->input->post('xxx'));
        }

        if($this->input->post('yyy'))
        {
            $this->db->where('yyy', $this->input->post('yyy'));
        }
        $this->db->where('f3','');
        $this->db->where('kunjSehat','1');
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

    public function get_datatables_sehat()
    {
        $this->_get_datatables_query_sehat();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_sehat()
    {
        $this->_get_datatables_query_sehat();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_sehat()
    {
        $this->db->from($this->table);
        $this->db->where('f3','');
        return $this->db->count_all_results();
    }

    public function getDiagnosaAll($limit)
    {
        $this->db->select('id,kdDiag,nmDiag');
        $this->db->where('f3','');
        return $this->db->get($this->table,$limit);
    }



    public function get_diagnosa($n){
    if ($n== '1') {
        $diagnosa= "wabah=1";
    }else if ($n== '2') {
        $diagnosa= "surveilans=1";
    }else if($n == '3'){
        $diagnosa= "jiwa=1";
    }else if($n == '4'){
        $diagnosa= "ptm=1";
    }else if ($n == '5'){
        $diagnosa= "non=1";
    }else if ($n == '6'){
        $diagnosa= "gigi=1";
    }else if ($n == '7'){
        $diagnosa= "diare=1";
    }else if ($n == '8'){
        $diagnosa= "klorea=1";
    }else if ($n == '9'){
        $diagnosa= "dhf=1";
    }else if ($n == '10'){
        $diagnosa= "tbparu=1";
    }else if ($n == '11'){
        $diagnosa= "diphteri=1";
    }else if ($n == '12'){
        $diagnosa= "hepatitis=1";
    }else if ($n == '13'){
        $diagnosa= "campak=1";
    }else if ($n == '14'){
        $diagnosa= "rabies=1";
    }else if ($n == '15'){
        $diagnosa= "tetneo=1";
    }else if ($n == '16'){
        $diagnosa= "influinza=1";
    }else if ($n == '17'){
        $diagnosa= "thypoid=1";
    }else if ($n == '18'){
        $diagnosa= "cikungunya=1";
    }else if ($n == '19'){
        $diagnosa= "leptosperosis=1";
    }else if ($n == '20'){
        $diagnosa= "kunjkasuslama=1";
    }else if ($n == '21'){
        $diagnosa= "telinga=1";
    }else if ($n == '22'){
        $diagnosa= "mata=1";
    }else if ($n == '23'){
        $diagnosa= "katarak=1";
    }else{
        $diagnosa= "non_spes=1";
    }

    $sql = "SELECT * FROM simpus_diagnosa WHERE $diagnosa";
    $query=$this->db->query($sql);
    return $query;

}

//---------list diagnosa----------//

 function getDataDiagnosa($idLoket)
   {
    $this->db->select('a.*,b.*,c.nmPoli,klb,b.id as kasusId');
    $this->db->join('master_diagnosa_kasus AS b', 'a.diagnosaKasus=b.id','left');
    $this->db->join('simpus_poli_fktp AS c', 'a.kdPoli=c.kdPoli','left');
    $this->db->join('simpus_diagnosa AS d', 'd.kdDiag=a.kdDiagnosa','left');
    $this->db->where('loketId',$idLoket);
    $this->db->where('a.kdDiagnosa <>',"");
    $this->db->order_by('a.createdDate','ASC');
    return $this->db->get('simpus_data_diagnosa AS a');
   }
   function getDataDiagnosaForApotek($idLoket)
   {
    $this->db->select('kdDiagnosa,nmDiagnosa');
    $this->db->where('a.kdDiagnosa <>',"");
    $this->db->where('loketId',$idLoket);
    return $this->db->get('simpus_data_diagnosa AS a');
   }
   function getDataDiagnosaAsuhan($idLoket)
   {
    $this->db->select('a.*,b.*,c.nmPoli,klb,b.id as kasusId');
    $this->db->join('master_diagnosa_kasus AS b', 'a.diagnosaKasus=b.id','left');
    $this->db->join('simpus_poli_fktp AS c', 'a.kdPoli=c.kdPoli','left');
    $this->db->join('simpus_diagnosa AS d', 'd.kdDiag=a.kdDiagnosa','left');
    $this->db->where('loketId',$idLoket);
    $this->db->where('a.kdDiagnosa',NULL);
    $this->db->order_by('a.createdDate','ASC');
    return $this->db->get('simpus_data_diagnosa AS a');
   }



}