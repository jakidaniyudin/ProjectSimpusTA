<?php
defined('BASEPATH') or exit('No direct script access allowed');

class serviceSubLayanan
{
    protected $CI;
    public  function __construct()
    {
        $this->CI =  &get_instance();
        (!class_exists('SubLayananFactoryService') && $this->CI->load->file(APPPATH . 'modules/simpus/factories/SubLayananFactoryService.php'));
    }
    public function subLayanan($subLayanan, $layanan,  $load, $session, $encryption, $model)
    {
        // initiation class
        $instanceLayanan =  new SubLayananFactoryService();
        // get service layanan
        $instanceLayanan =  $instanceLayanan->getServiceLayanan($layanan);
        // get load sub layanan
        $instanceLayanan =  $instanceLayanan->ManajemenSubLayanan($subLayanan);
        // return load form 
        return  $instanceLayanan->loadForm($load, $session, $encryption, $model);

    }
}
