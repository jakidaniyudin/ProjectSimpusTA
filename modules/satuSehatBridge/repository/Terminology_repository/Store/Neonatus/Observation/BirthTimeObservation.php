<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class BirthTimeObservation implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'birthTimeObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '57715-5',
                    'display' => 'Birth time'
                ],
                'valueTime' => $parameter['birthTime'] ?? null
            ]
        ];
    }
}
