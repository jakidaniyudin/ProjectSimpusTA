<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyGolonganDarah implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $valueCodeableConcept = [];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Golongan Darah', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Golongan Darah', 400);
        }
        if(strtoupper($parameter['value']) === 'A'){
            $valueCodeableConcept = [
                'system' => 'http://loinc.org',
                'code'  => 'LA19710-5',
                'display' => 'Group A'
            ];
        }else if (strtoupper($parameter['value']) === 'B'){
            $valueCodeableConcept = [
                'system' => 'http://loinc.org',
                'code'  => 'LA19709-7',
                'display' => 'Group B'
            ];
        }else if (strtoupper($parameter['value']) === 'O'){
            $valueCodeableConcept = [
                'system' => 'http://loinc.org',
                'code'  => 'LA19708-9',
                'display' => 'Group O'
            ];
        }else if (strtoupper($parameter['value']) === 'AB'){
            $valueCodeableConcept = [
                'system' => 'http://loinc.org',
                'code'  => 'LA28449-9',
                'display' => 'Group AB'
            ];
        }else {
            throw new ServiceException ('pilihan yang diimputkan tidak ada pada Golongan Darah', 400);
        }


        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'laboratory',
                'display' => 'Laboratory',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' =>  '883-9',
                    'display' => 'ABO group [Type] in Blood',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B9.DE24',
                    'display' => 'Blood type',
                ]
                ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}