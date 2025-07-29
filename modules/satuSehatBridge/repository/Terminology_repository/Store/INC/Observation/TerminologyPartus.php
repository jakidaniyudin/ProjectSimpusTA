<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyPartus implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'category' => [
                'system'  => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code'    => 'survey',
                'display' => 'Survey',
            ],
            'code' => [
                [
                    'system'  => 'http://loinc.org',
                    'code'    => '11977-6',
                    'display' => '[#] Parity',
                ]
            ],
            'status' => 'final',
            'valueInteger' => 0 
        ];
    }
}
