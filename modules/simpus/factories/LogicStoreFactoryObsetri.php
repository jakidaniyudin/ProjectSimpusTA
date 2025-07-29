<?php
require_once(APPPATH . 'modules/simpus/abstract/BaseLogicAbstract.php');

if (!defined('BASEPATH')) exit('No direct script access allowed');

class logicStoreFactoryObsetri
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        (!class_exists('LogicObsetriANCRepository') && $this->CI->load->file(APPPATH . 'modules/simpus/repository/Logic_Repository/LogicObsetriANCRepository.php'));
    }

    public function logicObsetriManajemen($subLayanan) : BaseLogicAbstract
    {
        if ($subLayanan == 'ANC') {
            return  new LogicObsetriANCRepository();
        } else {
            throw new ServiceException('Layanan tidak ditemukan pada sub layanan Obsetri', 404);
        }
    }
}