<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class VitaminKProcedureTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'vitaminKProcedure' => [
                'category' => [
                    [
                        'system' => 'http://snomed.info/sct',
                        'code' => '409063005',
                        'display' => 'Counseling'
                    ]
                ],
                'code' => [
                    [
                        'system' => 'http://snomed.info/sct',
                        'code' => '448883004',
                        'display' => 'Injection of vitamin K1'
                    ]
                ],
                'status' => $parameter['status'] ?? null // Nilainya "completed" atau "not-done"
            ]
        ];
    }
}
