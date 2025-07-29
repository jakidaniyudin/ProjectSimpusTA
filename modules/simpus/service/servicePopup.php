<?php

class servicePopup
{
    protected $CI;
    public function __construct(){
        $this->CI =  &get_instance();
        (!class_exists('logicPopUpFactoryRiwayat') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/logicPopUpFactoryRiwayat.php'));
    }

    public function manajemenPopup ($layanan, $subLayanan)
    {
        if($layanan == 'pop_riwayat'){
            return (new logicPopUpFactoryRiwayat())->logicRiwayatManajemen($subLayanan);
        } else {
            throw new ServiceException('layanan logic utama / service tidak ditemukan', 404);
        }
    }
}