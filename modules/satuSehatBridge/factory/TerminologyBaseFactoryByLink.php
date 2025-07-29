<?php 
require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByLink.php');
require_once(APPPATH . 'modules/satuSehatBridge/repository/Terminology_repository/Link/LocationTerminologyByNameRepository.php');
require_once(APPPATH . 'modules/satuSehatBridge/repository/Terminology_repository/Link/EpisodeOfCareTerminologyRepository.php');


class TerminologyBaseFactoryByLink {
    protected $repository;

    public function __construct(InterfaceTerminologyByLink $repository){
        $this->repository =  $repository;
    }
    public function getTerminology ($parameters){
       return  $this->repository->getTerminology($parameters);
    }
}