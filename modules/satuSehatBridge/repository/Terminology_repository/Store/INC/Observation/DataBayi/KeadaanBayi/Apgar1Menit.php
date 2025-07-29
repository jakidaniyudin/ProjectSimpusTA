<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class Apgar1Menit implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $responses = [
            'appearance' => [
                'code' => '32406-1',
                'display' => '1 minute Apgar Color',
                'answers' => [
                    ['code' => 'LA6722-8', 'display' => 'Biru, pucat'],
                    ['code' => 'LA6723-6', 'display' => 'Tubuh merah muda, ekstremitas biru'],
                    ['code' => 'LA6724-4', 'display' => 'Seluruh tubuh merah muda'],
                ]
            ],
            'pulse' => [
                'code' => '32407-9',
                'display' => '1 minute Apgar Heart rate',
                'answers' => [
                    ['code' => 'LA6716-0', 'display' => 'Tidak ada'],
                    ['code' => 'LA6717-8', 'display' => '<100 /mnt'],
                    ['code' => 'LA6718-6', 'display' => '>100 /mnt'],
                ]
            ],
            'grimace' => [
                'code' => '32409-5',
                'display' => '1 minute Apgar Reflex irritability',
                'answers' => [
                    ['code' => 'LA6719-4', 'display' => 'Tidak ada respon'],
                    ['code' => 'LA6720-2', 'display' => 'Meringis'],
                    ['code' => 'LA6721-0', 'display' => 'Terbatuk atau bersin'],
                ]
            ],
            'activity' => [
                'code' => '32408-7',
                'display' => '1 minute Apgar Muscle tone',
                'answers' => [
                    ['code' => 'LA6713-7', 'display' => 'Lemas'],
                    ['code' => 'LA6714-5', 'display' => 'Sedikit gerakan ekstremitas'],
                    ['code' => 'LA6715-2', 'display' => 'Bergerak aktif'],
                ]
            ],
            'respiration' => [
                'code' => '32410-3',
                'display' => '1 minute Apgar Respiratory effort',
                'answers' => [
                    ['code' => 'LA6725-1', 'display' => 'Tidak ada'],
                    ['code' => 'LA6726-9', 'display' => 'Perlahan (tidak teratur)'],
                    ['code' => 'LA6727-7', 'display' => 'Menangis kuat'],
                ]
            ],
        ];

        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'survey',
            'display' => 'Survey',
        ];

        $result = [];

        foreach ($responses as $key => $data) {
            $selectedCode = $parameter[$key] ?? $data['answers'][0]['code'];

            $selected = array_filter($data['answers'], function ($item) use ($selectedCode) {
                return $item['code'] === $selectedCode;
            });

            $selected = array_values($selected)[0] ?? $data['answers'][0];

            $result[$key] = [
                'category' => $category,
                'code' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' => $data['code'],
                        'display' => $data['display'],
                    ]
                ],
                'valueCodeableConcept' => [
                    'system' => 'http://loinc.org',
                    'code' => $selected['code'],
                    'display' => $selected['display'],
                ]
            ];
        }

        $totalScore = isset($parameter['score']) ? floatval($parameter['score']) : 0;
        $interpretation = [
            'code' => '57284007',
            'display' => 'Asfiksia berat',
        ];

        if ($totalScore >= 4 && $totalScore <= 6) {
            $interpretation = ['code' => '77362009', 'display' => 'Asfiksia sedang'];
        } elseif ($totalScore > 6) {
            $interpretation = ['code' => '275307002', 'display' => 'Bayi normal'];
        }

        $result['score'] = [
            'category' => $category,
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' => '9272-6',
                    'display' => '1 minute Apgar Score',
                ]
            ],
            'valueQuantity' => [
                'system' => 'http://unitsofmeasure.org',
                'code' => '{score}',
                'unit' => '{score}',
                'value' => $totalScore
            ],
            'interpretation' => [
                'coding' => [
                    [
                        'system' => 'http://snomed.info/sct',
                        'code' => $interpretation['code'],
                        'display' => $interpretation['display'],
                    ]
                ]
            ]
        ];

        return $result;
    }
}
