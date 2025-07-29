<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyPernapasan implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = (float)($parameter['value'] ?? 0);

        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'vital-signs',
                'display' => 'Vital Signs',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' => '9279-1',
                    'display' => 'Respiratory rate',
                ]
            ],
            'valueQuantity' => [
                'value' => $value,
                'unit' => 'breaths/min',
                'system' => 'http://unitsofmeasure.org',
                'code' => '/min',
            ]
        ];
    }
}
