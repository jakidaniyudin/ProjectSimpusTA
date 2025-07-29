<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/interfaceLayanan.php');

class LayananRepositoryNeonatus implements interfaceLayanan
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        $this->CI->load->model('IndeksKIA_model');
        $this->CI->load->model('MasterClusterLayanan_model');
        $this->CI->load->model('MasterLayanan_model');
        $this->CI->load->model('MasterSubLayanan_model');
        $this->CI->load->library(['session', 'encryption']);
    }
    public function load_form($load, $pasien_id)
    {
        try {
            $data['menus'] =  $this->dataPrepare();
            $data['pasien_id'] = $pasien_id;
            $load->view('pelayanan/KIA/Neonatus/v_navigation', $data);
        } catch (ServiceException $e) {
            throw new ServiceException('not found view', 500, $e->getMessage());
        }
    }

    public function checkStatusPelayanan($pasien_id)
    {
        $result = $this->CI->IndeksKIA_model->check($pasien_id);
        return $result;
    }
    public function setPelayanan($pasien_id, $pelayanan)
    {
        $valid =  $this->CI->IndeksKIA_model->chekValidPasien($pasien_id);
        $id_layanan = $this->CI->MasterLayanan_model->getByName($pelayanan);
        if ($valid == null && empty($valid) && $id_layanan == null && empty($id_layanan)) {
            throw new Exception('Pasien tidak terdaftar', 404);
        }
        $check =  $this->CI->IndeksKIA_model->cekStatusPemeriksaan($pasien_id, $id_layanan->id);
        if ($check) {
            if ($check->end == null) {
                return true;
            }
            $result = $this->CI->IndeksKIA_model->create($pasien_id, $id_layanan->id);
            return $result;
        } else {
            $result = $this->CI->IndeksKIA_model->create($pasien_id, $id_layanan->id);
            return $result;
        }
    }
    public function set($pasien_id, $pelayanan) {}
    public function update($pasien_id, $pelayanan_id) {}
    public function dataPrepare()
    {
        $result = $this->CI->MasterClusterLayanan_model->get();
        return $result;
    }
}
