<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class ActivityTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $valueCode = $parameter['valueCode'] ?? null;

        $displayMapping = [
            'LA6713-7' => 'Limp; no movement',
            'LA6714-5' => 'Some flexion of arms and legs',
            'LA6715-2' => 'Active motion',
        ];

        return [
            'activityObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '32403-8',
                    'display' => '10 minute Apgar Muscle tone'
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
