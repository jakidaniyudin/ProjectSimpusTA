<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class BirthHeadCircumferenceTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $headCircumference = $parameter['value'] ?? null;

        return [
            'birthHeadCircumferenceObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'vital-signs',
                    'display' => 'Vital-signs'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '8290-9',
                    'display' => 'Head Occipital-frontal circumference --at birth- by Tape measure'
                ],
                'valueQuantity' => [
                    'value' => (float) $headCircumference,
                    'unit' => 'cm',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'cm'
                ]
            ]
        ];
    }
}
