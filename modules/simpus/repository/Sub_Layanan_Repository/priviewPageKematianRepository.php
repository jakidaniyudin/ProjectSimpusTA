<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php');


class priviewPageKematianRepository implements InterfaceSubLayanan
{

    protected $ci; 
    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->model('LogSatuSehatModel');
    }
    public function loadForm($load, $session, $encryption, $model)
    {
        $data = $this->get_session($session, $encryption);
        $parameter = [
            'loket' => $data['loket_id'],
            'layanan' => 'Kematian'
        ];
        $result =  $this->loadModel(null, $parameter);
        $data['log'] = $result['log'];
        $load->view('pelayanan/KIA/Kematian/v_priview_kematian', $data);
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
            $data['start'] = date('Y-m-d H:i:s');
            return $data;
        } else {
            throw new Exception("tidak ada sesi ditemukan", 1);
        }
    }

    public function loadModel($model, $pasien_id) {
        $result['log'] =  $this->ci->LogSatuSehatModel->getLogRecord($pasien_id['loket'], $pasien_id['layanan']);
        return $result;
    }
}