<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class RhesusTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $valueCode = $parameter['valueCode'] ?? null;

        $displayMapping = [
            'LA6576-8' => 'Positive',
            'LA6577-6' => 'Negative',
        ];

        return [
            'rhesusObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'laboratory',
                    'display' => 'Laboratory'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '10331-7',
                    'display' => 'Rh [Type] in Blood'
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
