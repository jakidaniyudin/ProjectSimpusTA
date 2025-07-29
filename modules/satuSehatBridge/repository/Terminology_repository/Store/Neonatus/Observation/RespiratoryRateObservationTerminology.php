<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class RespiratoryRateObservationTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = $parameter['value'] ?? null;

        return [
            'respiratoryRateObservation' => [
                'resourceType' => 'Observation',
                'code' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' => '9279-1',
                        'display' => 'Respiratory rate',
                    ]
                ],
                'category' => [
                    [
                        'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                        'code' => 'vital-signs',
                        'display' => 'Vital Signs',
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
