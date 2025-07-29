<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyKalaIII implements InterfaceTerminologyByStore
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
                    'system'  => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                    'code'    => 'OC000018',
                    'display' => 'Onset Kala III',
                ]
            ],
            'status' => 'final',
            'valueDateTime' => date('c'), 
        ];
    }
}
