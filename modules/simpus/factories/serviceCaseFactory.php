<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'modules/simpus/service/serviceRequest.php');
require_once(APPPATH . 'modules/simpus/service/ServiceResponse.php');
require_once(APPPATH . 'modules/simpus/service/serviceStore.php');
require_once(APPPATH . 'modules/simpus/service/ANCServiceManager.php');
require_once(APPPATH . 'modules/simpus/service/INCServiceManager.php');
require_once(APPPATH . 'modules/simpus/service/KematianServiceManager.php');
require_once(APPPATH . 'modules/simpus/service/PNCServiceManager.php');
require_once(APPPATH . 'modules/simpus/service/NeonatusServiceManager.php');


class serviceCaseFactory {
    protected $ci;
    protected $model;
    public function __construct(){
        $this->ci = &get_instance();
        $this->ci->load->model('HasilPemeriksaan_model');
    }


    public  function setANCServiceManager(){
        return new ANCServiceManager (
            new ServiceRequest(),
            new ServiceStore(),
            new ServiceResponse(),
            $this->ci->HasilPemeriksaan_model
        );
    }

    public  function setINCServiceManager(){
         return new INCServiceManager (
            new ServiceRequest(),
            new ServiceStore(),
            new ServiceResponse(),
            $this->ci->HasilPemeriksaan_model
        );
    }

    public  function setKematianServiceManager(){
        return new KematianServiceManager (
            new ServiceRequest(),
            new ServiceStore(),
            new ServiceResponse(),
            $this->ci->HasilPemeriksaan_model
        );
    }

    public function setPNCServiceManager(){
        return new PNCServiceManager(
            new ServiceRequest(),
            new ServiceStore(),
            new ServiceResponse(),
            $this->ci->HasilPemeriksaan_model
        );
    }

    public function setNeonatusServiceManager(){
        return new NeonatusServiceManager(
            new ServiceRequest(),
            new ServiceStore(),
            new ServiceResponse(),
            $this->ci->HasilPemeriksaan_model
        );
    }
}