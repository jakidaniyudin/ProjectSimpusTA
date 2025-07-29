<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class BodyTemperatureObservationTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = $parameter['value'] ?? null;

        return [
            'bodyTemperatureObservation' => [
                'resourceType' => 'Observation',
                'code' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' => '8310-5',
                        'display' => 'Body temperature',
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
                    'unit' => 'Celcius',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'Cel',
                ]
            ]
        ];
    }
}
