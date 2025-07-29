<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyTNBB implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $valueCodeableConcept = [];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada TNBB', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada TNBB', 400);
        }
        $input = str_replace(['–', ','], ['-', '.'], $parameter['value']);

        if ($input === '5-9') {
            $valueCodeableConcept = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code'  => 'OV000008',
                'display' => '5–9 kg'
            ];
        } else if ($input === '7-11.5') {
            $valueCodeableConcept = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code'  => 'OV000009',
                'display' => '7–11.5 kg'
            ];
        } else if ($input === '11.5-16') {
            $valueCodeableConcept = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code'  => 'OV000010',
                'display' => '11.5–16 kg'
            ];
        } else if ($input === '12.5-18') {
            $valueCodeableConcept = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code'  => 'OV000011',
                'display' => '12.5–18 kg'
            ];
        } else {
            throw new ServiceException('pilihan yang diimputkan tidak ada pada TNBB', 400);
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
                    'code' =>  'OC000011',
                    'display' => 'Target Kenaikan Berat Badan',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B8.DE10',
                    'display' => 'Expected weight gain',
                ]
                ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}