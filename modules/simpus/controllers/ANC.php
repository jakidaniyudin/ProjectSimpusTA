<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/simpus/service/ServiceException.php');
require_once(APPPATH . 'modules/simpus/factories/serviceCaseFactory.php');
class ANC extends CI_Controller
{

    protected $service;



    function __construct()
    {
         parent::__construct();
         $this->service =  new serviceCaseFactory();
    }

   public function setObsetri()
    {
        // memilih service yang dipilih untuk kasus set Obsetri
        $serviceHandler =  $this->service->setANCServiceManager();
        return $serviceHandler->setObsetri($this->input);
    }


    public function setStore()
    {
         $serviceHandler =  $this->service->setANCServiceManager();
         return $serviceHandler->setStore($this->input);
    }
    //FUNCTION TESTING

    public function setObsetriTest()
    {
        $serviceHandler =  $this->service->setANCServiceManager();
        return $serviceHandler->setObsetriTest($this->input);
    }

    public function setKunjuganTest()
    {
         $serviceHandler =  $this->service->setANCServiceManager();
        return $serviceHandler->setKunjuganTest($this->input);
    }

    public function setPematauanRiwayatTest()
    {
         $serviceHandler =  $this->service->setANCServiceManager();
        return $serviceHandler->setPematauanRiwayatTest($this->input);
    }

    public function setsetIbuTest()
    {
         $serviceHandler =  $this->service->setANCServiceManager();
        return $serviceHandler->setIbuTest($this->input);
    }

    // public function setObsetri()
    // {
    //     try {
    //         $type = $this->input->post('type');
    //         $formName =  $this->input->post('form_name');
    //         //validation
    //         $validation = $this->validation->ManajemenRequest($type, $formName, $this->input->post());
    //         //logic store
    //         $logic = $this->store->manajemenStore('obstetri', 'ANC');
    //         $data = $logic->set($this->input);
    //         var_dump($data);
    //         $this->response->send(201, 'data berhasil diperbarui');
    //     } catch (ServiceException  $e) {
    //         $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
    //     }
    // }
    // public function setStore()
    // {
    //     try {
    //         // validation proccess
    //         $valKunjungan = $this->validation->ManajemenRequest('form', 'kunjungan', $this->input);
    //         $valRiwayat = $this->validation->ManajemenRequest('form', 'riwayat', $this->input);
    //         $valIbu = $this->validation->ManajemenRequest('form', 'ibu', $this->input);
    //         $valFisikIbu =  $this->validation->ManajemenRequest('form', 'fisik_ibu', $this->input);
    //         $val10T =  $this->validation->ManajemenRequest('form', '10t', $this->input);
    //         $valUsg  = $this->validation->ManajemenRequest('form', 'usg', $this->input);
    //         $valJanin = $this->validation->ManajemenRequest('form', 'janin', $this->input);
    //         $this->HasilPemeriksaan_model->start_transaksi();
    //         $result[] = ($this->store->manajemenStore('subjektif', 'kunjunganANC'))->set($this->input, $valKunjungan);
    //         $result[] = ($this->store->manajemenStore('subjektif', 'pemantauanRiwayat'))->set($this->input, $valRiwayat);
    //         $result[] = ($this->store->manajemenStore('objektif', 'ibu'))->set($this->input, $valIbu);
    //         $result[] = ($this->store->manajemenStore('objektif', 'fisikIbu'))->set($this->input, $valFisikIbu);
    //         $result[] = ($this->store->manajemenStore('objektif', 'janin'))->set($this->input, $valJanin);
    //         $result[] = ($this->store->manajemenStore('objektif', '10t'))->set($this->input, $val10T);
    //         $result[] = ($this->store->manajemenStore('objektif', 'usg'))->set($this->input, $valUsg);
    //         // melakukan penyimpanan pada database
    //         $this->HasilPemeriksaan_model->trans_commit();
    //         $this->response->send(200, 'berhasil diperbarui', $result);
    //     } catch (ServiceException $e) {
    //         $this->response->send($e->getHttpStatusCode(), $e->getMessage(), [], $e->getErrors());
    //     }
    // }
}
