<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class MtbmProcedureTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'mtbmProcedure' => [
                'category' => [
                    [
                        'system' => 'http://snomed.info/sct',
                        'code' => '409063005',
                        'display' => 'Counseling'
                    ]
                ],
                'code' => [
                    [
                        'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                        'code' => 'PC000003',
                        'display' => 'Manajemen Terpadu Bayi Muda (MTBM)'
                    ]
                ],
                'status' => $parameter['status'] ?? null // "completed" atau "not-done"
            ]
        ];
    }
}
