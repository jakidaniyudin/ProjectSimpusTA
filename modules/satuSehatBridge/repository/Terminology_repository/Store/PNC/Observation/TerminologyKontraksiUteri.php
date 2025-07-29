<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyKontraksiUteri implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        // Ambil nilai boolean dari parameter
        $valueBoolean = isset($parameter['value']) ? (bool)$parameter['value'] : false;

        return [
            'category' => [
                [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'exam',
                    'display' => 'Exam'
                ]
            ],
            'code' => [
                'system' => 'http://snomed.info/sct',
                'code' => '289700000',
                'display' => 'Uterine contractions present'
            ],
            'valueBoolean' => $valueBoolean
        ];
    }
}
