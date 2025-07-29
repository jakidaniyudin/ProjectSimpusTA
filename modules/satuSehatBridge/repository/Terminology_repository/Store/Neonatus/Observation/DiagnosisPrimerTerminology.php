<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class DiagnosisPrimerTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'diagnosis' => [
                [
                    'condition' => [
                        'reference' => 'Condition/' . ($parameter['condition_id'] ?? 'UNKNOWN')
                    ],
                    'use' => [
                        'coding' => [
                            [
                                'system' => 'http://terminology.hl7.org/CodeSystem/diagnosis-role',
                                'code' => 'DD',
                                'display' => 'Discharge diagnosis'
                            ]
                        ]
                    ],
                    'rank' => 1
                ]
            ]
        ];
    }
}
