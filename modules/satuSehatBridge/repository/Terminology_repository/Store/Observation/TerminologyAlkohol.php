<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyAlkohol implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $valueCodeableConcept = [];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Alkohol', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Alkohol', 400);
        }
        if(strtoupper($parameter['value']) === 'AKTIF'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '219006',
                'display' => 'Current drinker'
            ];
        }else if (strtoupper($parameter['value']) === 'TIDAK AKTIF'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '105542008',
                'display' => 'Non - drinker'
            ];
        }else {
            throw new ServiceException('Parameter "value" tidak sesuai pada Alkohol', 400);
        }


        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'social-history',
                'display' => 'Social History',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' =>  '11331-6',
                    'display' => 'History of Alcohol use',
                ]
            ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}