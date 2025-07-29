<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyKunjunganNeonatus implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'type' => [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/episodeofcare-type',
                'code' => 'Neonate',
                'display' => 'Neonate'
            ]
        ];
    }
}
