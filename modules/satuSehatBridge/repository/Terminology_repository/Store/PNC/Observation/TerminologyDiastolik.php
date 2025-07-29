<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyDiastolik implements InterfaceTerminologyByStore
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
                    'code' => '8462-4',
                    'display' => 'Diastolic blood pressure',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'display' => 'Diastolic blood pressure',
                ]
            ],
            'valueQuantity' => [
                'value' => $value,
                'unit' => 'mm[Hg]',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'mm[Hg]',
            ]
        ];
    }
}
