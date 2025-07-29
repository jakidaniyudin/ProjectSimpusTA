<?php 

require_once APPPATH . 'modules/satuSehatBridge/factory/ProtocolFactory.php';

class serviceProtocolIntegration {
    public function send(string $baseUrl, string $enpoint, $payload, $header,  $method)
    {
        $url = $baseUrl . $enpoint;
        $protocolConfig =  new HttpRequestRepository();
        $send = new ProtocolFactory($protocolConfig);
        return $send->send($url, $payload, $header, $method);
    }

    public function sendJsonType (string $baseUrl, string $enpoint, $payload, $header,  $method){
        $url = $baseUrl.$enpoint;
        $protocolConfig = new HttpRequestJSONTypeRepository();
        $send =  new ProtocolFactory($protocolConfig);
        return $send->send($url, $payload, $header, $method);
    }

}