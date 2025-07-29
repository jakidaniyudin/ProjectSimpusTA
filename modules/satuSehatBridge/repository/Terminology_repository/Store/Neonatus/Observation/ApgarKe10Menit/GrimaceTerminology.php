<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class GrimaceTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $valueCode = $parameter['valueCode'] ?? null;

        $displayMapping = [
            'LA6719-4' => 'No response to airways being suctioned',
            'LA6720-2' => 'Grimace during suctioning',
            'LA6721-0' => 'Grimace and pulling away, cough, or sneeze during suctioning',
        ];

        return [
            'grimaceObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '32404-6',
                    'display' => '10 minute Apgar Reflex irritability'
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
