<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class ObservasiPanjangTinggiUmurTerminologi implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = floatval($parameter['value'] ?? 0); 
        $status = $parameter['status'] ?? null;
        $kodePengamatan = $parameter['code'] ?? '1153590000'; 

        $interpretation = null;
        $referenceRange = null;

        if ($value < -3.01) {
            $interpretation = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => 'OI000011',
                'display' => 'Sangat Pendek'
            ];
            $referenceRange = [
                'low' => ['value' => null, 'unit' => '{Zscore}'],
                'high' => ['value' => -3.01, 'unit' => '{Zscore}'],
                'text' => 'Berat badan sangat kurang'
            ];
        } elseif ($value >= -3 && $value <= -2.01) {
            $interpretation = [
                'system' => 'http://snomed.info/sct',
                'code' => '444000005',
                'display' => 'Short stature for age'
            ];
            $referenceRange = [
                'low' => ['value' => -3, 'unit' => '{Zscore}'],
                'high' => ['value' => -2.01, 'unit' => '{Zscore}'],
                'text' => 'Pendek'
            ];
        } elseif ($value >= -2 && $value <= 3) {
            $interpretation = [
                'system' => 'http://snomed.info/sct',
                'code' => '17489000',
                'display' => 'Body height normal for age'
            ];
            $referenceRange = [
                'low' => ['value' => -2, 'unit' => '{Zscore}'],
                'high' => ['value' => 3, 'unit' => '{Zscore}'],
                'text' => 'Normal'
            ];
        } elseif ($value > 3) {
            $interpretation = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => '83077003',
                'display' => 'Tall for age'
            ];
            $referenceRange = [
                'low' => ['value' => 3.01, 'unit' => '{Zscore}'],
                'high' => null,
                'text' => 'Tinggi'
            ];
        }

        $displayKode = match ($kodePengamatan) {
            '1153590000' => 'Length for age z-score',
            '1153604005' => 'Body height for age z score',
            default => 'Panjang atau Tinggi untuk umur'
        };

        return [
            'observasiPanjangTinggiUmur' => [
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
                        'code' => $kodePengamatan,
                        'display' => $displayKode
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
