<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyGulaDarah implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, menggunakan nilai default 0.0. pada USG AC', 400);
        } elseif (!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada USG AC', 400);
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
                    'code' =>  '74774-1',
                    'display' => 'Glucose [Mass/volume] in Serum, Plasma or Blood',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B9.DE159',
                    'display' => 'Blood glucose test conducted',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float)$parameter['value'] ?? 0.0,
                'unit' => 'mg/dL',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'mg/dL'
            ]
            ];
    }
}