<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/SubLayananFactoryInterface.php');

class LayananSubFactoryAssesment implements SubLayananFactoryInterface
{
    protected $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
        (!interface_exists('InterfaceSubLayanan') && $this->CI->load->file(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php')) ||
            (!class_exists('assementANCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/assementANCRepository.php')) ||
            (!class_exists('assesmentINCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/assesmentINCRepository.php')) ||
            (!class_exists('assesmentKematianRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/assesmentKematianRepository.php')) ||
            (!class_exists('assesmentPNCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/assesmentPNCRepository.php')) ||
            (!class_exists('assesmentNeonatusRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/assesmentNeonatusRepository.php'));
    }
    public function ManajemenSubLayanan($layanan): InterfaceSubLayanan
    {
        if ($layanan == 'ANC') {
            return new assementANCRepository();
        } else if ($layanan == 'INC') {
            return new assesmentINCRepository();
        } else if ($layanan == 'Kematian') {
            return new assesmentKematianRepository();
        } else if ($layanan == 'PNC') {
            return new assesmentPNCRepository();
        } else if ($layanan == 'Neonatus') {
            return new assesmentNeonatusRepository();
        } else {
            return 'layanan belum tersedia';
        }
    }
}
