<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class InisiasiMenyusuiDiniTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'inisiasiMenyusuiDiniProcedure' => [
                'category' => [
                    'system' => 'http://snomed.info/sct',
                    'code' => '440626008',
                    'display' => 'Procedure related to breastfeeding'
                ],
                'code' => [
                    'system' => 'http://snomed.info/sct',
                    'code' => '431868002',
                    'display' => 'Initiation of breastfeeding'
                ],
                'status' => $parameter['status'] ?? null // 'completed' (Ya) / 'not-done' (Tidak)
            ]
        ];
    }
}
