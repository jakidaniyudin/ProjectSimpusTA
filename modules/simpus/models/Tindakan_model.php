<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tindakan_model extends CI_Model {

    var $table = 'simpus_master_tindakan as a';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array('kode','nama_tindakan','nama_tindakan_indonesia','deskripsi'); //set column field database for datatable searchable 
    var $order = array('kode'=>'asc'); // default order 



    private function _get_datatables_query()
    {


        $this->db->where('deskripsi','ICD-9CM');
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


    // TINDAKAN LABORAT
    var $table_lab= 'simpus_master_tindakan_lab as a';
    var $column_order_lab = array(); //set column field database for datatable orderable
    var $column_search_lab = array('kode','nama_tindakan'); //set column field database for datatable searchable 
    var $order_lab = array('kode'=>'asc'); // default order 



    private function _get_datatables_query_lab()
    {



        $this->db->from($this->table_lab);
        $i = 0;


        foreach ($this->column_search_lab as $item) // loop column 
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

                if(count($this->column_search_lab) - 1 == $i) //last loop
                {
                  $this->db->group_end(); //close bracket
              }
          }
          $i++;
      }
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_lab[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order_lab))
        {
            $order = $this->order_lab;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables_lab()
    {
        $this->_get_datatables_query_lab();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_lab()
    {
        $this->_get_datatables_query_lab();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_lab()
    {
        $this->db->from($this->table_lab);
        return $this->db->count_all_results();
    }



    //=====================================================

    public function get_tindakan_by_kunjungan($id_kunjungan)
    {
        $sql="select * from simpus_kunjungan_tindakan as a inner join simpus_tindakan b on a.kdTindakan=b.kdTindakan where id_kunjungan='".$id_kunjungan."'";
        $query=$this->db->query($sql);
        return $query;
    }
    public function get_master_tindakan()
    {
        $sql="select * from simpus_master_tindakan as a ";
        $query=$this->db->query($sql);
        return $query;
    }
    function getDataTindakan($kat,$idLoket,$kdPoli)
    {
        if($kat=='lab')
        {
            $deskripsi="AND a.deskripsi='lab'";
        }
        else
        {
            $deskripsi="AND a.deskripsi='icd9cm'";
        }
        $sql="select a.*,b.`nmPoli` from simpus_tindakan AS a 
        left join simpus_poli_fktp b on a.`kdPoli`=b.`kdPoli`
        where a.`loketId`='".$idLoket."' $deskripsi";
        $query=$this->db->query($sql);
        return $query;
    }


}