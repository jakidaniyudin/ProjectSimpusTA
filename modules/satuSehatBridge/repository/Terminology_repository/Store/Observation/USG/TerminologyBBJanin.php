<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyBBJanin implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if (!isset($parameter['value']) || !is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada USG AC', 400);
        }
       return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'imaging',
                'display' => 'Imaging',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' =>  '11727-5',
                    'display' => 'Fetal Body weight estimated by US',
                ],
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.SS.DE45',
                    'display' => 'Berat janin USG',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float) $parameter['value'] ?? 0.0,
                'unit' => 'g',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'g'
            ]
            ];
    }
}