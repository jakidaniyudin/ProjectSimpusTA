<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class KunjunganNeonatusKN2 implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'resourceType' => 'Encounter',
            'identifier' => [
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/episodeofcare/neonate',
                    'value' => 'KN2'
                ]
            ],
            'status' => 'finished',
            'class' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
                'code' => 'AMB',
                'display' => 'Ambulatory'
            ],
            'period' => [
                'start' => $parameter['start'] ?? null,
                'end' => $parameter['end'] ?? null
            ]
        ];
    }
}
