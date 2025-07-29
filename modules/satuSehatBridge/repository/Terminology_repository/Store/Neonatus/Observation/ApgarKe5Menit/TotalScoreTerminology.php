<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TotalScoreTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $score = $parameter['value'] ?? null;

        $interpretation = null;

        if ($score <= 3) {
            $interpretation = [
                'code' => '57284007',
                'display' => 'Severe birth asphyxia'
            ];
        } elseif ($score >= 4 && $score <= 6) {
            $interpretation = [
                'code' => '77362009',
                'display' => 'Mild to moderate birth asphyxia'
            ];
        } elseif ($score >= 7) {
            $interpretation = [
                'code' => '275307002',
                'display' => 'Apgar normal'
            ];
        }

        return [
            'totalScoreObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '9274-2',
                    'display' => '5 minute Apgar Score'
                ],
                'valueQuantity' => [
                    'system' => 'http://unitsofmeasure.org',
                    'code' => '{score}',
                    'unit' => '{score}',
                    'value' => (float) $score
                ],
                'interpretation' => [
                    'system' => 'http://snomed.info/sct',
                    'code' => $interpretation['code'],
                    'display' => $interpretation['display']
                ]
            ]
        ];
    }
}
