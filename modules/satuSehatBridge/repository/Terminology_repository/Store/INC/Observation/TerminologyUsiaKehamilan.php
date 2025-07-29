<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyUsiaKehamilan implements InterfaceTerminologyByStore
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
                    'code'    => '18185-9',
                    'display' => 'Gestational age',
                ]
            ],
            'status' => 'final',
            'valueQuantity' => [
                'value'  => 0.0,
                'unit'   => 'wk',
                'system' => 'http://unitsofmeasure.org',
                'code'   => 'wk',
            ]
        ];
    }
}
