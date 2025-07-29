<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class BirthLengthTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $length = $parameter['value'] ?? null;

        return [
            'birthLengthObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'vital-signs',
                    'display' => 'Vital-signs'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '89269-5',
                    'display' => 'Body height Measured --at birth'
                ],
                'valueQuantity' => [
                    'value' => (float) $length,
                    'unit' => 'cm',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'cm'
                ]
            ]
        ];
    }
}
