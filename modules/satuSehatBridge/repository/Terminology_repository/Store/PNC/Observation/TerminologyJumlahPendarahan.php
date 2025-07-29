<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyJumlahPendarahan implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = (float)($parameter['value'] ?? 0);

        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'exam',
                'display' => 'Exam',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' => '81661-1',
                    'display' => 'Blood Loss [Volume] Measured',
                ]
            ],
            'valueQuantity' => [
                'value' => $value,
                'unit' => 'mL',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'mL',
            ]
        ];
    }
}
