<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/interfaces/SubLayananFactoryInterface.php');


class LayananSubFactoryPlanning implements SubLayananFactoryInterface
{

    protected $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
        (!interface_exists('InterfaceSubLayanan') && $this->CI->load->file(APPPATH . 'modules/simpus/interfaces/InterfaceSubLayanan.php')) ||
            (!class_exists('planningANCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/planningANCRepository.php')) ||
            (!class_exists('planningINCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/planningINCRepository.php')) ||
            (!class_exists('planningKematianRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/planningKematianRepository.php')) ||
            (!class_exists('planningPNCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/planningPNCRepository.php')) ||
            (!class_exists('planningNeonatusRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Sub_Layanan_Repository/planningNeonatusRepository.php'));
    }
    public function ManajemenSubLayanan($layanan): InterfaceSubLayanan
    {
        if ($layanan == 'ANC') {
            return new planningANCRepository();
        } else if ($layanan == 'INC') {
            return new planningINCRepository();
        } else if ($layanan == 'Kematian') {
            return new planningKematianRepository();
        } else if ($layanan == 'PNC') {
            return new planningPNCRepository();
        } else if ($layanan == 'Neonatus') {
            return new planningNeonatusRepository();
        } else {
            return 'layanan belum tersedia';
        }
    }
}
