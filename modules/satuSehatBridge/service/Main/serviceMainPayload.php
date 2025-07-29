<?php 

require_once APPPATH . 'modules/satuSehatBridge/factory/MainPayloadFactory.php';

class serviceMainPayload {
    public function mainPayloadCreate(array $payloads): string
    {
        $payloadConfig = new MainPayloadBundleSatuSehatRepository();
        $payload =  new  MainPayloadFactory($payloadConfig);
        return $payload->setBase($payloads);
    }
}