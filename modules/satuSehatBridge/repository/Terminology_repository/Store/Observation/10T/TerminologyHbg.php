<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyHbg implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, menggunakan nilai default 0.0. pada HBG', 400);
        } elseif (!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada HBG', 400);
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
                    'code' =>  '718-7',
                    'display' => 'Hemoglobin [Mass/volume] in Blood',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B9.DE175',
                    'display' => 'Blood hemoglobin test conducted',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float) $parameter['value'] ?? 0.0,
                'unit' => 'g/dL',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'g/dL'
            ]
            ];
    }
}