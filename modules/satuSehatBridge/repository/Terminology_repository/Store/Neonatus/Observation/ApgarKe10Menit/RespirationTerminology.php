<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class RespirationTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $valueCode = $parameter['valueCode'] ?? null;

        $displayMapping = [
            'LA6725-1' => 'Not breathing',
            'LA6726-9' => 'Weak cry; may sound like whimpering, slow or irregular breathing',
            'LA6727-7' => 'Good, strong cry; normal rate and effort of breathing',
        ];

        return [
            'respirationObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '32405-3',
                    'display' => '10 minute Apgar Respiratory effort'
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
