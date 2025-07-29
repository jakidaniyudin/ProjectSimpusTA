<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class KematianServiceManager
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
        $validations = [];

        if (!empty($input->post('KematianIbu'))) {
            $validations['kematian_ibu'] = $this->validation->ManajemenRequest('form', 'kematian_ibu', $input);
        }

        if (!empty($input->post('dataLahirHidup'))) {
            $validations['kematian_lahir_hidup'] = $this->validation->ManajemenRequest('form', 'kematian_lahir_hidup', $input);
        }

        if (!empty($input->post('dataLahirMati'))) {
            $validations['kematian_lahir_mati'] = $this->validation->ManajemenRequest('form', 'kematian_lahir_mati', $input);
        }

        return $validations;
    }

    

    private function proccessAllStores($input, $validations)
    {
        $results = [];
        $results[] = $this->store->manajemenStore('assesment', 'assesment_kematian')->set($input, []);
    
        if (!empty($validations['kematian_ibu'])) {
            $results[] = $this->store->manajemenStore('subjektif', 'kematianIbu')->set($input, $validations['kematian_ibu']);
        }
    
        if (!empty($validations['kematian_lahir_mati'])) {
            $results[] = $this->store->manajemenStore('subjektif', 'kematianLahirMati')->set($input, $validations['kematian_lahir_mati']);
        }
    
        if (!empty($validations['kematian_lahir_hidup'])) {
            $results[] = $this->store->manajemenStore('subjektif', 'kematianLahirHidup')->set($input, $validations['kematian_lahir_hidup']);
        }
    
        return $results;
    }
    
    

    //testing of INC

    public function setKunjunganPersalinanTest($input)
    {
        try {
            $type = 'form';
            $formName = 'kunjungan_persalinan';
            //validation
            $this->validation->ManajemenRequest($type, $formName, $input->post('pemeriksaan'));
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
            $this->validation->ManajemenRequest($type, $formName, $input->post('pemeriksaan'));
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
            $this->validation->ManajemenRequest($type, $formName, $input->post('pemeriksaan'));
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
            $this->validation->ManajemenRequest($type, $formName, $input->post('pemeriksaan'));
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
            $this->validation->ManajemenRequest($type, $formName, $input->post('pemeriksaan'));
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
            $this->validation->ManajemenRequest($type, $formName, $input->post('pemeriksaan'));
            //logic store
            $this->response->send(201, 'data berhasil diperbarui');
        } catch (ServiceException  $e) {
            $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
        }
    }
}
