<?php

require_once APPPATH . 'modules/satuSehatBridge/service/serviceProtocolIntegration.php';
class serviceSenderIntegration
{
    protected $sendService;

    public function  __construct()
    {
        $this->sendService = new serviceProtocolIntegration();
    }


    public function bundleANCSender($baseUrl, $payload, $accessToken)
    {
        $enpoint = "";
        $header = [
            'Authorization: Bearer ' . $accessToken['access_token']
        ];

        return $this->sendService->sendJsonType($baseUrl, $enpoint, $payload, $header, 'POST');
    }
}