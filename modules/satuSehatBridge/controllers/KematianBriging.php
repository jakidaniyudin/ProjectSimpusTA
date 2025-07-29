<?php 

require_once(APPPATH . 'modules/simpus/service/ServiceException.php');
require_once(APPPATH . 'modules/simpus/service/ServiceResponse.php');
require_once(APPPATH . 'modules/satuSehatBridge/service/serviceLogicKematianIbuIntegration.php');

class KematianBriging extends CI_Controller {
    protected $logicServiceIntergration;
    protected $response;
    public function __construct(){
        parent::__construct();
        $this->load->library('curl');
        $this->logicServiceIntergration =  new serviceLogicKematianIbuIntegration();
        $this->load->model('PelayananRecordDetail_model');
        $this->response =  new ServiceResponse();
    }

    public function  sendSatuSehatBundleLaporanKematianIbu () {
        try {
            $response = $this->logicServiceIntergration->sendKematianReport($this->input);
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

    public function sendSatuSehatBundleLaporanBayiLahirMati () {
        
        try {
            throw new ServiceException('tidak ada data Laporan Bayi Lahir Mati', 400);
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function sendSatuSehatBundleLaporanBayiLahirHidup () {
        try {
            throw new ServiceException('tidak ada data Laporan Bayi Lahir Hidup', 400);
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }
}