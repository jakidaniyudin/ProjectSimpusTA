<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class ObservasiBeratBadanUmurTerminologi implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = floatval($parameter['value'] ?? 0); // valueQuantity.value
        $status = $parameter['status'] ?? null;

        // Default interpretation dan reference range
        $interpretation = null;
        $referenceRange = null;

        if ($value < -3.01) {
            $interpretation = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => 'OI000007',
                'display' => 'Berat Badan Sangat Kurang'
            ];
            $referenceRange = [
                'low' => ['value' => null, 'unit' => '{Zscore}'],
                'high' => ['value' => -3.01, 'unit' => '{Zscore}'],
                'text' => 'Berat badan sangat kurang'
            ];
        } elseif ($value >= -3 && $value <= -2.01) {
            $interpretation = [
                'system' => 'http://snomed.info/sct',
                'code' => '248342006',
                'display' => 'Underweight'
            ];
            $referenceRange = [
                'low' => ['value' => -3, 'unit' => '{Zscore}'],
                'high' => ['value' => -2.01, 'unit' => '{Zscore}'],
                'text' => 'Underweight'
            ];
        } elseif ($value >= -2 && $value <= 1) {
            $interpretation = [
                'system' => 'http://snomed.info/sct',
                'code' => '43664005',
                'display' => 'Normal weight'
            ];
            $referenceRange = [
                'low' => ['value' => -2, 'unit' => '{Zscore}'],
                'high' => ['value' => 1, 'unit' => '{Zscore}'],
                'text' => 'Berat badan normal'
            ];
        } elseif ($value > 1) {
            $interpretation = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => 'OI000010',
                'display' => 'Risiko Berat Badan Lebih'
            ];
            $referenceRange = [
                'low' => ['value' => 1.01, 'unit' => '{Zscore}'],
                'high' => null,
                'text' => 'Risiko berat badan lebih'
            ];
        }

        return [
            'observasiBeratBadanUmur' => [
                'resourceType' => 'Observation',
                'status' => $status,
                'category' => [
                    [
                        'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                        'code' => 'exam',
                        'display' => 'Exam'
                    ]
                ],
                'code' => [
                    [
                        'system' => 'http://snomed.info/sct',
                        'code' => '1153593003',
                        'display' => 'Weight for age z-score'
                    ]
                ],
                'valueQuantity' => [
                    'value' => $value,
                    'unit' => '{Zscore}',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => '{Zscore}'
                ],
                'interpretation' => $interpretation ? [ $interpretation ] : null,
                'referenceRange' => $referenceRange ? [ $referenceRange ] : null
            ]
        ];
    }
}
