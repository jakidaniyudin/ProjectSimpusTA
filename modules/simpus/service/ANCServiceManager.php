<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ANCServiceManager
{
    protected  $validationService;
    protected  $CI;
    protected  $store;
    protected  $response;
    protected  $modelTransaction;
    protected  $validator;

    public function __construct(
        serviceRequest $validation,
        serviceStore $store,
        ServiceResponse $response,
        HasilPemeriksaan_model $modelTransaction
    ) {
        $this->CI = &get_instance();
        $this->CI->load->library('form_validation');
        $this->validator =  $this->CI->form_validation;
        $this->validationService = $validation;
        $this->store = $store;
        $this->response = $response;
        $this->modelTransaction = $modelTransaction;
    }

    public function setObsetri($input)
    {

        try {
            $type = 'form';
            $formName = 'obstetri';
            
            //validation
            $validation = $this->validationService->ManajemenRequest($type, $formName, $input->post('pemeriksaan'));
            if ($this->validator->run() == false) {
                $errors = $this->validator->error_array();
                throw new ServiceException('validation failed', 400, $errors);
            }
            $this->modelTransaction->start_transaksi();
            //logic store
            $logic = $this->store->manajemenStore('obstetri', 'ANC');
            $data = $logic->set($validation, $input->post('imunisasi'));
            $this->modelTransaction->trans_commit();
            $this->response->send(201, 'data berhasil diperbarui', $data);
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }


    public function setStore($input)
    {
        try {
            $validation = $this->validateAllForms($input);
            $validation['diagnosis'] = [];
        
            $this->modelTransaction->start_transaksi();

            $result = $this->proccessAllStores($input, $validation);
            //

            $this->modelTransaction->trans_commit();
            return $this->response->send(200, 'berhasil dipebarui', $result);
        } catch (ServiceException $e) {
            return $this->response->send(
                $e->getHttpStatusCode(),
                $e->getMessage(),
                [],
                $e->getErrors()
            );
        }
    }

    private function validateAllForms($input)
    {
        $validate_form = [];
    
        $formFields = [
            'kunjungan' => 'kunjunganData',
            'riwayat' => 'pemantauanData',
            'ibu' => 'pemeriksaanIbu',
            'fisik_ibu' => 'pemeriksaanFisikIbu',
            '10t' => 'pemeriksaan10T',
            'janin' => 'form1',
        ];
        foreach ($formFields as $validationName => $postField) {
            if (!empty($input->post($postField))) {
              
                $validate_form[$validationName] = $this->validationService->ManajemenRequest('form', $validationName, $input);
            }
        }
    
        // Validasi USG berdasarkan trimester, hanya kalau ada input-nya
        $usgData = $input->post('pemeriksaanUsg');
        if (!empty($usgData) && isset($usgData['trimester']['value'])) {
            $trimester = $usgData['trimester']['value'];
        
            switch ($trimester) {
                case '1':
                case '2':
                    $validate_form['usg'] = $this->validationService->ManajemenRequest('form', 'usg_trimester1', $input);
                    break;
        
                case '3':
                case '4':
                    $validate_form['usg'] = $this->validationService->ManajemenRequest('form', 'usg_trimester3', $input);
                    break;
        
                default:
                    throw new ServiceException('Trimester tidak valid: ' . $trimester, 400);
            }
        }
    
        return $validate_form;
    }
    
    
    

    
    

    private function proccessAllStores($input, $validations)
    {
        $result = [];

        $storeMap = [
            'kunjungan'    => ['subjektif', 'kunjunganANC'],
            'riwayat'      => ['subjektif', 'pemantauanRiwayat'],
            'ibu'          => ['objektif', 'ibu'],
            'fisik_ibu'    => ['objektif', 'fisikIbu'],
            'janin'        => ['objektif', 'janin'],
            '10t'          => ['objektif', '10t'],
            'usg'          => ['objektif', 'usg'],
            'diagnosis'     => ['assesment', 'assesment_anc'],
        ];

        foreach ($storeMap as $key => [$kategori, $tipe]) {
            if (isset($validations[$key])) {
                $result[] = $this->store->manajemenStore($kategori, $tipe)->set($input, $validations[$key]);
            }
        }

        return $result;
    }


    // proses testing  set obstetri

    public function setObsetriTest($input)
    {
        try {
            $type = 'form';
            $formName = 'obstetri';
            //validation
            $this->validationService->ManajemenRequest($type, $formName, $input->post('pemeriksaan'));
            //logic store
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function setKunjuganTest($input)
    {
        try {
            $type = 'form';
            $formName = 'kunjungan';

            $this->validationService->ManajemenRequest($type, $formName, $input);
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function setPematauanRiwayatTest($input)
    {
        try {
            $type = 'form';
            $formName = 'riwayat';

            $this->validationService->ManajemenRequest($type, $formName, $input);
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }


    public function setIbuTest($input)
    {
        try {
            $type = 'form';
            $formName = 'ibu';
            $this->validationService->ManajemenRequest($type, $formName, $input);
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function setfisikIbuTest($input)
    {
        try {
            $type = 'form';
            $formName = 'ibu';
            $this->validationService->ManajemenRequest($type, $formName, $input);
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function set10tTest($input)
    {
        try {
            $this->validationService->ManajemenRequest('form', '10t', $input);
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }


    public function setusgTest($input)
    {
        try {
            $this->validationService->ManajemenRequest('form', '10t', $input);
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function setJaninTest($input)
    {
        try {
            $this->validationService->ManajemenRequest('form', 'janin', $input);
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }
}