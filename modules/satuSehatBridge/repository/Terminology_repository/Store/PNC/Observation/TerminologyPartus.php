<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyPartus implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = (int)($parameter['value'] ?? 0);

        return [
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' => '11977-6',
                    'display' => '[#] Parity',
                ]
            ],
            'valueInteger' => $value,
        ];
    }
}
