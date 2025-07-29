<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Ranap_detail_model extends CI_Model {
    
    var $table_anamnesa = 'simpus_ranap_anamnesa as a';
    var $order_anamnesa = array('tglAnamnesis'=>'asc');

    var $table_diagnosa = 'simpus_ranap_diagnosa as a';
    var $order_diagnosa = array('tglDiagnosa'=>'asc');

    var $table_tindakan = 'simpus_ranap_tindakan as a';
    var $order_tindakan = array('tglTindakan'=>'asc');

    var $table_visit = 'simpus_ranap_visit as a';
    var $order_visit = array('tglVisit'=>'asc');
    
    //anamnesa
    public function getId()
    {
        $user_id = $this->session->userdata('user_id');
        $this->id=$this->db->query("SELECT unit FROM users WHERE id='". $user_id ."'")->row('unit');
        return $this->id;

    }

    private function _get_dataanamnesa_query()
    {
         
        $this->db->select('a.*,b.nmSadar,c.nmDokter');
        $this->db->join('simpus_kesadaran as b','a.kdSadar = b.kdSadar','inner');
        $this->db->join('simpus_dokter as c','a.kdDokter = c.kdDokter','inner');
        $this->db->where('idKunjungan', $this->input->post('idKunjungan'));
        $this->db->where('pusk_id', $this->getId()); 
        $this->db->from($this->table_anamnesa);
        $i = 0;
        $order = $this->order_anamnesa;
        $this->db->order_by(key($order), $order[key($order)]);
    }
     public function get_dataanamnesa()
    {
        $this->_get_dataanamnesa_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    public function count_filtered_anamnesa()
    {
        $this->_get_dataanamnesa_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_anamnesa()
    {
        $this->db->from($this->table_anamnesa);
        return $this->db->count_all_results();
    }

    //diagnosa
    private function _get_datadiagnosa_query()
    {
         
        $this->db->select('a.*,b.kasus');
        $this->db->join('master_diagnosa_kasus as b','a.diagnosaKasus = b.id','inner');
        $this->db->where('idKunjungan', $this->input->post('idKunjungan')); 
        $this->db->from($this->table_diagnosa);
        $i = 0;
        $order = $this->order_diagnosa;
        $this->db->order_by(key($order), $order[key($order)]);
    }
     public function get_datadiagnosa()
    {
        $this->_get_datadiagnosa_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    public function count_filtered_diagnosa()
    {
        $this->_get_datadiagnosa_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_diagnosa()
    {
        $this->db->from($this->table_diagnosa);
        return $this->db->count_all_results();
    }

    //tindakan
    private function _get_datatindakan_query()
    {
         
        $this->db->select('a.*');
       // $this->db->join('master_diagnosa_kasus as b','a.diagnosaKasus = b.id','inner');
        $this->db->where('idKunjungan', $this->input->post('idKunjungan')); 
        $this->db->from($this->table_tindakan);
        $i = 0;
        $order = $this->order_tindakan;
        $this->db->order_by(key($order), $order[key($order)]);
    }
     public function get_datatindakan()
    {
        $this->_get_datatindakan_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    public function count_filtered_tindakan()
    {
        $this->_get_datatindakan_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_tindakan()
    {
        $this->db->from($this->table_tindakan);
        return $this->db->count_all_results();
    }

     //visit
    private function _get_datavisit_query()
    {
         
        $this->db->select('a.*,b.nmDokter');
        $this->db->join('simpus_dokter as b','a.kdDokter = b.kdDokter','inner');
        $this->db->where('idKunjungan', $this->input->post('idKunjungan')); 
        $this->db->from($this->table_visit);
        $i = 0;
        $order = $this->order_visit;
        $this->db->order_by(key($order), $order[key($order)]);
    }
     public function get_datavisit()
    {
        $this->_get_datavisit_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    public function count_filtered_visit()
    {
        $this->_get_datavisit_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_visit()
    {
        $this->db->from($this->table_visit);
        return $this->db->count_all_results();
    }
 
}