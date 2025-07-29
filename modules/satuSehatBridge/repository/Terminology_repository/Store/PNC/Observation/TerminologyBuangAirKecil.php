<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyBuangAirKecil implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = isset($parameter['value']) ? (bool)$parameter['value'] : false;

        return [
            'category' => [
                [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey'
                ]
            ],
            'code' => [
                'system' => 'http://snomed.info/sct',
                'code' => '102834005',
                'display' => 'Normal micturition'
            ],
            'valueBoolean' => $value
        ];
    }
}
