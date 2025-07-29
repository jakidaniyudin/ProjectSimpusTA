<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php');


class priviewPageANCRepository implements InterfaceSubLayanan
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        $this->CI->load->model('Obstetri_model');
        $this->CI->load->model('LogSatuSehatModel');
    }
    public function loadForm($load, $session, $encryption, $model)
    {
        $data = $this->get_session($session, $encryption);
        $parameter = [
            'loket' => $data['loket_id'],
            'layanan' => 'ANC',
            'pasien_id' => $data['pasien_id']
        ];
        $result =  $this->loadModel(null, $parameter);
        $data['obstetri'] = $result['obstetri'];
        $data['log'] = $result['log'];
        $data['start'] = date('Y-m-d H:i:s');
        $load->view('pelayanan/KIA/ANC/v_priview_anc', $data);
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

    public function loadModel($model, $pasien_id)
    {
        $result['obstetri'] =  $this->CI->Obstetri_model->getById($pasien_id['pasien_id'])->row();
        $result['log'] =  $this->CI->LogSatuSehatModel->getLogRecord($pasien_id['loket'], $pasien_id['layanan']);
        return $result;
    }
}