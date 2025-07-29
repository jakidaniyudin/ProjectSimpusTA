<?php


if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/abstract/BaseLogicAbstract.php');

class LogicStoreObjektifFactory
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();

        (!class_exists('LogicPemeriksaanIbuRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicPemeriksaanIbuRepository.php'));
        (!class_exists('LogicPemeriksaanFisikIbuRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicPemeriksaanFisikIbuRepository.php'));
        (!class_exists('LogicPemeriksaanUsgRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicPemeriksaanUsgRepository.php'));
        (!class_exists('LogicPemeriksaanJaninRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicPemeriksaanJaninRepository.php'));
        (!class_exists('LogicPemeriksaan10TRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicPemeriksaan10TRepository.php'));
        (!class_exists('LogicDataPersalinanRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicDataPersalinanRepository.php'));
        (!class_exists('LogicKala1Repository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKala1Repository.php'));
        (!class_exists('LogicKala2Repository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKala2Repository.php'));
        (!class_exists('LogicKala3Repository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKala3Repository.php'));
        (!class_exists('LogicKala4Repository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKala4Repository.php'));
        (!class_exists('LogicKala4DetailRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKala4DetailRepository.php'));
        (!class_exists('LogicPelayananPersalinanRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicPelayananPersalinanRepository.php'));
        (!class_exists('LogicBayiRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicBayiRepository.php'));
        (!class_exists('LogicApgar1Repository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicApgar1Repository.php'));
        (!class_exists('LogicApgar5Repository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicApgar5Repository.php'));
        (!class_exists('LogicApgar10Repository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicApgar10Repository.php'));
        (!class_exists('LogicPelayananNifasPNC') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicPelayananNifasPNC.php'));
        (!class_exists('LogicKN0Neonatus') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKN0Neonatus.php'));
        (!class_exists('LogicKN1Neonatus') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKN1Neonatus.php'));
        (!class_exists('LogicKN2Neonatus') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKN2Neonatus.php'));
        (!class_exists('LogicKN3Neonatus') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKN3Neonatus.php'));
        (!class_exists('LogicFisikNeonatus') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicFisikNeonatus.php'));
        (!class_exists('LogicBBNeonatus') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicBBNeonatus.php'));
    }

    public function logicObjektifManajemen($subLayanan): BaseLogicAbstract
    {
        if ($subLayanan == 'ibu') {
            return  new LogicPemeriksaanIbuRepository();
        } else if ($subLayanan == 'fisikIbu') {
            return new LogicPemeriksaanFisikIbuRepository();
        } else if ($subLayanan == 'usg') {
            return new LogicPemeriksaanUsgRepository();
        } else if ($subLayanan == 'janin') {
            return new  LogicPemeriksaanJaninRepository();
        } else if ($subLayanan == '10t') {
            return new LogicPemeriksaan10TRepository();
        } else if ($subLayanan == 'data_persalinan') {
            return new LogicDataPersalinanRepository();
        } else if ($subLayanan == 'kala1') {
            return new LogicKala1Repository();
        } else if ($subLayanan == 'kala2') {
            return new LogicKala2Repository();
        } else if ($subLayanan == 'kala3') {
            return new LogicKala3Repository();
        } else if ($subLayanan == 'kala4') {
            return new LogicKala4Repository();
        } else if ($subLayanan == 'kala4Detail') {
            return new LogicKala4DetailRepository();
        } else if ($subLayanan == 'pelayanan_persalinan') {
            return new LogicPelayananPersalinanRepository();
        } else if ($subLayanan == 'bayi') {
            return new LogicBayiRepository();
        } else if ($subLayanan == 'apgar1') {
            return new LogicApgar1Repository();
        } else if ($subLayanan == 'apgar5') {
            return new LogicApgar5Repository();
        } else if ($subLayanan == 'apgar10') {
            return new LogicApgar10Repository();
        } else if ($subLayanan == 'nifas'){
            return new LogicPelayananNifasPNC();
        } else if ($subLayanan == 'kn0'){
            return new LogicKN0Neonatus();
        } else if ($subLayanan == 'kn1'){
            return new  LogicKN1Neonatus();
        } else if ($subLayanan == 'kn2'){
            return new LogicKN2Neonatus();
        } else if ($subLayanan == 'kn3'){
            return new LogicKN3Neonatus();
        } else if ($subLayanan == 'fisik_neo'){
            return new LogicFisikNeonatus();
        } else if ($subLayanan == 'bb_neo'){
            return new LogicBBNeonatus();
        }else {
            throw new ServiceException('Layanan tidak ditemukan pada sub layanan Subjektif', 404);
        }
    }
}