<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php');
class statusPasienKematianRepository implements InterfaceSubLayanan
{
    // to load form with data in there
    public function loadForm($load, $session, $encryption, $model)
    {
        $data =  $this->get_session($session, $encryption);
        $load->view('pelayanan/KIA/Kematian/pelayanan_form/status_pasien', $data);
    }
    // get load for session 
    public function get_session($session, $encryption)
    {
        $encrypted_data =  $session->userdata('data_pasien');
        if ($encrypted_data) {
            $decrypted_data = json_decode($encryption->decrypt($encrypted_data), true);
            $data['pasien_id'] = $decrypted_data['pasien_id'];
            $data['loket_id'] = $decrypted_data['loket_id'];
            $data['item'] =  $decrypted_data['item'];
            $data['pasien'] =  $decrypted_data['pasien'];
            return $data;
        } else {
            throw new Exception("tidak ada sesi ditemukan", 1);
        }
    }

    // get load for model
    public function loadModel($model, $pasien_id) {}
}