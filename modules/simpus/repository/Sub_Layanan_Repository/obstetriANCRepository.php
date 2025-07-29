<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php');
class obstetriANCRepository implements InterfaceSubLayanan
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        $this->CI->load->library('uuid');
        $this->CI->load->model('PemeriksaanRecordDetail_model');
        $this->CI->load->model('HasilPemeriksaan_model');
        $this->CI->load->model('MasterSubLayanan_model');
        $this->CI->load->model('IndeksKIA_model');
    }

    public function loadForm($load, $session, $encryption, $model)
    {

        $data =  $this->get_session($session, $encryption);
        $index = [
            'id_pasien' =>  $data['pasien_id'],
            'loket_id' =>  $data['loket_id'],
            'sub_layanan' =>  ['kunjungan_anc', 'pemeriksaan_fisik_ibu', 'pemeriksaan_usg', 'pemantauan-riwayat', 'pemeriksaan_ibu', 'pemeriksaan_janin', 'pemeriksaan_10T']
        ];

        $data = array_merge($data, $this->loadModel($model, $index));
        $data['start'] = date('Y-m-d H:i:s');
        $load->view('pelayanan/KIA/ANC/pelayanan_form/v_obstetri', $data);
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
    public function loadModel($model, $index)
    {
        $getObsetri =  $model->getById($index['id_pasien'])->row();
        $resultPrepare = [
            'obstetri' =>  $getObsetri
        ];
        return $resultPrepare;
    }
}