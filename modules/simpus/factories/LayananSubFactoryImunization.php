<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/SubLayananFactoryInterface.php');

class LayananSubFactoryImunization implements SubLayananFactoryInterface
{

    protected $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
        (!interface_exists('InterfaceSubLayanan') && $this->CI->load->file(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php')) ||
            (!class_exists('imunizationANCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/imunizationANCRepository.php')) ||
            (!class_exists('imunizationINCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/imunizationINCRepository.php')) ||
            (!class_exists('imunizationPNCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/imunizationPNCRepository.php')) ||
            (!class_exists('imunizationNeonatusRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/imunizationNeonatusRepository.php'));
    }

    public function ManajemenSubLayanan($layanan): InterfaceSubLayanan
    {
        if ($layanan == 'ANC') {
            return new imunizationANCRepository();
        } else if ($layanan == 'INC') {
            return new imunizationINCRepository();
        } else if ($layanan == 'PNC') {
            return new imunizationPNCRepository();
        } else if ($layanan == 'Neonatus') {
            return new imunizationNeonatusRepository();
        } else {
            return 'layanan belum tersedia';
        }
    }
}
