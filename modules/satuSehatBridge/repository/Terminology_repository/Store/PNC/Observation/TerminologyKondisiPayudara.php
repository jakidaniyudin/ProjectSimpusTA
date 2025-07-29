<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyKondisiPayudara implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $codes = $parameter['codes'] ?? [];

        if (!is_array($codes)) {
            $codes = [$codes];
        }

        $snomedMapping = [
            '300885006' => 'Swelling of breast',
            '290070001' => 'Red breast',
            '54302000'  => 'Discharge from nipple',
            '53430007'  => 'Pain of breast',
            '290084006' => 'Breast normal',
        ];

        $valueCoding = [];
        foreach ($codes as $code) {
            if (isset($snomedMapping[$code])) {
                $valueCoding[] = [
                    'system' => 'http://snomed.info/sct',
                    'code' => $code,
                    'display' => $snomedMapping[$code],
                ];
            }
        }

        return [
            'category' => [
                [
                    'system' => 'http://terminology.hl7.org/CodeSystem/condition-category',
                    'code' => 'exam',
                    'display' => 'Exam',
                ]
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' => '32422-8',
                    'display' => 'Physical findings of breast',

                ]
            ],
            'valueCodeableConcept' => [
                $valueCoding
            ]
        ];
    }
}
