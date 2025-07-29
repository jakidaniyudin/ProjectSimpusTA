<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyKonselingPerawatanBayi implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $status = $parameter['status'] ?? 'not-done'; // default ke "not-done" jika tidak ada

        return [
            'code' => [
                'system' => 'http://snomed.info/sct',
                'code' => '408988007',
                'display' => 'Newborn care education'
            ],
            'status' => $status
        ];
    }
}
