<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class INCServiceManager
{
    protected $validation;
    protected $store;
    protected $response;
    protected $modelTransaction;

    public function __construct(serviceRequest $validation, serviceStore $store, ServiceResponse $response, HasilPemeriksaan_model $modelTransaction)
    {
        $this->validation = $validation;
        $this->store = $store;
        $this->response = $response;
        $this->modelTransaction = $modelTransaction;
    }

    public function setObsetri($input) {}

    public function  setStore($input)
    {
        try {
            $validation = $this->validationAllForms($input);
            if(!$validation){
                   return $this->response->send(400, 'semua procedure INC harus diisi ');
            }
            $validation['diagnosis'] = [];
            $this->modelTransaction->start_transaksi();
            $result =  $this->proccessAllStores($input, $validation);
            $this->modelTransaction->trans_commit();
            return $this->response->send(200, 'berhasil diperbarui', $result);
        } catch (ServiceException $e) {
            return $this->response->send(
                $e->getHttpStatusCode(),
                $e->getMessage(),
                [],
                $e->getErrors()
            );
        }
    }

    private function validationAllForms($input)
    {
        $forms = [
            'kunjungan_persalinan' => 'kunjunganPersalinan',
            'kala1' => 'dataKala1',
            'kala2' => 'dataKala2',
            'kala3' => 'dataKala3',
            'kala4' => 'dataKala4',
            'kondisi_ibu' => 'keadaanIbu',
            'kala4_detail' => 'dataKala4Detail',
            'apgar1' => 'apgar1',
            'apgar5' => 'apgar5',
            'apgar10'=> 'apgar10',
            'bayi' => 'bayi'
        ];
    
        $validations = [];
        foreach ($forms as $form => $key) {
            if (!empty($input->post($key))) {
                $validations[$form] = $this->validation->ManajemenRequest('form', $form, $input);
            }else{
               $validations = false;
               break;
            }
        }
      
        return $validations;
    }
    
    private function proccessAllStores($input, $validations)
    {
        return [
            ($this->store->manajemenStore('objektif', 'data_persalinan'))->set($input, $validations['kunjungan_persalinan']),
            ($this->store->manajemenStore('objektif', 'kala1'))->set($input, $validations['kala1']),
            ($this->store->manajemenStore('objektif', 'kala2'))->set($input, $validations['kala2']),
            ($this->store->manajemenStore('objektif', 'kala3'))->set($input, $validations['kala3']),
            ($this->store->manajemenStore('objektif', 'kala4'))->set($input, $validations['kala4']),
            ($this->store->manajemenStore('objektif', 'kala4Detail'))->set($input, $validations['kala4_detail']),
            ($this->store->manajemenStore('objektif', 'pelayanan_persalinan'))->set($input, $validations['kondisi_ibu']),
            ($this->store->manajemenStore('objektif', 'bayi'))->set($input, $validations['bayi']),
            ($this->store->manajemenStore('objektif', 'apgar1'))->set($input, $validations['apgar1']),
            ($this->store->manajemenStore('objektif', 'apgar5'))->set($input, $validations['apgar5']),
            ($this->store->manajemenStore('objektif', 'apgar10'))->set($input, $validations['apgar10']),
            ($this->store->manajemenStore('assesment', 'assesment_inc'))->set($input, $validations['diagnosis']),
        ];
    }

    //testing of INC

    public function setKunjunganPersalinanTest($input)
    {
        try {
            $type = 'form';
            $formName = 'kunjungan_persalinan';
            //validation
            $this->validation->ManajemenRequest($type, $formName, $input);
            //logic store
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function setKala1Test($input)
    {
        try {
            $type = 'form';
            $formName = 'kala1';
            //validation
            $this->validation->ManajemenRequest($type, $formName, $input);
            //logic store
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function setKala2Test($input)
    {
        try {
            $type = 'form';
            $formName = 'kala2';
            //validation
            $this->validation->ManajemenRequest($type, $formName, $input);
            //logic store
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }

    public function setKala3Test($input)
    {
        try {
            $type = 'form';
            $formName = 'kala3';
            //validation
            $this->validation->ManajemenRequest($type, $formName, $input);
            //logic store
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }


    public function setKala4Test($input)
    {
        try {
            $type = 'form';
            $formName = 'kala4';
            //validation
            $this->validation->ManajemenRequest($type, $formName, $input);
            //logic store
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }
    public function setKala4DetailTest($input)
    {
        try {
            $type = 'form';
            $formName = 'kala4_detail';
            //validation
            $this->validation->ManajemenRequest($type, $formName, $input);
            //logic store
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }
}
