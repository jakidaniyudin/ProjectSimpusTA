<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyPerdarahanPervaginam implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/condition-category',
                'code' => 'problem-list-item',
                'display' => 'Problem List Item',
            ],
            'code' => [
                [
                    'system' => 'http://snomed.info/sct',
                    'code' => '289530006',
                    'display' => 'Vaginal bleeding',
                ]
            ]
        ];
    }
}
