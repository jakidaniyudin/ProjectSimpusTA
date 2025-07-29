<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class PNCServiceManager
{
    protected $validationService;
    protected $CI;
    protected $store;
    protected $response;
    protected $modelTransaction;
    protected $validator;

    public function __construct(
        serviceRequest $validation,
        serviceStore $store,
        ServiceResponse $response,
        HasilPemeriksaan_model $modelTransaction
    ){
        $this->CI = &get_instance();
        $this->CI->load->library('form_validation');
        $this->validator =  $this->CI->form_validation;
        $this->validationService = $validation;
        $this->store = $store;
        $this->response = $response;
        $this->modelTransaction = $modelTransaction;
    }

    public function setDataRiwayatPersalinan($input){
        try{
            $validation = $this->validationService->ManajemenRequest('form', 'riwayat_persalinan_pnc', $input);
            $validation =  $validation->setProtocol($input);
            if(empty($validation)){
                throw new ServiceException('500', 'ada masalah pada validasi');
            }
            $result= $this->store->manajemenStore('subjektif', 'riwayatPersalinanPnc')->set($input, $validation);
            return $this->response->send(200, 'berhasil diperbarui', $result);
        }catch (ServiceException $e){
             return $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        } 
    }

    public function setPelayananNifas($input){
        try{
            $validation = $this->validationService->ManajemenRequest('form','nifas_pnc', $input);
            $validation =  $validation->setProtocol($input);
            if(empty($validation)){
                throw new ServiceException('500', 'ada masalah pada validasi');
            }
            $result = $this->store->manajemenStore('objektif', 'nifas')->set($input, $validation);
            return $this->response->send(200, 'berhasil diperbarui', $result);

        }catch (ServiceException $e){
            return $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

}