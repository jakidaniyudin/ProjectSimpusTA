<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyWarnaLokhia implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $code = $parameter['code'] ?? null;
        $snomedMapping = [
            '278072004' => 'Lochia rubra',  
            '449828001' => 'Lochia serosa',  
            '449827006' => 'Lochia alba',   
        ];
        $valueCodeableConcept = [];

        if ($code && isset($snomedMapping[$code])) {
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code' => $code,
                'display' => $snomedMapping[$code]
            ];
        }

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
                'code' => '249214003',
                'display' => 'Color of lochia'
            ],
            'valueCodeableConcept' => $valueCodeableConcept
        ];
    }
}
