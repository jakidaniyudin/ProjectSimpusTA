<?php

require_once 'core/BaseModel.php';

class MasterRiwayat_model extends BaseModel
{
    protected $table = 'master_riwayat';


    public function get($lenght, $start, $search = null){
        
    
        
        $this->db->from($this->table);
        if($search){
            $this->db->like('code', $search);
            $this->db->or_like('value_set', $search);
        }
        
        // untuk limit pagination
        $this->db->limit($lenght, $start);
        return $this->db->get()->result();
      
    
    }

    public function count_all(){
        return $this->db->count_all($this->table);
    }

    // fungsi untuk menghitung total data setelah filter
    public function count_filtered($search){
        if($search){
            $this->db->like('code', $search);
            $this->db->or_like('value_set', $search);
        }
        return $this->db->count_all_results($this->table);

    }
}