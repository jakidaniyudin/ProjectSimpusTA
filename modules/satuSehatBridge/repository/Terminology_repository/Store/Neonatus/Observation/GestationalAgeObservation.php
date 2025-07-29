<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class GestationalAgeObservation implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'gestationalAgeObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '76516-4',
                    'display' => 'Gestational age—at birth'
                ],
                'valueQuantity' => [
                    'system' => 'http://unitsofmeasure.org',
                    'value' => $parameter['gestationalAge'] ?? null,
                    'code' => 'wk',
                    'unit' => 'Wk'
                ]
            ]
        ];
    }
}
