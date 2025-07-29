<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'core/BaseModel.php';
class MasterLayanan_model extends BaseModel
{
    protected $table = 'master_layanan';
    public function set_master_layanan($parameters)
    {
        //generate uuid
        if (is_array($parameters)) {
            $parameters['create_at'] = date('Y-m-d H:i:s'); // Format datetime
            $parameters['update_at'] = date('Y-m-d H:i:s');
        }
        $this->db->insert('master_layanan', $parameters);
    }

    public function get_master_layanan()
    {
        try {
            return $this->db->select('*')->from($this->table)->get()->result();
        } catch (ServiceException $e) {
            throw new ServiceException('request failed', 500, $e->getMessage());
        }
    }

    public function getByName($namaLayanan)
    {
        try {
            return $this->db->select('id')->from($this->table)->where('nama', $namaLayanan)->get()->row();
        } catch (ServiceException $e) {
            throw new ServiceException('request failed', 500, $e->getMessage());
        }
    }
}