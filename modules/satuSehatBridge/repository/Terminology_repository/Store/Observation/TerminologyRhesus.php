<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyRhesus implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $valueCodeableConcept = [];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Rhesus', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Rhesus', 400);
        }
        if(strtoupper($parameter['value']) === '+'){
            $valueCodeableConcept = [
                'system' => 'http://loinc.org',
                'code'  => 'LA6576-8',
                'display' => 'Positive'
            ];
        }else if (strtoupper($parameter['value']) === '-'){
            $valueCodeableConcept = [
                'system' => 'http://loinc.org',
                'code'  => 'LA6577-6',
                'display' => 'Negative'
            ];
        }else {
            throw new ServiceException ('pilihan yang diimputkan tidak ada pada Rhesus', 400);
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
                    'code' =>  '10331-7',
                    'display' => 'Rh [Type] in Blood',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B9.DE29',
                    'display' => 'Rh factor',
                ]
                ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}