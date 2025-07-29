<?php 

require_once(APPPATH . 'modules/simpus/service/ServiceException.php');
require_once(APPPATH . 'modules/simpus/service/ServiceResponse.php');
require_once(APPPATH . 'modules/satuSehatBridge/service/serviceLogicPNCIntegration.php');

class PNCBriging extends CI_Controller {
    protected $logicServiceIntergration;
    protected $response;

    public function __construct(){
        parent::__construct();
        $this->logicServiceIntergration = new serviceLogicPNCIntegration();
        $this->load->model('PelayananRecordDetail_model');
        $this->response = new ServiceResponse();
    }

    public function sendSatuSehatBundle () {
         try {
            $response = $this->logicServiceIntergration->sendPNC($this->input);
            $errors = $this->response->parseIssues($response);
            if (!empty($errors)) {
                $this->response->send(400, 'Validation error from SATUSEHAT', [], $errors);
                return;
            }
            $this->PelayananRecordDetail_model->updateEcounter($this->input->post('loket_id'), $response);
            $this->response->send(200, 'data berhasiL dikirim', $response);
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }
}