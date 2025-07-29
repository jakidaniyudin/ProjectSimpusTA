<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyNadi implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, menggunakan nilai default 0.0. pada Nadi', 400);
        } elseif (!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada Nadi', 400);
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
                    'code' =>  '8867-4',
                    'display' => 'Heart rate',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B8.DE36',
                    'display' => 'Pulse rate',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float)$parameter['value'] ?? 0.0,
                'unit' => 'beats/minute',
                'system' => 'http://unitsofmeasure.org',
                'code' => '/min'
            ]
            ];
    }
}