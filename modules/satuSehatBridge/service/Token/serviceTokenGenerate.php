<?php 
require_once APPPATH . 'modules/satuSehatBridge/factory/TokenFactory.php';
require_once APPPATH . 'modules/satuSehatBridge/service/serviceProtocolIntegration.php';

class serviceTokenGenerate {
    protected $sendService; 
    public function __construct (){
        $this->sendService = new serviceProtocolIntegration();
    }

    public function generateToken($baseUrl,$clientId,$clientSecret)
    {

        $payload =  $this->generateTokenPayload($clientId, $clientSecret);
        $header =[
            'Content-Type: application/x-www-form-urlencoded'
        ];
        
        $endpoint = '/accesstoken?grant_type=client_credentials';
        return $this->sendService->send($baseUrl, $endpoint, $payload, $header, 'POST');
    }
    
    public function generateTokenPayload($clientId, $clientSecret)
    {
        $payloadClass = new TokenCredetialSatuSehatRepository();
        $payloadToken =  new TokenFactory($payloadClass);
        $credential = [
            'client_id' =>  $clientId,
            'client_secret' =>  $clientSecret
        ];
        return $payloadToken->getPayload($credential);
    }

}