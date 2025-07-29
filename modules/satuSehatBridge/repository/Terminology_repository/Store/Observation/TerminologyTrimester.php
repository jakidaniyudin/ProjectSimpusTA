<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyTrimester implements InterfaceTerminologyByStore {
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
                    'code' =>  '32418-6',
                    'display' => 'Obstetric trimester Stated',
                ],
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.SS.DE13',
                    'display' => 'Trimester ke',
                ]
            ]
            ];
    }
}