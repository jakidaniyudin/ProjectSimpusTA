<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once (APPPATH . 'modules/satuSehatBridge/interface/InterfaceForm.php');
require_once (APPPATH . 'modules/satuSehatBridge/factory/SetupFactory.php');
class FormKunjuganDataRepository implements InterfaceForm {

    public function handle($data){
        $setUpPayload = new SetupFactory();
        if(!empty($data)){
            $payloadUsiaKehamilan =  $setUpPayload->setUpManajemen('observation_quantity_value')->setUp('usia_hamil', $data['usia_kehamilan']['value'],$uuidEcounter, $patientId, $patientName);
            $payloadTrimester = $setUpPayload->setUpManajemen('observation_int')->setUp('trimester',$data['trimester']['value'], $uuidEcounter, $patientId, $patientName);
            return [
                $payloadUsiaKehamilan,
                $payloadTrimester
            ];
        }else{
            return [];
        }
    }
}