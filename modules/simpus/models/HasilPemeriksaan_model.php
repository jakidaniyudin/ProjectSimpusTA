<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'core/BaseModel.php';
class HasilPemeriksaan_model extends BaseModel
{
    protected $table = 'hasil_pemeriksaan';

    public function create($batch_data)
    {
        try {
            $this->db->insert_batch($this->table, $batch_data);
            return true;
        } catch (Exception $e) {
            throw new Exception('Ada kesalahan server: ' . $e->getMessage(), 500);
        }
    }
    public function update($data)
    {
        $this->db->update_batch($this->table, $data, 'id');
        return $this->db->affected_rows();
    }

    public function get($limit = null) {}
    public function deleteByPemeriksaanRecordDetail($id)
    {
        try {
            return $this->db
                ->where('id_pemeriksaan_record_detail', $id)
                ->delete('hasil_pemeriksaan');
        } catch (ServiceException $e) {
            throw new ServiceException('penyimpanan gagal', 500);
        }
    }



    public function getByRecordDetail($idRecordDetail)
    {
        try {
            return $this->db->where('id_pemeriksaan_record_detail', $idRecordDetail)->from('hasil_pemeriksaan')->get()->result();
        } catch (ServiceException $e) {
            throw new ServiceException('penyimpanan gagal', 500);
        }
    }
}
