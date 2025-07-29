<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');



class KIASubNavigation extends CI_Controller
{
    protected $response;

    public function __construct()
    {
        parent::__construct();
        (!class_exists('ServiceResponse') && $this->load->file(APPPATH . 'modules/simpus/service/ServiceResponse.php'));
        (!class_exists('ServiceException') && $this->load->file(APPPATH . 'modules/simpus/service/ServiceException.php'));
        (!class_exists('SubLayananFactoryService') && $this->load->file(APPPATH . 'modules/simpus/factories/SubLayananFactoryService.php'));
        $this->load->model('Obstetri_model');
        $this->load->library(['session', 'encryption']);
        $this->response =  new ServiceResponse();
    }

    public function load_form($layanan, $subLayanan)
    {
        try {
            $instanceLayanan =  new SubLayananFactoryService();
            // get service layanan
            $instanceLayanan =  $instanceLayanan->getServiceLayanan($subLayanan);
            // get load sub layanan
            $instanceLayanan =  $instanceLayanan->ManajemenSubLayanan($layanan);
            // return load form 
            return  $instanceLayanan->loadForm($this->load, $this->session, $this->encryption, $this->Obstetri_model);
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }
}
