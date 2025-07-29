<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyPPIARPR implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $valueCodeableConcept = [];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada PPIA RPR', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada PPIA RPR', 400);
        }
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
            throw new ServiceException ('pilihan yang diimputkan tidak ada pada Letak Janin', 400);
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
                    'code' =>  '20508-8',
                    'display' => 'Reagin Ab [Units/volume] in Serum or Plasma by RPR',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B9.DE96',
                    'display' => 'Syphilis test conducted',
                ]
                ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}