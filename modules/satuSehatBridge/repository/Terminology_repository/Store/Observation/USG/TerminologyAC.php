<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyAC implements InterfaceTerminologyByStore {
    public function getTerminology( $parameter): array
    {
        // Pastikan 'value' ada dan merupakan float atau numeric
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, menggunakan nilai default 0.0. pada USG AC', 400);
        } elseif (!is_numeric($parameter['value'])) {
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
                    'code' => '11979-2',
                    'display' => 'Fetal Head Circumference US',
                ],
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.SS.DE43',
                    'display' => 'Abdominal Circumference (AC) USG',
                ]
            ],
            'status' => 'final',
            'withQuantityValue' => [
                'value' => (float) $parameter['value'] ?? 0.0,
                'unit' => 'cm',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'cm',
            ]
        ];
    }
}