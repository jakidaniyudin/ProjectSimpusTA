<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologySuhu implements InterfaceTerminologyByStore
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
                    'code' => '8310-5',
                    'display' => 'Body temperature',
                ]
            ],
            'valueQuantity' => [
                'value' => $value,
                'unit' => 'C',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'Cel',
            ]
        ];
    }
}
