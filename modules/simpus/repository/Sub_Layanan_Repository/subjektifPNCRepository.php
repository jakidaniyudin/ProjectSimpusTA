<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php');

class subjektifPNCRepository implements InterfaceSubLayanan
{
    protected $ci;
    protected $idSubLayanan = 'd9e2642e-4457-11f0-bd23-bc24113678a5';

    public function __construct(){
        $this->ci = &get_instance();
        $this->ci->load->model('IndeksKIA_model');
        $this->ci->load->model('MasterSubLayanan_model');

    }
    public function loadForm($load, $session, $encryption, $model)
    {
        $data =  $this->get_session($session, $encryption);
        //load data
        $parameter = [
            'pasien_id' =>  $data['pasien_id'],
            'loket_id' => $data['loket_id']
        ];
        $result =  $this->loadModel(null,$parameter);
        $data['riwayat'] = $result['riwayat'];
        $data['start'] = date('Y-m-d H:i:s');
        $load->view('pelayanan/KIA/PNC/pelayanan_form/v_subjectif', $data);
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
        $result['riwayat'] = $this->ci->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->idSubLayanan);
        return $result;
        
    }
}