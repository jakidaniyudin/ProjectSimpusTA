<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/interfaceLayanan.php');
class LayananRepositoryINC   implements interfaceLayanan
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
            $data  =  $this->dataPrepare();
            $data['pasien_id'] = $pasien_id;
            $load->view('pelayanan/KIA/INC/v_navigation', $data);
        } catch (ServiceException $e) {
            throw new ServiceException('not found view', 500, $e->getMessage());
        }
    }
    public function checkStatusPelayanan($pasien_id)
    {
        $valid =  $this->CI->IndeksKIA_model->chekValidPasien($pasien_id);
        if (empty($valid)) {
            throw new ServiceException('Pasien tidak terdaftar', 404);
        }
        $result = $this->CI->IndeksKIA_model->check($pasien_id);
        return $result;
    }
    public function setPelayanan($pasien_id, $pelayanan)
    {
        $valid =  $this->CI->IndeksKIA_model->chekValidPasien($pasien_id);
        $id_layanan = $this->CI->MasterLayanan_model->getByName($pelayanan);
        if ($valid == null || empty($valid) || $id_layanan == null || empty($id_layanan)) {
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

    public function set($pasien_id = null, $pelayanan = null)
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
    public function update($pasien_id, $pelayanan)
    {
        $id_pelayanan = $this->CI->MasterLayanan_model->getByName($pelayanan);
        $check =  $this->CI->IndeksKIA_model->checkPasienTerdaftar($pasien_id, $id_pelayanan->id);

        if ($check) {
            $result =  $this->CI->IndeksKIA_model->update($check->id, 'mengakhiri layanan INC');
            return $result;
        } else {
            throw new ServiceException('data tidak ditemukan', 404);
        }
    }
    public function dataPrepare()
    {
        $index = $this->set();
        $sub_layanan =  ['persalinan', 'kala1', 'kala2', 'kala3', 'kala4', 'kala4Detail', 'apgar1', 'apgar5', 'apgar10', 'pelayanan_persalinan', 'bayi'];
        $itemSubLayanan  = [];
        foreach ($sub_layanan as $value) {
            $id_sub_layanan =  $this->CI->MasterSubLayanan_model->getByName($value);
            if ($id_sub_layanan) {
                $itemSubLayanan[$value] = $id_sub_layanan->id;
                // Ambil ID dari objek
            }
        }

        $result['menus'] =  $this->CI->MasterClusterLayanan_model->get();

        $persalinan =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['persalinan']) ?? null;
        $kala1 = $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['kala1']) ?? null;
        $kala2 =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['kala2']) ?? null;
        $kala3 =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['kala3']) ?? null;
        $kala4 =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['kala4']) ?? null;
        $kala4Detail = $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['kala4Detail']) ?? null;
        $pelayanan_persalinan =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['pelayanan_persalinan']) ?? null;
        $apgar1 = $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['apgar1']) ?? null;
        $apgar5 = $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['apgar5']) ?? null;
        $apgar10 = $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['apgar10']) ?? null;
        $bayi = $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['bayi']) ?? null;
        $getObsetri =  $this->CI->Obstetri_model->getById($index['id_pasien'])->row();
        $resultPrepare = [
            'persalinan' => $persalinan,
            'kala1' =>  $kala1,
            'kala2' =>  $kala2,
            'kala3' =>  $kala3,
            'kala4' =>  $kala4,
            'kala4Detail' =>  $kala4Detail,
            'pelayanan_persalinan' => $pelayanan_persalinan,
            'apgar1' =>  $apgar1,
            'apgar5' =>  $apgar5,
            'apgar10' =>  $apgar10,
            'bayi' => $bayi,
            'obstetri' => $getObsetri
        ];
        $result =  array_merge($result, $resultPrepare);
        return $result;
    }
}