<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyKunjunganPNC implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'type' => [
                [
                    'system' => 'https://terminology.kemkes.go.id/CodeSystem/episodeofcare-type',
                    'code' => 'PNC',
                    'display' => 'Postnatal Care',
                ]
            ]
        ];
    }
}
