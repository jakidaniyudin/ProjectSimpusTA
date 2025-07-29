<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyTandaInfeksiSectio implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = filter_var($parameter['value'] ?? false, FILTER_VALIDATE_BOOLEAN);

        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'exam',
                'display' => 'Exam',
            ],
            'code' => [
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                    'code' => 'OC000025',
                    'display' => 'Tanda Infeksi Luka Jahitan Sectio Caesaria',
                ]
            ],
            'valueBoolean' => $value
        ];
    }
}
