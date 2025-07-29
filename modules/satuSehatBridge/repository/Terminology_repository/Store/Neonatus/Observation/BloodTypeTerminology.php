<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class BloodTypeTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $valueCode = $parameter['valueCode'] ?? null;

        $displayMapping = [
            'LA19710-5' => 'Group A',
            'LA19709-7' => 'Group B',
            'LA19708-9' => 'Group O',
            'LA28449-9' => 'Group AB',
        ];

        return [
            'bloodTypeObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'laboratory',
                    'display' => 'Laboratory'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '883-9',
                    'display' => 'ABO group [Type] in Blood'
                ],
                'valueCodeableConcept' => [
                    'system' => 'http://loinc.org',
                    'code' => $valueCode,
                    'display' => $displayMapping[$valueCode] ?? null
                ]
            ]
        ];
    }
}
