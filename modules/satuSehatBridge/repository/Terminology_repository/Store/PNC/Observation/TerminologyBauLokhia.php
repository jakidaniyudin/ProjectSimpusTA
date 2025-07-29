<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyBauLokhia implements InterfaceTerminologyByStore
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
                'code' => '249215002',
                'display' => 'Odor of lochia'
            ],
            'valueBoolean' => $valueBoolean
        ];
    }
}
