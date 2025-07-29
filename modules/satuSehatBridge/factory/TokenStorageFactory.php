<?php 

require_once(APPPATH . 'modules/satuSehatBridge/interface/Token/TokenStorageInterface.php');
require_once(APPPATH . 'modules/satuSehatBridge/repository/Token/TokenSatuSehatStorageRepository.php');
class TokenStorageFactory {
    protected $repository;
    public function __construct(TokenFactory $repository){
        $this->repository =  $repository;
    }

    public function get ($parameters){
        return $this->repository->get($parameters);
    }

    public function save ($parameters){
        return $this->repository->save($parameters);
    }

    public function update ($parameters){
        return $this->repository->save($parameters);
    }

}