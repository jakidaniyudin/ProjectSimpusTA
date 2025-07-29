<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/SubLayananFactoryInterface.php');


class layananSubFactoryPriview implements SubLayananFactoryInterface
{
    protected $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
        (!interface_exists('InterfaceSubLayanan') && $this->CI->load->file(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php')) ||
            (!class_exists('priviewPageANCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/priviewPageANCRepository.php')) ||
            (!class_exists('priviewPageINCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/priviewPageINCRepository.php')) ||
            (!class_exists('priviewPagePNCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/priviewPagePNCRepository.php')) ||
            (!class_exists('priviewPageKematianRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/priviewPageKematianRepository.php')) ||
            (!class_exists('priviewPageNeonatusRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/priviewPageNeonatusRepository.php'));
    }
    public function ManajemenSubLayanan($layanan): InterfaceSubLayanan
    {
        if ($layanan == 'ANC') {
            return new priviewPageANCRepository();
        } else if ($layanan == 'INC') {
            return new priviewPageINCRepository();
        } else if ($layanan == 'Kematian') {
            return new priviewPageKematianRepository();
        } else if ($layanan == 'PNC') {
            return new priviewPagePNCRepository();
        } else if ($layanan == 'Neonatus') {
            return new priviewPageNeonatusRepository();
        } else {
            throw new ServiceException('layanan tidak priview tidak tersedia', 404);
        }
    }
}