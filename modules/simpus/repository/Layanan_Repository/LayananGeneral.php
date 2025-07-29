<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/interfaceLayanan.php');
class LayananGeneral  implements interfaceLayanan
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        $this->CI->load->model('IndeksKIA_model');
        $this->CI->load->model('MasterLayanan_model');
    }
    public function load_form($load, $pasien_id) {}
    public function checkStatusPelayanan($pasien_id)
    {
        $result = $this->CI->IndeksKIA_model->check($pasien_id);
        return $result;
    }
    public function setPelayanan($pasien_id, $pelayanan)
    {
        $valid =  $this->CI->IndeksKIA_model->chekValidPasien($pasien_id);
        $validLayanan =  $this->CI->MasterLayanan_model->getByName($pelayanan);
        if ($valid == null && empty($valid) && $validLayanan == null && empty($validLayanan)) {
            throw new Exception('Pasien tidak terdaftar', 404);
        }

        $result = $this->CI->IndeksKIA_model->set($pasien_id, $pelayanan);
        return $result;
    }
    public function set($pasien_id, $pelayanan) {}
    public function update($pasien_id, $pelayanan_id) {}
    public function dataPrepare() {}
}
