<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/SubLayananFactoryInterface.php');

class LayananSubFactoryObstetri implements SubLayananFactoryInterface
{
    protected $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
        (!interface_exists('InterfaceSubLayanan') && $this->CI->load->file(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php')) ||
            (!class_exists('obstetriANCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/obstetriANCRepository.php'));
    }

    public  function ManajemenSubLayanan($layanan): InterfaceSubLayanan
    {
        if ($layanan == 'ANC') {
            return new obstetriANCRepository();
        } else {
            throw new ServiceException('tidak ada sub layanan dimaksud', 404);
        }
    }
}
