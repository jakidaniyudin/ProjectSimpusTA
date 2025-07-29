<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/interfaceLayanan.php');
class LayananRepositoryKematian  implements interfaceLayanan
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        $this->CI->load->model('IndeksKIA_model');
        $this->CI->load->model('MasterClusterLayanan_model');
        $this->CI->load->model('MasterLayanan_model');
        $this->CI->load->model('MasterSubLayanan_model');
        $this->CI->load->model('Obstetri_model');
        $this->CI->load->library(['session', 'encryption']);
    }
    public function load_form($load, $pasien_id)
    {
        try {
            $data =  $this->dataPrepare();
            $data['pasien_id'] = $pasien_id;
            $load->view('pelayanan/KIA/Kematian/v_navigation', $data);
        } catch (ServiceException $e) {
            throw new ServiceException('not found view', 500, $e->getMessage());
        }
    }

    public function checkStatusPelayanan($pasien_id)
    {
        $valid =  $this->CI->IndeksKIA_model->chekValidPasien($pasien_id);
        if (empty($valid)) {
            throw new ServiceException('pasien tidak terdaftar', 404);
        }
        $result = $this->CI->IndeksKIA_model->check($pasien_id);
        return $result;
    }

    public function setPelayanan($pasien_id, $pelayanan)
    {
        $valid =  $this->CI->IndeksKIA_model->chekValidPasien($pasien_id);
        $id_layanan = $this->CI->MasterLayanan_model->getByName($pelayanan);
        if ($valid == null || empty($valid) || $id_layanan == null ||  empty($id_layanan)) {
            throw new ServiceException('Pasien tidak terdaftar', 404);
        }
        $check =  $this->CI->IndeksKIA_model->cekStatusPemeriksaan($pasien_id, $id_layanan->id);
        if ($check) {
            if ($check->end == null) {
                return true;
            }
            $result = $this->CI->IndeksKIA_model->create($pasien_id, $id_layanan->id);
            return $result;
        } else {
            $result = $this->CI->IndeksKIA_model->create($pasien_id, $id_layanan->id);
            return $result;
        }
    }

    public function set($pasien_id =  null, $pelayanan =  null)
    {
        $encrypted_data =  $this->CI->session->userdata('data_pasien');
        if ($encrypted_data) {
            $decrypted_data = json_decode($this->CI->encryption->decrypt($encrypted_data), true);
            $data['id_pasien'] = $decrypted_data['pasien_id'];
            $data['loket_id'] = $decrypted_data['loket_id'];
            return $data;
        } else {
            throw new Exception("tidak ada sesi ditemukan", 1);
        }
    }
    public function update($pasien_id, $pelayanan_id)
    {
        $id_pelayanan = $this->CI->MasterLayanan_model->getByName($pelayanan);
        $check =  $this->CI->IndeksKIA_model->checkPasienTerdaftar($pasien_id, $id_pelayanan->id);

        if ($check) {
            $result =  $this->CI->IndeksKIA_model->update($check->id, 'mengakhiri layanan Kematian');
            return $result;
        } else {
            throw new ServiceException('data tidak ditemukan', 404);
        }
    }
    public function dataPrepare()
    {
        $index = $this->set();
        $sub_layanan = ['kematian_ibu', 'kematian_lahir_mati', 'kematian_lahir_hidup'];
        $itemSubLayanan = [];
        foreach ($sub_layanan as $value) {
            $id_sub_layanan = $this->CI->MasterSubLayanan_model->getByName($value);
            if ($id_sub_layanan) {
                $itemSubLayanan[$value] =  $id_sub_layanan->id;
            }
        }
        $result = $this->CI->MasterClusterLayanan_model->get();
        $kematianIbu = $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['kematian_ibu']) ?? null;
        $kematianBayiLahirMati =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['kematian_lahir_mati']) ?? null;
        $kematianBayiLahirHidup =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['kematian_lahir_hidup']) ?? null;
        $getObsetri = $this->CI->Obstetri_model->getById($index['id_pasien'])->row();
        $resultPreapare = [
            'kematian_ibu' =>  $kematianIbu,
            'kematian_bayi_lahir_mati' =>  $kematianBayiLahirMati,
            'kematian_bayi_lahir_hidup' => $kematianBayiLahirHidup,
            'obsetri' => $getObsetri,
            'menus' =>  $result
        ];

        return $resultPreapare;
    }
}
