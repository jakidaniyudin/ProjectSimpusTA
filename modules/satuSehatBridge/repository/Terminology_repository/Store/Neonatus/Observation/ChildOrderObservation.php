<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class ChildOrderObservation implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'childOrderObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey'
                ],
                'code' => [
                    'system' => 'http://snomed.info/sct',
                    'code' => '365475008',
                    'display' => 'Place in family order'
                ],
                'valueInteger' => $parameter['childOrder'] ?? null
            ]
        ];
    }
}
