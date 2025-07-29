<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php');


class priviewPagePNCRepository implements InterfaceSubLayanan
{
    protected $CI;
    protected $riwayatPersalinan = 'd9e2642e-4457-11f0-bd23-bc24113678a5';
    protected $nifas = '43bcace1-4541-11f0-bd23-bc24113678a5';
    public function __construct()
    {
        $this->CI =  &get_instance();
        $this->CI->load->model('LogSatuSehatModel');
        $this->CI->load->model('IndeksKIA_model');
        $this->CI->load->model('MasterSubLayanan_model');
    }
    public function loadForm($load, $session, $encryption, $model)
    {
        $data = $this->get_session($session, $encryption);
        $parameter = [
            'pasien_id' => $data['pasien_id'],
            'loket_id' => $data['loket_id'],
            'layanan' => 'PNC'
        ];
        $result =  $this->loadModel(null, $parameter);
        $data['riwayat'] = $result['riwayat'];
        $data['nifas'] = $result['nifas'];
        $data['log'] = $result['log'] ?? null;
        $data['start'] = date('Y-m-d H:i:s');
        $load->view('pelayanan/KIA/PNC/v_priview_pnc', $data);
    }
    public function get_session($session, $encryption)
    {
        $encrypted_data =  $session->userdata('data_pasien');
        if ($encrypted_data) {
            $decrypted_data = json_decode($encryption->decrypt($encrypted_data), true);
            $data['pasien_id'] = $decrypted_data['pasien_id'];
            $data['loket_id'] = $decrypted_data['loket_id'];
            $data['item'] =  $decrypted_data['item'];
            $data['puskesmas'] =  $decrypted_data['puskesmas'];
            $data['pasien'] = $decrypted_data['pasien'];
            return $data;
        } else {
            throw new Exception("tidak ada sesi ditemukan", 1);
        }
    }

    public function loadModel($model, $pasien_id) {
        $result['riwayat'] = $this->CI->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->riwayatPersalinan);
        $result['nifas'] =  $this->CI->IndeksKIA_model->sinkronize($pasien_id['pasien_id'], $pasien_id['loket_id'], $this->nifas);
        $result['log'] =  $this->CI->LogSatuSehatModel->getLogRecord($pasien_id['loket_id'], $pasien_id['layanan']);
        return $result; 
    }
}