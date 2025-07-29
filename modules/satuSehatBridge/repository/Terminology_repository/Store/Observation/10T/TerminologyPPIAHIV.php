<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyPPIAHIV implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada PPIA HIV', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada PPIA HIV', 400);
        }
        $valueCodeableConcept = [];
        if(strtoupper($parameter['value']) === 'REAKTIF'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '11214006',
                'display' => 'Reactive'
            ];
        }else if (strtoupper($parameter['value']) === 'NON REAKTIF'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '131194007',
                'display' => 'Non-Reactive'
            ];
        }else {
            throw new ServiceException ('pilihan yang diimputkan tidak ada pada PPIA HIV', 400);
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
                    'code' =>  '68961-2',
                    'display' => 'HIV 1 Ab [Presence] in Serum, Plasma or Blood by Rapid immunoassay',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B9.DE32',
                    'display' => 'HIV test',
                ]
                ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}