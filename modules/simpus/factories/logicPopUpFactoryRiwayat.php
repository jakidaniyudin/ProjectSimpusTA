<?php

class logicPopUpFactoryRiwayat
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        !class_exists('logicRepositoryPopUpRiwayatKeluarga') ? $this->CI->load->file(APPPATH . 'modules/simpus/repository/PopUp_Repository/logicRepositoryPopUpRiwayatKeluarga.php') : null;
        !class_exists('logicRepositoryPopUpRiwayatPribadi') ? $this->CI->load->file(APPPATH . 'modules/simpus/repository/PopUp_Repository/logicRepositoryPopUpRiwayatPribadi.php') : null;
        !class_exists('LogicRepositoryPopUpDugaanSebabKematian') ? $this->CI->load->file(APPPATH . 'modules/simpus/repository/PopUp_Repository/LogicRepositoryPopUpDugaanSebabKematian.php') : null;
    }


    public function logicRiwayatManajemen($sub_riwayat)
    {
        if ($sub_riwayat == 'pribadi') {
            return (new logicRepositoryPopUpRiwayatPribadi());
        } else if ($sub_riwayat == 'keluarga') {
            return (new logicRepositoryPopUpRiwayatKeluarga());
        } else if ($sub_riwayat == 'kematian') {
            return (new LogicRepositoryPopUpDugaanSebabKematian());
        } else {
            throw new ServiceException('layanan sub-logic riwayat / Service tidak ditemukan', 404);
        }
    }
}