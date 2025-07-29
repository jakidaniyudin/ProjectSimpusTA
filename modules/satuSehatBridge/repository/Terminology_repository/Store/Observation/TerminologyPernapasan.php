<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyPernapasan implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, menggunakan pada Pernapasan', 400);
        } elseif (!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada Pernapasan', 400);
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
                    'code' =>  '9279-1',
                    'display' => 'Respiratory rate',
                ],
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.SS.DE2',
                    'display' => 'Pernapasan',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float)$parameter['value'] ?? 0.0,
                'unit' => 'breaths/min',
                'system' => 'http://unitsofmeasure.org',
                'code' => '/min'
            ]
            ];
    }
}