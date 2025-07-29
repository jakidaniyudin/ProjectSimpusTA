<?php 

require_once(APPPATH . 'modules/satuSehatBridge/interface/Token/TokenStorageInterface.php');
class TokenSatuSehatStorageRepository implements TokenStorageInterface {
    protected $timeExpired = 14200;
    protected $ci;

    public function __construct (){
        $this->$ci = &get_instance();
    }   


    public function get ($parameters){
        
    }
};