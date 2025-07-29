<?php 

class PelayananRecordDetail_model extends CI_Model{
    
    protected $table =  'pemeriksaan_record_detail';
    public function updateEcounter ($loket, $ecounter) {
        try {
            $this->db->trans_begin();
            $json_response = json_encode($ecounter, JSON_UNESCAPED_UNICODE);
            $this->db->where('id_loket', $loket)->update($this->table, [
                'ecounter_log' => $json_response
            ]);
            $this->db->trans_commit();
        } catch (ServiceException $e) {
            throw new ServiceException('update gagal', 500, $e->getMessage());
        }
    }
}