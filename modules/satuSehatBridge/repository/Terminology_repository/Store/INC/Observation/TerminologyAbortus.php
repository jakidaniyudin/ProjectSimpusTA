<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyAbortus implements InterfaceTerminologyByStore
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
                    'code'    => '69043-8',
                    'display' => 'Other pregnancy outcomes #',
                ]
            ],
            'status' => 'final',
            'valueInteger' => 0 
        ];
    }
}
