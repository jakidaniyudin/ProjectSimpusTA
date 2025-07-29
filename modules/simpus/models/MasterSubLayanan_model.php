<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'core/BaseModel.php';
class MasterSubLayanan_model extends BaseModel
{
    protected $table = 'master_sub_layanan';


    public function getByName($namaSubLayanan)
    {
        try {
            return $this->db->select('id')->where('nama', $namaSubLayanan)->from($this->table)->get()->row();
        } catch (ServiceException $e) {
            throw new ServiceException('failed request', 500, $e->get_message());
        }
    }
}