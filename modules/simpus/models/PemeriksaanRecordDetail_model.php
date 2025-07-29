<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'core/BaseModel.php';
class PemeriksaanRecordDetail_model extends BaseModel
{
    protected $table =  'pemeriksaan_record_detail';
    public function create($id_loket, $id_pemeriksaan_record, $id_nakes, $id_sub_layanan, $start)
    {
        try {
            $id = $this->uuid->v4();
            $end = date('Y-m-d H:i:s');
            $create_at = date('Y-m-d H:i:s');
            $update_at = date('Y-m-d H:i:s');
            $this->db->insert($this->table, [
                'id' => $id,
                'id_loket' =>  $id_loket,
                'id_pemeriksaan_record' =>  $id_pemeriksaan_record,
                'id_nakes' => $id_nakes,
                'id_sub_layanan' => $id_sub_layanan,
                'start' => $start,
                'end' => $end,
                'create_at' => $create_at,
                'update_at' => $update_at

            ]);
            return $id;
        } catch (ServiceException $e) {
            throw new ServiceException('peyimpanan gagal', 500, $e->get_message());
        }
    }

    public function get() {}

    public function getByLoket($idLoket, $subPlayanan)
    {
        try {
            return $this->db->select('id')->where('id_loket', $idLoket)->where('id_sub_layanan', $subPlayanan)->from($this->table)->get()->row();
        } catch (ServiceException $e) {
            throw new ServiceException('penyimpanan gagal', 500, $e->getMessage());
        }
    }
    public function update($start, $subPlayanan, $idLoket)
    {
        try {
            $end =  date('Y-m-d H:i:s');
            $update_at = date('Y-m-d H:i:s');
            $data = $this->db->where('id_loket', $idLoket)->where('id_sub_layanan', $subPlayanan)->update($this->table, [
                'start' =>  $start,
                'end' =>  $end,
                'update_at' =>  $update_at
            ]);

            if ($data)

                return $data;
        } catch (ServiceException $e) {
            throw new ServiceException('update gagal', 500, $e->getMessage());
        }
    }

    public function updateEcounter ($loket, $ecounter) {
        try {
            $json_response = json_encode($ecounter, JSON_UNESCAPED_UNICODE);
            $this->db->where('id_loket', $loket)->update($this->table, [
                'ecounter_log' => $json_response
            ]);
        } catch (ServiceException $e) {
            throw new ServiceException('update gagal', 500, $e->getMessage());
        }
    }

    public function delete() {}
}