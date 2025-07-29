<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class serviceStore
{
    protected $CI;
    public function __construct()
    {
        $this->CI =  &get_instance();
        (!class_exists('logicStoreFactoryObsetri') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/LogicStoreFactoryObsetri.php'));
        (!class_exists('LogicStoreFactorySubjektif') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/LogicStoreFactorySubjektif.php'));
        (!class_exists('LogicStoreObjektifFactory') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/LogicStoreObjektifFactory.php'));
        (!class_exists('logicStoreFactoryAssesment') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/logicStoreFactoryAssesment.php'));
    }

    public function manajemenStore($layanan, $subLayanan)
    {
        if ($layanan == 'obstetri') {
            return (new logicStoreFactoryObsetri())->logicObsetriManajemen($subLayanan);
        } else if ($layanan == 'subjektif') {
            return (new LogicStoreFactorySubjektif())->logicSubjektifManajemen($subLayanan);
        } else if ($layanan == 'objektif') {
            return (new LogicStoreObjektifFactory())->logicObjektifManajemen($subLayanan);
        } else if ($layanan == 'assesment'){
            return (new logicStoreFactoryAssesment())->logicAssesmentManajemen($subLayanan);
        } else {
            throw new ServiceException('layanan Logic Utama / Service tidak ditemukan', 404);
        }
    }
}