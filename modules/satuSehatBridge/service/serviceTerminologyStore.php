<?php 

require_once APPPATH . 'modules/satuSehatBridge/factory/TerminolgyBaseFactoryByStore.php';
class serviceTerminologyStore {
    protected $terminology;
    public function __construct(){
        $this->terminology =  new TerminolgyBaseFactoryByStore();

    }
    public function setUpTerminology($type, $parameter){
        $terminologyClass =  $this->terminology->getTerminology($type);
        return $terminologyClass->getTerminology($parameter);
    }

  
}