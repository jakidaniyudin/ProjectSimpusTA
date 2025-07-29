<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/SubLayananFactoryInterface.php');


class LayananSubFactoryStatusPasien implements SubLayananFactoryInterface
{
    protected $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
        (!interface_exists('InterfaceSubLayanan') && $this->CI->load->file(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php')) ||
            (!class_exists('statusPasienANCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/statusPasienANCRepository.php')) ||
            (!class_exists('statusPasienINCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/statusPasienINCRepository.php')) ||
            (!class_exists('statusPasienKematianRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/statusPasienKematianRepository.php')) ||
            (!class_exists('statusPasienPNCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/statusPasienPNCRepository.php')) ||
            (!class_exists('statusPasienNeonatusRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/statusPasienNeonatusRepository.php'));
    }

    public  function ManajemenSubLayanan($layanan): InterfaceSubLayanan
    {
        if ($layanan == 'ANC') {
            return new statusPasienANCRepository();
        } else if ($layanan == 'INC') {
            return new statusPasienINCRepository();
        } else if ($layanan == 'Kematian') {
            return new statusPasienKematianRepository();
        } else if ($layanan == 'PNC') {
            return new statusPasienPNCRepository();
        } else if ($layanan == 'Neonatus') {
            return new statusPasienNeonatusRepository();
        } else {
            return 'tidak ada layanan tersedia';
        }
    }
}
