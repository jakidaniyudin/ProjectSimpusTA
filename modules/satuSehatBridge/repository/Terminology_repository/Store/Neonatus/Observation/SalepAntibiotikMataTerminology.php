<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class SalepAntibiotikMataTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'salepAntibiotikMataProcedure' => [
                'category' => [
                    'system' => 'http://snomed.info/sct',
                    'code' => '409063005',
                    'display' => 'Counseling'
                ],
                'code' => [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                    'code' => 'PC000002',
                    'display' => 'Pemberian Salep Antibiotik Mata'
                ],
                'status' => $parameter['status'] ?? null // 'completed' (Ya) / 'not-done' (Tidak)
            ]
        ];
    }
}
