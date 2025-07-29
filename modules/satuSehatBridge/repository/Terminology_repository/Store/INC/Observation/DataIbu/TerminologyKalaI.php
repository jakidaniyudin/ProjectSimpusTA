<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyKalaI implements InterfaceTerminologyByStore
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
                    'system'  => 'http://snomed.info/sct',
                    'code'    => '249120008',
                    'display' => 'Onset of labor first stage',
                ]
            ],
            'status' => 'final',
            'valueDateTime' => '2025-08-20T10:30:00+07:00', 
        ];
    }
}
