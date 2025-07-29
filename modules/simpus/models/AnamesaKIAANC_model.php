<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KunjunganKIAANC_model extends CI_Model
{
    public function setKunjungan($parameter = null) {

        if (is_array($parameters)) {
			$parameters['create_at'] = date('Y-m-d H:i:s'); // Format datetime
			$parameters['update_at'] = date('Y-m-d H:i:s');
		}
        $this->db->insert->
    }
}