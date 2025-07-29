<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class BirthWeightTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $weight = $parameter['value'] ?? null;

        $interpretationMapping = [
            4000 => [
                'code' => '276613009',
                'display' => 'High birth weight',
                'label' => 'BBLB (Bayi Berat Lahir Besar)',
            ],
            2500 => [
                'code' => '276712009',
                'display' => 'Normal birth weight',
                'label' => 'BBLC (Bayi Berat Lahir Cukup)',
            ],
            1500 => [
                'code' => '276610007',
                'display' => 'Low birth weight infant',
                'label' => 'BBLR (Bayi Berat Lahir Rendah)',
            ],
            1000 => [
                'code' => '276611006',
                'display' => 'Very low birth weight infant',
                'label' => 'BBLSR (Bayi Berat Lahir Sangat Rendah)',
            ],
            0 => [
                'code' => '276612004',
                'display' => 'Extremely low birth weight',
                'label' => 'BLASR (Bayi Berat Lahir Amat Sangat Rendah)',
            ],
        ];

        $interpretation = null;
        if (is_numeric($weight)) {
            if ($weight >= 4000) {
                $interpretation = $interpretationMapping[4000];
            } elseif ($weight >= 2500) {
                $interpretation = $interpretationMapping[2500];
            } elseif ($weight >= 1500) {
                $interpretation = $interpretationMapping[1500];
            } elseif ($weight >= 1000) {
                $interpretation = $interpretationMapping[1000];
            } else {
                $interpretation = $interpretationMapping[0];
            }
        }

        return [
            'birthWeightObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'vital-signs',
                    'display' => 'Vital-signs'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '8339-4',
                    'display' => 'Birth weight Measured'
                ],
                'valueQuantity' => [
                    'value' => (float) $weight,
                    'unit' => 'g',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'g'
                ],
                'interpretation' => $interpretation ? [
                    [
                        'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                        'code' => $interpretation['code'],
                        'display' => $interpretation['display'],
                    ],
                    'text' => $interpretation['label']
                ] : null
            ]
        ];
    }
}
