<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class RequestFactoryForm
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        (!interface_exists('RequestInterface') && $this->CI->load->file(APPPATH . 'modules/simpus/interfaces/RequestInterface.php')) ||
            (!class_exists('requestObstetriRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestObstetriRepository.php')) ||
            (!class_exists('ResponseRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Response_Repository/ResponseRepository.php')) ||
            (!class_exists('requestKunjunganRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestKunjunganRepository.php')) ||
            (!class_exists('requestRiwayatPemantauanRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestRiwayatPemantauanRepository.php')) ||
            (!class_exists('requestPemeriksaanIbuRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaanIbuRepository.php')) ||
            (!class_exists('requestPemeriksaanUsgRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaanUsgRepository.php')) ||
            (!class_exists('requestPemeriksaanFisikIbuRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaanFisikIbuRepository.php')) ||
            (!class_exists('requestPemeriksaan10tRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaan10tRepository.php')) ||
            (!class_exists('requestPemeriksaanJaninRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaanJaninRepository.php')) ||
            (!class_exists('requestKunjunganPersalinan') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestKunjunganPersalinan.php')) ||
            (!class_exists('requestPemeriksaanKala1') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaanKala1.php')) ||
            (!class_exists('requestPemeriksaanKala3') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaanKala3.php')) ||
            (!class_exists('requestPemeriksaanKala2') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaanKala2.php')) ||
            (!class_exists('requestPemeriksaanKala4') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaanKala4.php')) ||
            (!class_exists('requestKondisiIbu') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestKondisiIbu.php')) ||
            (!class_exists('requestPemeriksaanKala4Detail') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaanKala4Detail.php')) ||
            (!class_exists('requestApgar1') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestApgar1.php')) ||
            (!class_exists('requestApgar5') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestApgar5.php')) ||
            (!class_exists('requestApgar10') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestApgar10.php')) ||
            (!class_exists('requestBayi') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestBayi.php')) ||
            (!class_exists('requestKematianIbu') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestKematianIbu.php')) ||
            (!class_exists('requestBayiLahirMati') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestBayiLahirMati.php')) ||
            (!class_exists('requestPemeriksaanUSGTrimester3') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestPemeriksaanUSGTrimester3.php')) ||
            (!class_exists('RequestRiwayatPersalinanPNC') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestRiwayatPersalinanPNC.php')) ||
            (!class_exists('requestNifasPNC') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestNifasPNC.php')) ||
            (!class_exists('requestDataBayiNeonatus') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestDataBayiNeonatus.php')) ||
            (!class_exists('requestBayiLahirHidup') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Request_Repository/requestBayiLahirHidup.php'));
    }

    public function manajemenRequestForm($nameForm, $request)
    {
        if ($nameForm == 'obstetri') {
            return (new requestObstetriRepository())->setProtocol($request);
        } else if ($nameForm == 'kunjungan') {
            return (new  requestKunjunganRepository())->setProtocol($request);
        } else if ($nameForm == 'riwayat') {
            return (new requestRiwayatPemantauanRepository())->setProtocol($request);
        } else if ($nameForm == 'ibu') {
            return (new requestPemeriksaanIbuRepository())->setProtocol($request);
        } else if ($nameForm == 'fisik_ibu') {
            return (new requestPemeriksaanFisikIbuRepository())->setProtocol($request);
        } else if ($nameForm == 'usg_trimester1') {
            return (new requestPemeriksaanUsgRepository())->setProtocol($request);
        }else if($nameForm == 'usg_trimester3'){
            return (new requestPemeriksaanUSGTrimester3())->setProtocol($request);
        } else if ($nameForm == '10t') {
            return (new requestPemeriksaan10tRepository())->setProtocol($request);
        } else if ($nameForm == 'janin') {
            return (new requestPemeriksaanJaninRepository())->setProtocol($request);
        } else if ($nameForm == 'kunjungan_persalinan') {
            return (new requestKunjunganPersalinan())->setProtocol($request);
        } else if ($nameForm == 'kala1') {
            return (new requestPemeriksaanKala1())->setProtocol($request);
        } else if ($nameForm == 'kala2') {
            return (new requestPemeriksaanKala2())->setProtocol($request);
        } else if ($nameForm == 'kala3') {
            return (new requestPemeriksaanKala3())->setProtocol($request);
        } else if ($nameForm == 'kala4') {
            return (new requestPemeriksaanKala4())->setProtocol($request);
        } else if ($nameForm == 'kondisi_ibu') {
            return (new requestKondisiIbu())->setProtocol($request);
        } else if ($nameForm == 'kala4_detail') {
            return (new requestPemeriksaanKala4Detail())->setProtocol($request);
        } else if ($nameForm == 'apgar1') {
            return (new requestApgar1())->setProtocol($request);
        } else if ($nameForm == 'apgar5') {
            return (new requestApgar5())->setProtocol($request);
        } else if ($nameForm == 'apgar10') {
            return (new requestApgar10())->setProtocol($request);
        } else if ($nameForm == 'bayi') {
            return (new requestBayi())->setProtocol($request);
        } else if ($nameForm == 'kematian_ibu') {
            return (new requestKematianIbu())->setProtocol($request);
        } else if ($nameForm == 'kematian_lahir_hidup') {
            return (new requestBayiLahirHidup())->setProtocol($request);
        } else if ($nameForm == 'kematian_lahir_mati') {
            return (new requestBayiLahirMati())->setProtocol($request);
        } else if($nameForm == 'riwayat_persalinan_pnc'){
            return new RequestRiwayatPersalinanPNC();
        } else if ($nameForm == 'nifas_pnc') {
            return new requestNifasPNC();
        } else if ($nameForm == 'bayi_neo'){
            return new requestDataBayiNeonatus();
        }else {
            throw new ServiceException('layanan not found pada Form', 404);
        }
    }
}