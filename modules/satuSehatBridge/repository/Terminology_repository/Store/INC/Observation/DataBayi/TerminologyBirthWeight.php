<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyBirthWeight implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'category' => [
                'system'  => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code'    => 'vital-signs',
                'display' => 'Vital Signs',
            ],
            'code' => [
                [
                    'system'  => 'https://loinc.org',
                    'code'    => '8339-4',
                    'display' => 'Birth weight Measured',
                ]
            ],
            'status' => 'final',
            'valueQuantity' => [
                'value'  => (float) $parameter,
                'unit'   => 'g',
                'code'   => 'g',
                'system' => 'http://unitsofmeasure.org',
            ],
            'interpretation' => [
                $this->getInterpretation($parameter)
            ],
        ];
    }

    private function getInterpretation($parameter): array
    {
        if ($parameter < 1000) {
            return [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code'    => '276612004',
                'display' => 'Extremely low birth weight', 
            ];
        } elseif ($parameter <= 1499) {
            return [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code'    => '276611006',
                'display' => 'Very low birth weight infant', 
            ];
        } elseif ($parameter <= 2499) {
            return [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code'    => '276610007',
                'display' => 'Low birth weight infant', 
            ];
        } elseif ($parameter < 4000) {
            return [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code'    => '276712009',
                'display' => 'Normal birth weight', 
            ];
        } else {
            return [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code'    => '276613009',
                'display' => 'High birth weight', 
            ];
        }
    }
}
