<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyGravida implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = (int)($parameter['value'] ?? 0);

        return [
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' => '11996-6',
                    'display' => '[#] Pregnancies',
                ]
            ],
            'valueInteger' => $value,
        ];
    }
}
