<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyBodyLengthBirth implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'category' => [
                'system'  => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code'    => 'vital-signs',
                'display' => 'Vital Signs',
            ],
            'code' => [
                [
                    'system'  => 'https://loinc.org',
                    'code'    => '89269-5',
                    'display' => 'Body height Measured --at birth',
                ]
            ],
            'status' => 'final',
            'valueQuantity' => [
                'value'  => 0.0,
                'unit'   => 'cm',
                'code'   => 'cm',
                'system' => 'http://unitsofmeasure.org',
            ]
        ];
    }
}
