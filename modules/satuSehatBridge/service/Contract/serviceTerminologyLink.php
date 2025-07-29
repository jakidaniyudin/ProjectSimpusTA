<?php

require_once APPPATH . 'modules/satuSehatBridge/factory/ProtocolFactory.php';
require_once APPPATH . 'modules/satuSehatBridge/factory/TerminologyBaseFactoryByLink.php';

class serviceTerminologyLink
{

    public function getTerminologyLocation($baseUrl, $location_name, $accesToken)
    {
        $terminologyConfig =  new LocationTerminologyByNameRepository();
        $terminology =  new TerminologyBaseFactoryByLink($terminologyConfig);
        $parameters = [
            'baseUrl' => $baseUrl,
            'location_name' => $location_name,
            'access_token' => $accesToken
        ];
        return $terminology->getTerminology($parameters);
    }

    public function getTerminologyPatient($baseUrl, $pasien_id, $accesToken)
    {
        $terminologyConfig =  new PatientTerminologyRepository();
        $terminology =  new TerminologyBaseFactoryByLink($terminologyConfig);
        $parameters = [
            'baseUrl' => $baseUrl,
            'patient_id' =>  $pasien_id,
            'access_token' =>  $accesToken
        ];
        return $terminology->getTerminology($parameters);
    }

    public function getTerminologyEpisodeOfCare($baseUrl, $patientId, $accesToken)
    {
        $terminologyConfig =  new EpisodeOfCareTerminologyRepository();
        $terminology = new TerminologyBaseFactoryByLink($terminologyConfig);
        if($terminology){
            $parameters = [
                'baseUrl' =>  $baseUrl,
                'patient_id' => $patientId,
                'access_token' => $accesToken
            ];
            return $terminology->getTerminology($parameters);
        }else{
            return false;
        }
      
    }
}