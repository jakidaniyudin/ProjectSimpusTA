<?php
 

 require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyPartus implements InterfaceTerminologyByStore {

    public function getTerminology($parameter): array {
        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'survey',
                'display' => 'Survey',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' =>  '11996-6',
                    'display' => '[#] Parity',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B6.DE32',
                    'display' => 'Parity',
                ]
                ],
            'status' => 'final'
        ];
    }
}