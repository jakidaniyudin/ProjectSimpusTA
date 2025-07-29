<?php  

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyIMT implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $interpretation = [];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada IMT', 400);
        }elseif(!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada IMT', 400);
        }
        if ($parameter['value'] <= 18.4) {
            $interpretation = [
                "system" => "http://snomed.info/sct",
                "code" => "248342006",
                "display" =>  "Underweight"
            ];
        } elseif ($parameter['value'] >= 18.5 && $parameter['value'] <= 24.9) {
            $interpretation = [
                "system" => "http://snomed.info/sct",
                "code" => "43664005",
                "display" =>  "Normal weight"
            ];
        } elseif ($parameter['value'] >= 25 && $parameter['value'] <= 29.9) {
            $interpretation = [
                "system" => "http://snomed.info/sct",
                "code" => "238131007",
                "display" =>  "Overweight"
            ];
        } elseif ($parameter['value'] >= 30) {
            $interpretation = [
                "system" => "http://snomed.info/sct",
                "code" => "414915002",
                "display" =>  "Obese"
            ];
        } else {
            throw new ServiceException('Parameter "value" tidak sesuai pada IMT', 400);
        }


        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'exam',
                'display' => 'Exam',
            ],
            'code' => [
                    [
                        'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                        'code' =>  'OC000010',
                        'display' => 'Indeks Massa Tubuh Sebelum Hamil',
                    ],
                    [
                        'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                        'code' => 'ANC.SS.DE58',
                        'display' => 'IMT Sebelum Hamil',
                    ]
                ],
            'status' => 'final',
            'interpretation' => $interpretation,
            'withQuantityValue' => [
                    'value' => (float) $parameter['value'] ?? 0.0,
                    'unit' => 'kg/m2',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'kg/m2'
            ],
            'range' =>  [
                [
                    'high' => [
                        'value' => 18.4,
                        'unit' => 'kg/m2',
                        'system' => 'http://unitsofmeasure.org',
                        'code' => 'kg/m2'
                    ],
                    'text' => 'Kurus'
                ],
                [
                    'low' => [
                        'value' => 18.5,
                        'unit' => 'kg/m2',
                        'system' => 'http://unitsofmeasure.org',
                        'code' => 'kg/m2'
                    ],
                    'high' => [
                        'value' => 24.9,
                        'unit' => 'kg/m2',
                        'system' => 'http://unitsofmeasure.org',
                        'code' => 'kg/m2'
                    ],
                    'text' => 'Normal'
                ],
                [
                    'low' => [
                        'value' => 25,
                        'unit' => 'kg/m2',
                        'system' => 'http://unitsofmeasure.org',
                        'code' => 'kg/m2'
                    ],
                    'high' => [
                        'value' => 29.9,
                        'unit' => 'kg/m2',
                        'system' => 'http://unitsofmeasure.org',
                        'code' => 'kg/m2'
                    ],
                    'text' => 'Gemuk'
                ],
                [
                    'low' => [
                        'value' => 30,
                        'unit' => 'kg/m2',
                        'system' => 'http://unitsofmeasure.org',
                        'code' => 'kg/m2'
                    ],
                    'text' => 'Obesitas'
                ]
            ]
        ]; 
    }
}