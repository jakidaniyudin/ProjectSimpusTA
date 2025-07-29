<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


require_once(APPPATH . 'modules/simpus/service/ServiceException.php');
require_once(APPPATH . 'modules/simpus/service/ServiceResponse.php');
require_once(APPPATH . 'modules/satuSehatBridge/service/serviceLogicANCIntegration.php');

class ANCBriging extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('curl');
        $this->load->model('PelayananRecordDetail_model');
        $this->LogicServiceIntegration = new serviceLogicANCIntegration();
        $this->response =  new ServiceResponse();
    }   

    public function sendObsetri()
    {
        try {
            if(empty($this->input->post('loket_id')) || empty($this->input->post('pasien_id'))){
                throw new ServiceException('loket_id atau id_pasien kosong', 400);
            }

            $response = $this->LogicServiceIntegration->sendANC($this->input);
            $errors = $this->response->parseIssues($response);
            if (!empty($errors)) {
                $this->response->send(400, 'Validation error from SATUSEHAT', [], $errors);
                return;
            }
           // simpan lognya
            $this->PelayananRecordDetail_model->updateEcounter($this->input->post('loket_id'), $response);
            $this->response->send(200, 'data berhasiL dikirim', $response);
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }
}