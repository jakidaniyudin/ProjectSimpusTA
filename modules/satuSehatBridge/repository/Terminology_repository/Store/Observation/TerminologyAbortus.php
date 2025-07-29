<?php  

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyAbortus implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array
    {
        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'survey',
                'display' => 'Survey',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' =>  '69043-8',
                    'display' => 'Other pregnancy outcomes #',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B6.DE25',
                    'display' => 'Number of miscarriages and/or abortions',
                ]
            ],
            'status' =>  'final'
    
        ];
    }
}