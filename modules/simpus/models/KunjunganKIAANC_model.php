<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KunjuNganKIAANC_modeL extends CI_Model
{
    public function getKunjugan($loket_id, $pasien_id)
    {
        $this->db->select('*');
        $this->db->where('loketId', $loket_id);
        $this->db->where('pasienId', $pasien_id);
        $data = $this->db->get();
        return $data;
    }
    public function create($parameter = null)
    {

        if (is_array($parameters)) {
            $parameters['create_at'] = date('Y-m-d H:i:s'); // Format datetime
            $parameters['update_at'] = date('Y-m-d H:i:s');
        }
        $this->db->insert('kunjungan_kia_anc', $parameter);
    }
    public function update($parameter = null, $loket_id)
    {
        $parameter['udapte_at'] =  date('Y-m-d H:i:s');
        $this->db->where('loketId', $loket_id);
        $this->db->update('kunjungan_kia_anc', $parameter);
    }
}