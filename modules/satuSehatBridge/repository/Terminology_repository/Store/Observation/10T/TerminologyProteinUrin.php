<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyProteinUrin implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, menggunakan nilai default 0.0. pada Protein Urin', 400);
        } elseif (!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada USG Protein Urin', 400);
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
                    'code' =>  '5804-0',
                    'display' => 'Protein [mass/volume] in urine by test strip',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B9.DE114',
                    'display' => 'Urine test conducted',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float) $parameter['value'] ?? 0.0,
                'unit' => 'mg/dL',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'mg/dL'
            ]
            ];
    }
}