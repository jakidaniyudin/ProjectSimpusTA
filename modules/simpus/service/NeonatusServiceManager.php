<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class NeonatusServiceManager
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

    public function setDataBayi($input){
        try{
            $validation = $this->validationService->ManajemenRequest('form', 'bayi_neo', $input);
            $validation =  $validation->setProtocol($input);
            if(empty($validation)){
                throw new ServiceException('500', 'ada masalah pada validasi');
            }
            $result= $this->store->manajemenStore('subjektif', 'LogicDataBayiNeonatus')->set($input, $validation);
            return $this->response->send(200, 'berhasil diperbarui', $result);
        }catch (ServiceException $e){
             return $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        } 
    }

    public function setDataRiwayatPersalinan($input){
        try{
            $validation = $this->validationService->ManajemenRequest('form', 'riwayat_persalinan_pnc', $input);
            $validation =  $validation->setProtocol($input);
            if(empty($validation)){
                throw new ServiceException(500, 'ada masalah pada validasi');
            }
            $result= $this->store->manajemenStore('subjektif', 'riwayatPersalinanPnc')->set($input, $validation);
            return $this->response->send(200, 'berhasil diperbarui', $result);
        }catch (ServiceException $e){
             return $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        } 
    }

    public function setApgar ($input){
        try{
            $forms = [
                'apgar1' => 'apgar1',
                'apgar5' => 'apgar5',
                'apgar10'=> 'apgar10',
            ];

            $validations = [];
            foreach ($forms as $form => $key) {
                if (!empty($input->post($key))) {
                    $validations[$form] = $this->validationService->ManajemenRequest('form', $form, $input);
                }else{
                    $validations = false;
                    break;
                }
            }
            if(!$validations){
                return $this->response->send(400, 'semua procedure Apgar harus diisi ');
            }
            $this->modelTransaction->start_transaksi();
            ($this->store->manajemenStore('objektif', 'apgar1'))->set($input, $validations['apgar1']);
            ($this->store->manajemenStore('objektif', 'apgar5'))->set($input, $validations['apgar5']);
            ($this->store->manajemenStore('objektif', 'apgar10'))->set($input, $validations['apgar10']);
            $this->modelTransaction->trans_commit();
            return $this->response->send(200, 'berhasil diperbarui');
        }catch (ServiceException $e){
             return $this->response->send((int)$e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
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


     private function validationAllForms($input)
    {
        $forms = [
            'apgar1' => 'apgar1',
            'apgar5' => 'apgar5',
            'apgar10'=> 'apgar10',
        ];
    
        $validations = [];
        foreach ($forms as $form => $key) {
            if (!empty($input->post($key))) {
                $validations[$form] = $this->validationService->ManajemenRequest('form', $form, $input);
            }else{
               $validations = false;
               break;
            }
        }
      
        return $validations;
    }

}