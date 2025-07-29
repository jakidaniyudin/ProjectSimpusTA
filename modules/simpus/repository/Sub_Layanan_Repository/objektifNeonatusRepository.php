<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php');
class objektifNeonatusRepository  implements InterfaceSubLayanan
{
    protected $ci;
    protected $apgar1Id = '1b4dabd6-fefb-11ef-9bfc-bc24113678a5';
    protected $apgar5Id = 'a11cda23-ffdd-11ef-9bfc-bc24113678a5';
    protected $apgar10Id = 'd5d074f2-ffdd-11ef-9bfc-bc24113678a5';
    protected $kn0 = '4743b8bf-4925-11f0-bd23-bc24113678a5';
    protected $kn1 = '63a1b2cb-4925-11f0-bd23-bc24113678a5';
    protected $kn2 = '833fd45d-4925-11f0-bd23-bc24113678a5';
    protected $kn3 = '9edfc2dc-4925-11f0-bd23-bc24113678a5';
    protected $fisikBayiId = 'bf2aad27-4925-11f0-bd23-bc24113678a5';
    protected $BBId = 'e30f7171-4925-11f0-bd23-bc24113678a5';

    public function __construct(){
        $this->ci = &get_instance();
        $this->ci->load->model('IndeksKIA_model');
        $this->ci->load->model('MasterSubLayanan_model');
    }
    public function loadForm($load, $session, $encryption, $model)
    {
        $data =  $this->get_session($session, $encryption);
        $parameter = [
            'pasien_id' => $data['pasien_id'],
            'loket_id' => $data['loket_id']
        ];
        $result = $this->loadModel(null, $parameter);
        $data['apgar1'] =  $result['apgar1'];
        $data['apgar5'] =  $result['apgar5'];
        $data['apgar10'] =  $result['apgar10'];
        $data['kn0'] =  $result['kn0'];
        $data['kn1'] =  $result['kn1'];
        $data['kn2'] =  $result['kn2'];
        $data['kn3'] =  $result['kn3'];
        $data['fisik'] =  $result['fisik'];
        $data['bb'] =  $result['bb'];
        $data['start'] = date('Y-m-d H:i:s');
        $load->view('pelayanan/KIA/Neonatus/pelayanan_form/v_objectif', $data);
    }

    public function get_session($session, $encryption)
    {
        $encrypted_data =  $session->userdata('data_pasien');
        if ($encrypted_data) {
            $decrypted_data = json_decode($encryption->decrypt($encrypted_data), true);
            $data['pasien_id'] = $decrypted_data['pasien_id'];
            $data['pasien'] =  $decrypted_data['pasien'];
            $data['loket_id'] = $decrypted_data['loket_id'];
            $data['item'] =  $decrypted_data['item'];
            $data['puskesmas'] =  $decrypted_data['puskesmas'];
            return $data;
        } else {
            throw new Exception("tidak ada sesi ditemukan", 1);
        }
    }
    public function loadModel($model, $pasien_id) {
        $result['apgar1'] =  $this->ci->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->apgar1Id);
        $result['apgar5'] = $this->ci->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->apgar5Id);
        $result['apgar10'] = $this->ci->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->apgar10Id);
        $result['kn0'] = $this->ci->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->kn0);
        $result['kn1'] = $this->ci->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->kn1);
        $result['kn2'] = $this->ci->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->kn2);
        $result['kn3'] = $this->ci->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->kn3);
        $result['fisik'] = $this->ci->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->fisikBayiId);
        $result['bb'] = $this->ci->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->BBId);
        return $result;

    }
}