<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByLink.php');
require_once APPPATH . 'modules/satuSehatBridge/factory/ProtocolFactory.php';

class EpisodeOfCareTerminologyRepository implements InterfaceTerminologyByLink
{
    public function getTerminology($parameters)
    {
        $response = $this->protocol($parameters);
        if ($response ) {
            if(!empty($response['entry'])){
                $result = [
                    'uuid' =>  $response['entry'][0]['resource']['id'],
                ];
                return $result;
            }else{
                return false;
            }   
        } else {
            return false;
        }
    }

    public function protocol($parameters)
    {
        if ($parameters['patient_id'] && $parameters['baseUrl']) {
            $baseUrl = $parameters['baseUrl'];
            $enpoint  =  '/EpisodeOfCare?patient=' . $parameters['patient_id'] . '&type=ANC&status=active';
            $url =  $baseUrl . $enpoint;
            $header = [
                'Authorization: Bearer ' . $parameters['access_token']
            ];
            $payloadConfig = new HttpRequestRepository();
            $send = new ProtocolFactory($payloadConfig);
            return $send->send($url, $payload = [], $header, 'GET');
        } else {
            return false;
        }
    }
}