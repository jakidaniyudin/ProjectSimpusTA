<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obstetri_model extends CI_Model
{

	public function getAll($parameters = null)
	{
		$this->db->select('*');
		$this->db->from('obstetri_master');
		$data = $this->db->get();
		return $data;
	}
	// function getbyId
	public function getById($pasien_id)
	{
		$data = $this->db->get_where('obstetri_master', ['pasienId' => $pasien_id]);
		return $data;
	}
	// function create
	public function create($parameters = null)
	{
		if (is_array($parameters)) {
			$parameters['create_at'] = date('Y-m-d H:i:s'); // Format datetime
			$parameters['update_at'] = date('Y-m-d H:i:s');
		}

		return $this->db->insert('obstetri_master', $parameters);
	}

	public function createImun($parameters = null)
	{
		return $this->db->insert_batch('simpus_imunization_obstetri_statys', $parameters);
	}

	public function update($parameters, $pasien_id)
	{

		if (is_array($parameters)) { // Format datetime
			$parameters['update_at'] = date('Y-m-d H:i:s');
		}

		$this->db->where('pasienId', $pasien_id);
		return $this->db->update('obstetri_master', $parameters);
	}




	// function delete
	public function delete($parameters = null) {}
}
