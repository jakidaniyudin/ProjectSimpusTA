<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/SubLayananFactoryInterface.php');


class LayananSubFactoryObjektif implements SubLayananFactoryInterface
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        (!interface_exists('InterfaceSubLayanan') && $this->CI->load->file(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php')) ||
            (!class_exists('objektifANCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/objektifANCRepository.php')) ||
            (!class_exists('objektifINCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/objektifINCRepository.php')) ||
            (!class_exists('objektifPNCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/objektifPNCRepository.php')) ||
            (!class_exists('objektifTumbuhKembangRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/objektifTumbuhKembangRepository.php')) ||
            (!class_exists('objektifNeonatusRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/objektifNeonatusRepository.php'));
    }
    public  function ManajemenSubLayanan($layanan): InterfaceSubLayanan
    {
        if ($layanan ==  'ANC') {
            return new objektifANCRepository();
        } else if ($layanan == 'INC') {
            return new objektifINCRepository();
        } else if ($layanan == 'PNC') {
            return new objektifPNCRepository();
        } else if ($layanan == 'Neonatus') {
            return new objektifNeonatusRepository();
        } else if ($layanan == 'Tumbuh_Kembang'){
            return new objektifTumbuhKembangRepository();
        }else {
            return 'tidak ada layanan tersedia';
        }
    }
}
