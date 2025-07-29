<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyKondisiPerineum implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = (string)($parameter['value'] ?? '');

        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/condition-category',
                'code' => 'exam',
                'display' => 'Exam',
            ],
            'code' => [
                [
                    'system' => 'http://snomed.info/sct',
                    'code' => '364297003',
                    'display' => 'Female perineum observable',
                ]
            ],
            'valueString' => $value
        ];
    }
}
