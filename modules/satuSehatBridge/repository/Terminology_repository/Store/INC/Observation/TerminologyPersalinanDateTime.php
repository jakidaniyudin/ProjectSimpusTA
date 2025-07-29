<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyPersalinanDateTime implements InterfaceTerminologyByStore
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
                    'code'    => '93857-1',
                    'display' => 'Date and time of obstetric delivery',
                ]
            ],
            'status' => 'final',
            'valueDateTime' => '2024-01-01T00:00:00+07:00' 
        ];
    }
}
