<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/service/ServiceException.php');
require_once(APPPATH . 'modules/simpus/factories/serviceCaseFactory.php');
class Kematian_Store extends CI_Controller
{
    protected $service;
    protected $response;
    protected $validation;
    protected $store;

    function __construct()
    {
        parent::__construct();
        $this->service = new serviceCaseFactory();
    }


    public function setStore()
    {
        $serviceHandler =  $this->service->setKematianServiceManager(); 
        return $serviceHandler->setStore($this->input);
    }
}
