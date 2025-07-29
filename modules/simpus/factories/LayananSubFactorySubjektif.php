<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/SubLayananFactoryInterface.php');

class LayananSubFactorySubjektif implements SubLayananFactoryInterface
{
    protected $CI;

    public function __construct()
    {

        $this->CI =  &get_instance();
        (!interface_exists('InterfaceSubLayanan') && $this->CI->load->file(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php')) ||
            (!class_exists('subjektifANCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/subjektifANCRepository.php')) ||
            (!class_exists('subjektifINCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/subjektifINCRepository.php')) ||
            (!class_exists('subjektifKematianRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/subjektifKematianRepository.php')) ||
            (!class_exists('subjektifPNCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/subjektifPNCRepository.php')) ||
            (!class_exists('subjektifTumbuhKembangRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/subjektifTumbuhKembangRepository.php')) ||
            (!class_exists('subjektifNeonatusRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/subjektifNeonatusRepository.php'));
    }
    public  function ManajemenSubLayanan($layanan): InterfaceSubLayanan
    {
        if ($layanan == 'ANC') {
            return new subjektifANCRepository();
        } else if ($layanan == 'INC') {
            return new subjektifINCRepository();
        } else if ($layanan == 'Kematian') {
            return new subjektifKematianRepository();
        } else if ($layanan == 'PNC') {
            return new subjektifPNCRepository();
        } else if ($layanan == 'Neonatus') {
            return new subjektifNeonatusRepository();
        } else if ($layanan ==  'Tumbuh_Kembang') {
            return new subjektifTumbuhKembangRepository();
        } else {
            return 'tidak ada layanan tersedia';
        }
    }
}
