<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyUsiaKehamilanUSG implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, menggunakan nilai default 0.0. pada USG Usia Kehamilan', 400);
        } elseif (!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada USG Usia Kehamilan', 400);
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
                    'code' =>  '11888-5',
                    'display' => 'Gestational age US composite estimate',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B6.DE20',
                    'display' => 'Ultrasound',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float)$parameter['value'] ?? 0.0,
                'unit' => 'wk',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'wk'
            ]
            ];
    }
}