<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php');


class priviewPageINCRepository implements InterfaceSubLayanan
{
    protected $CI;
    public function __construct(){
        $this->CI =  &get_instance();
        $this->CI->load->model('LogSatuSehatModel');
    }
    public function loadForm($load, $session, $encryption, $model)
    {
        $data = $this->get_session($session, $encryption);
        $parameter = [
            'loket' => $data['loket_id'],
            'layanan' => 'INC',
        ];
        $data['log'] = $this->loadModel(null, $parameter);
        $data['start'] = date('Y-m-d H:i:s');
        $load->view('pelayanan/KIA/INC/v_priview_inc', $data);
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
        $result['log'] =  $this->CI->LogSatuSehatModel->getLogRecord($pasien_id['loket'], $pasien_id['layanan']);
        return $result;
    }
}