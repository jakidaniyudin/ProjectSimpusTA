<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class ObservasiAsiEksklusifTerminologi implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = $parameter['value'] ?? null; // Boolean: true/false
        $status = $parameter['status'] ?? null;

        return [
            'observasiAsiEksklusif' => [
                'resourceType' => 'Observation',
                'status' => $status,
                'category' => [
                    [
                        'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                        'code' => 'survey',
                        'display' => 'Survey'
                    ]
                ],
                'code' => [
                    [
                        'system' => 'http://snomed.info/sct',
                        'code' => '1145307003',
                        'display' => 'Exclusively breastfed'
                    ]
                ],
                'valueBoolean' => $value
            ]
        ];
    }
}
