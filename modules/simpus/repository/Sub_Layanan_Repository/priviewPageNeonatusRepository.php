<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php');


class priviewPageNeonatusRepository implements InterfaceSubLayanan
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
    }
    public function loadForm($load, $session, $encryption, $model)
    {
        $data = $this->get_session($session, $encryption);
        $load->view('pelayanan/KIA/Neonatus/v_priview_neonatus', $data);
    }
    public function get_session($session, $encryption)
    {
        $encrypted_data =  $session->userdata('data_pasien');
        if ($encrypted_data) {
            $decrypted_data = json_decode($encryption->decrypt($encrypted_data), true);
            $data['pasien_id'] = $decrypted_data['pasien_id'];
            $data['loket_id'] = $decrypted_data['loket_id'];
            $data['item'] =  $decrypted_data['item'];
            return $data;
        } else {
            throw new Exception("tidak ada sesi ditemukan", 1);
        }
    }

    public function loadModel($model, $pasien_id) {}
}