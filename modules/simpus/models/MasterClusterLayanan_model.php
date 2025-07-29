<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once 'core/BaseModel.php';

class MasterClusterLayanan_model extends BaseModel
{

    protected $table = 'master_cluster_layanan';

    public function get()
    {
        try {
            return $this->db->select('*')->from($this->table)->get()->result();
        } catch (ServiceException $e) {
            throw new ServiceException('request failed', 500, $e->getMessage());
        }
    }
}