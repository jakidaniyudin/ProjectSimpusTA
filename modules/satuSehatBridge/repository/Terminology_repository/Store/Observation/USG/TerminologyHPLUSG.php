<?php 
require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyHPLUSG implements InterfaceTerminologyByStore {
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
                    'code' =>  '11781-2',
                    'display' => 'Delivery date US composite estimate',
                ],
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.SS.DE40',
                    'display' => 'Hari Perkiraan Lahir (HPL) USG',
                ]
                ],
            'status' => 'final'
        ];
    }
}