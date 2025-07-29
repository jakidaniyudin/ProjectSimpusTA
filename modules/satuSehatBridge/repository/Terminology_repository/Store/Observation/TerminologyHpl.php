<?php 

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyHpl implements InterfaceTerminologyByStore {
    public function  getTerminology($parameter): array {
        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'survey',
                'display' => 'Survey',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' =>  '11778-8',
                    'display' => 'Delivery date Estimated',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B6.DE22',
                    'display' => 'Expected date of delivery (EDD)',
                ]
                ],
    
            'status' => 'final'
        ];  
    }
}