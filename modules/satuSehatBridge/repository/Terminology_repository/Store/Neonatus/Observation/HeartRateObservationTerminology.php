<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class HeartRateObservationTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = $parameter['value'] ?? null;

        return [
            'heartRateObservation' => [
                'resourceType' => 'Observation',
                'code' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' => '8867-4',
                        'display' => 'Heart rate',
                    ]
                ],
                'category' => [
                    [
                        [
                            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                            'code' => 'vital-signs',
                            'display' => 'Vital Signs',
                        ]
                    ]
                ],
                'valueQuantity' => [
                    'value' => $value,
                    'unit' => '/min',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => '/min',
                ]
            ]
        ];
    }
}
