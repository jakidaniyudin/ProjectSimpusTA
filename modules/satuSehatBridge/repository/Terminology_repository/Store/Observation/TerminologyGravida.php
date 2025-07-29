<?php 
require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyGravida implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array 
    {
        return [
            'code' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' =>  '11996-6',
                        'display' => '[#] Pregnancies',
                    ],
                    [
                        'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                        'code' => 'ANC.B6.DE24',
                        'display' => 'Number of pregnancies (gravida)',
                    ]
                ],
            'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey',
                ]
        ];
    }
}