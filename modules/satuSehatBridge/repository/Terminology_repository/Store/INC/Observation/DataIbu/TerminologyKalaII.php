<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyKalaII implements InterfaceTerminologyByStore
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
                    'code'    => '249160009',
                    'display' => 'Onset of labor second stage',
                ]
            ],
            'status' => 'final',
            'valueDateTime' => date('c'), 
        ];
    }
}
