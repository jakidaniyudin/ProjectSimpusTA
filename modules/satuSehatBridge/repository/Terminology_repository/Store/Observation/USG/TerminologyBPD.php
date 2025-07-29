<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyBPD implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, menggunakan nilai default 0.0. pada USG BPD', 400);
        } elseif (!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada USG BPD', 400);
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
                    'code' =>  '11820-8',
                    'display' => 'Fetal Head Diameter.biparietal US',
                ],
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.SS.DE59',
                    'display' => 'Biparietal Diameter (BPD) USG',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float) $parameter['value'] ?? 0.0,
                'unit' => 'cm',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'cm'
            ]
            ];
    }
}