<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class PerawatanTaliPusatTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'perawatanTaliPusatProcedure' => [
                'category' => [
                    'system' => 'http://snomed.info/sct',
                    'code' => '409063005',
                    'display' => 'Counseling'
                ],
                'code' => [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                    'code' => 'PC000001',
                    'display' => 'Perawatan Tali Pusat'
                ],
                'status' => $parameter['status'] ?? null // 'completed' atau 'not-done'
            ]
        ];
    }
}
