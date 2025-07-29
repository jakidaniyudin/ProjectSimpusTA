<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyBeratBadan implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Berat Badan', 400);
        }elseif(!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Berat Badan', 400);
        }
       return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'vital-signs',
                'display' => 'Vital Signs',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' =>  '29463-7',
                    'display' => 'Body weight',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B8.DE3',
                    'display' => 'Current weight',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float) $parameter['value'] ?? 0.0,
                'unit' => 'mo',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'mo'
            ]
            ];
    }
}