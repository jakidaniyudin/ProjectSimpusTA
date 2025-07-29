<?php 
require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyHpht implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'survey',
                'display' => 'Survey',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' =>  '8665-2',
                    'display' => 'Last menstrual period start date',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B6.DE14',
                    'display' => 'Last menstrual period (LMP) date',
                ]
                ],
            'status' => 'final'
        ];
    }
}