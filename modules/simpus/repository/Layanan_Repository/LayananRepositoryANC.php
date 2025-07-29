<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/interfaceLayanan.php');
require_once(APPPATH . 'modules/simpus/service/ServiceException.php');
class LayananRepositoryANC   implements interfaceLayanan
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
            $data = $this->dataPrepare();
            $data['pasien_id'] = $pasien_id;
            $load->view('pelayanan/KIA/ANC/v_navigation', $data);
        } catch (ServiceException $e) {
            throw new ServiceException('not found view', 500, $e->getMessage());
        }
    }
    public function checkStatusPelayanan($pasien_id)
    {
        $valid = $this->CI->IndeksKIA_model->chekValidPasien($pasien_id);
        if (empty($valid)) {
            throw new ServiceException('Pasient tidak terdaftar', 404);
        }
        $result = $this->CI->IndeksKIA_model->check($pasien_id);
        return $result;
    }
    public function setPelayanan($pasien_id, $pelayanan)
    {
        // Cek validitas pasien
        $valid = $this->CI->IndeksKIA_model->chekValidPasien($pasien_id);
        // Cek validitas layanan
        $id_layanan = $this->CI->MasterLayanan_model->getByName($pelayanan);

        // Debugging opsional (hapus kalau sudah stabil)
        // var_dump($valid, $id_layanan);

        // Validasi: salah satu tidak ditemukan
        if (empty($valid) || empty($id_layanan)) {
            throw new ServiceException('Pasien atau layanan tidak terdaftar', 404);
        }

        // Cek apakah pasien sedang menjalani pemeriksaan layanan
        $check = $this->CI->IndeksKIA_model->cekStatusPemeriksaan($pasien_id, $id_layanan->id);

        if ($check) {
            // Jika pemeriksaan ditemukan dan belum selesai
            if (empty($check->end)) {
                return true; // Masih aktif
            }
            return false; // Sudah selesai
        }

        // Jika belum ada, buat data pemeriksaan baru
        $result = $this->CI->IndeksKIA_model->create($pasien_id, $id_layanan->id);
        return $result;
    }

    public function set($pasien_id = null, $pelayanan =  null)
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
            $result =  $this->CI->IndeksKIA_model->update($check->id, 'mengakhiri layanan ANC');
            return $result;
        } else {
            throw new ServiceException('data tidak ditemukan', 404);
        }
    }
    public function dataPrepare()
    {
        $index = $this->set();
        $sub_layanan =  ['kunjungan_anc', 'pemeriksaan_fisik_ibu', 'pemeriksaan_usg', 'pemantauan-riwayat', 'pemeriksaan_ibu', 'pemeriksaan_janin', 'pemeriksaan_10T'];
        $itemSubLayanan  = [];
        foreach ($sub_layanan as $value) {
            $id_sub_layanan =  $this->CI->MasterSubLayanan_model->getByName($value);
            if ($id_sub_layanan) {
                $itemSubLayanan[$value] = $id_sub_layanan->id;
                // Ambil ID dari objek
            }
        }

        $result['menus'] =  $this->CI->MasterClusterLayanan_model->get();

        $kunjungan =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['kunjungan_anc']) ?? null;
        $pemantauan = $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['pemantauan-riwayat']) ?? null;
        $ibu =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['pemeriksaan_ibu']) ?? null;
        $fisik_ibu =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['pemeriksaan_fisik_ibu']) ?? null;
        $usg =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['pemeriksaan_usg']) ?? null;
        $janin =  $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['pemeriksaan_janin']) ?? null;
        $pemeriksaan_10t = $this->CI->IndeksKIA_model->sinkronize($index['id_pasien'], $index['loket_id'], $itemSubLayanan['pemeriksaan_10T']) ?? null;
        $getObsetri =  $this->CI->Obstetri_model->getById($index['id_pasien'])->row() ?? null;
        $resultPrepare = [
            'kunjungan' => $kunjungan,
            'pemantauan' =>  $pemantauan,
            'ibu' =>  $ibu,
            'fisik_ibu' =>  $fisik_ibu,
            'usg' =>  $usg,
            'janin' => $janin,
            'pemeriksaan_10t' =>  $pemeriksaan_10t,
            'obstetri' =>  $getObsetri
        ];
        $result =  array_merge($result, $resultPrepare);
        return $result;
    }
}