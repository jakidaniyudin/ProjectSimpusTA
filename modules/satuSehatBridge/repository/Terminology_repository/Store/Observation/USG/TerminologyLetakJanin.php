<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyLetakJanin implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $valueCodeableConcept = [];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Letak Janin', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Letak Janin', 400);
        }
        if(strtoupper($parameter['value']) === 'INTRAUTERI'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '398236008',
                'display' => 'Intrauterine'
            ];
        }else if (strtoupper($parameter['value']) === 'EKSTRAUTERI'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '298109001',
                'display' => 'Ectopic'
            ];
        }else {
            throw new ServiceException ('pilihan yang diimputkan tidak ada pada Letak Janin', 400);
        }


        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'imaging',
                'display' => 'Imaging',
            ],
            'code' => [
                [
                    'system' => 'http://snomed.info/sct',
                    'code' =>  '271692001',
                    'display' => 'Presentation of fetus',
                ],
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.SS.DE41',
                    'display' => 'Letak Janin USG',
                ]
                ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}