<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyTanggalPersalinan implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $valueDateTime = $parameter['valueDateTime'] ?? date('c'); // default ISO 8601 jika tidak diberikan

        return [
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' => '93857-1',
                    'display' => 'Date and time of obstetric delivery',
                ]
            ],
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'survey',
                'display' => 'Survey',
            ],
            'valueDateTime' => $valueDateTime,
        ];
    }
}
