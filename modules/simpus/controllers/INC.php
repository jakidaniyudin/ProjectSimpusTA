<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/service/ServiceException.php');
require_once(APPPATH . 'modules/simpus/factories/serviceCaseFactory.php');

class INC extends CI_Controller
{
    protected $service;

    function __construct()
    {
         parent::__construct();
         $this->service =  new serviceCaseFactory();
    }

    public function setObsetri() {}

    public function setStore()
    {
        $serviceHandler =  $this->service->setINCServiceManager();
        return $serviceHandler->setStore($this->input);

      
    }

    public function setKunjunganPersalinanTest()
    {
        $serviceHandler =  $this->service->setINCServiceManager();
        return $serviceHandler->setKunjunganPersalinanTest($this->input);
    }

    public function setKala1Test()
    {
        $serviceHandler =  $this->service->setINCServiceManager();
        return $serviceHandler->setKala1Test($this->input);
    }

    public function setKala2Test()
    {
        $serviceHandler =  $this->service->setINCServiceManager();
        return $serviceHandler->setKala2Test($this->input);
    }

    public function setKala3Test()
    {
        $serviceHandler =  $this->service->setINCServiceManager();
        return $serviceHandler->setKala3Test($this->input);
    }

    public function setKala4Test()
    {
        $serviceHandler =  $this->service->setINCServiceManager();
        return $serviceHandler->setKala4Test($this->input);
    }

    public function setKala4DetailTest()
    {
        $serviceHandler =  $this->service->setINCServiceManager();
        return $serviceHandler->setKala4DetailTest($this->input);
    }
}
