<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/Token/TokenInterface.php');


class TokenCredetialSatuSehatRepository implements TokenInteface
{

    public function getPayload($credential): array
    {
        return [
            'client_id' => $credential['client_id'],
            'client_secret' =>  $credential['client_secret'],
        ];
    }
}