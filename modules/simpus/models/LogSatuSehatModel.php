<?php

class LogSatuSehatModel extends CI_Model {
    protected $table = 'pemeriksaan_record_detail';
    protected $tableSubLayananMaster = 'master_sub_layanan';
    protected $tablemasterLayanan = 'master_layanan';

    public function getLogRecord ($idLoket, $idLayanan){
        return $this->db->select(['prd.*', 'msl.nama AS sub_layanan '])
                -> from($this->table . ' prd')
                -> join($this->tableSubLayananMaster . ' msl','prd.id_sub_layanan =  msl.id')
                -> join($this->tablemasterLayanan . ' ml', 'msl.id_layanan =  ml.id')
                -> where('prd.id_loket', $idLoket)
                -> where('ml.nama', $idLayanan)
                ->where("prd.ecounter_log IS NOT NULL AND prd.ecounter_log != ''", null, false)
                -> get()->result();

    }
}