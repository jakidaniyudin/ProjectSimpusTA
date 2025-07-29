<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TaksiranBeratJanin implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Taksiran Berat Janin', 400);
        }elseif(!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa Taksiran Berat Janin', 400);
        }
       return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'exam',
                'display' => 'Exam',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' =>  '89087-1',
                    'display' => 'Fetal Body weight Estimated',
                ],
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.SS.DE1',
                    'display' => 'Taksiran Berat Janin (TBJ)',
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