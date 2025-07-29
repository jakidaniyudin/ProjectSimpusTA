<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BaseModel extends CI_Model
{
    protected $table;

    public function start_transaksi()
    {
        $this->db->trans_start();
    }

    public function trans_commit()
    {
        $this->db->trans_complete();
    }

    public function __construct()
    {
        parent::__construct();
        if (!$this->table) {
            throw new Exception('Tabel is not define in child');
        }
    }
    public function executeQuery(callable $callback)
    {
        return $callback($this->db, $this->table);
    }
}