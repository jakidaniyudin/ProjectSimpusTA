<?php
require_once(APPPATH . 'modules/simpus/abstract/BaseLogicAbstract.php');

class LogicStatusImunizationObstetriRepository extends BaseLogicAbstract
{
    protected $CI;

    public function __construct()
    {
        $this->CI =  &get_instance();
        $this->CI->load->model('Obstetri_model');
        $this->CI->load->model('IndeksKIA_model');
        $this->CI->load->model('PemeriksaanRecordDetail_model');
        $this->CI->load->model('MasterSubLayanan_model');
    }
}