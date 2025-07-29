<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyAbortus implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = (int)($parameter['value'] ?? 0);

        return [
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' => '69043-8',
                    'display' => 'Other pregnancy outcomes #',
                ]
            ],
            'valueInteger' => $value,
        ];
    }
}
