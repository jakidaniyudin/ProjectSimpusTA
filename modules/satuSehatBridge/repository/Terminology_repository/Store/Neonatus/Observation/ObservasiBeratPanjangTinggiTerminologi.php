<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class ObservasiBeratPanjangTinggiTerminologi implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = floatval($parameter['value'] ?? 0); // valueQuantity.value
        $status = $parameter['status'] ?? null;
        $kodePengamatan = $parameter['code'] ?? '1153598007'; // default: Weight for length z score

        // Default interpretation dan reference range
        $interpretation = null;
        $referenceRange = null;

        if ($value < -3.01) {
            $interpretation = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => 'OI000011',
                'display' => 'Gizi Buruk'
            ];
            $referenceRange = [
                'low' => ['value' => null, 'unit' => '{Zscore}'],
                'high' => ['value' => -3.01, 'unit' => '{Zscore}'],
                'text' => 'Gizi Buruk'
            ];
        } elseif ($value >= -3 && $value <= -2.01) {
            $interpretation = [
                'system' => 'http://snomed.info/sct',
                'code' => '248325000',
                'display' => 'Undernourished'
            ];
            $referenceRange = [
                'low' => ['value' => -3, 'unit' => '{Zscore}'],
                'high' => ['value' => -2.01, 'unit' => '{Zscore}'],
                'text' => 'Gizi Kurang'
            ];
        } elseif ($value >= -2 && $value <= 1) {
            $interpretation = [
                'system' => 'http://snomed.info/sct',
                'code' => '248324001',
                'display' => 'Well nourished'
            ];
            $referenceRange = [
                'low' => ['value' => -2, 'unit' => '{Zscore}'],
                'high' => ['value' => 1, 'unit' => '{Zscore}'],
                'text' => 'Gizi Baik'
            ];
        } elseif ($value > 1 && $value <= 2) {
            $interpretation = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => 'OI000004',
                'display' => 'Risiko Gizi Lebih'
            ];
            $referenceRange = [
                'low' => ['value' => 1.01, 'unit' => '{Zscore}'],
                'high' => ['value' => 2, 'unit' => '{Zscore}'],
                'text' => 'Risiko Gizi Lebih'
            ];
        } elseif ($value > 2 && $value <= 3) {
            $interpretation = [
                'system' => 'http://snomed.info/sct',
                'code' => '238131007',
                'display' => 'Overweight'
            ];
            $referenceRange = [
                'low' => ['value' => 2.01, 'unit' => '{Zscore}'],
                'high' => ['value' => 3, 'unit' => '{Zscore}'],
                'text' => 'Gizi Lebih'
            ];
        } elseif ($value > 3) {
            $interpretation = [
                'system' => 'http://snomed.info/sct',
                'code' => '414915002',
                'display' => 'Obese'
            ];
            $referenceRange = [
                'low' => ['value' => 3.01, 'unit' => '{Zscore}'],
                'high' => null,
                'text' => 'Obesitas'
            ];
        }

        // Menentukan display dari kode pengamatan
        $displayKode = match ($kodePengamatan) {
            '1153598007' => 'Weight for length z score',
            '1153600001' => 'Weight for height z-score',
            default => 'Berat badan terhadap panjang atau tinggi badan'
        };

        return [
            'observasiBeratPanjangTinggi' => [
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
