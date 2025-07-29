<?php  

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyBBSebelumHamil implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada BB Sebelum Hamil', 400);
        }elseif(!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada BB Sebelum Hamil', 400);
        }
        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'survey',
                'display' => 'Survey',
            ],
            'code' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' =>  '56077-1',
                        'display' => 'Body weight --pre current pregnancy',
                    ],
                    [
                        'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                        'code' => 'ANC.B8.DE2',
                        'display' => 'Pre-gestational weight',
                    ]
                ],
            'status' => 'final',
            'withQuantityValue' => [
                'value' =>  (float)$parameter['value'] ?? 0.0,
                'unit' => 'kg',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'kg'
            ]
        ];
    }
}