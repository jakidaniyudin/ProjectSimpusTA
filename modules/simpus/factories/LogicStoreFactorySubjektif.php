<?php


if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/abstract/BaseLogicAbstract.php');
class LogicStoreFactorySubjektif
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        (!class_exists('LogicKunjunganANCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKunjunganANCRepository.php'));
        (!class_exists('LogicRiwayatPemantauanRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicRiwayatPemantauanRepository.php'));
        (!class_exists('LogicKematianIbuRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKematianIbuRepository.php'));
        (!class_exists('LogicKematianLahirMati') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKematianLahirMati.php'));
        (!class_exists('LogicKematianLahirHidup') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicKematianLahirHidup.php'));
         (!class_exists('LogicRiwayatPersalinanObsetriPNCReposiotry') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicRiwayatPersalinanObsetriPNCReposiotry.php'));
         (!class_exists('LogicDataBayiNeonatus') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicDataBayiNeonatus.php'));
    }


    public function logicSubjektifManajemen($subLayanan) : BaseLogicAbstract
    {
        if ($subLayanan == 'kunjunganANC') {
            return  new LogicKunjunganANCRepository();
        } else if ($subLayanan == 'pemantauanRiwayat') {
            return new LogicRiwayatPemantauanRepository();
        } else if ($subLayanan == 'kematianIbu') {
            return new  LogicKematianIbuRepository();
        } else if ($subLayanan == 'kematianLahirMati') {
            return new LogicKematianLahirMati();
        } else if ($subLayanan == 'kematianLahirHidup') {
            return new LogicKematianLahirHidup();
        } else if ($subLayanan == 'riwayatPersalinanPnc'){
            return new LogicRiwayatPersalinanObsetriPNCReposiotry();
        } else if ($subLayanan == 'LogicDataBayiNeonatus'){
            return new LogicDataBayiNeonatus();
        }else {
            throw new ServiceException('Layanan tidak ditemukan pada sub layanan Subjektif', 404);
        }
    }
}
