<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyDiastolik implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, pada Diastolik', 400);
        } elseif (!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada Diastolik', 400);
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
                    'code' =>  '8462-4',
                    'display' => 'Diastolic blood pressure',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B8.DE19',
                    'display' => 'Diastolic blood pressure',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float) $parameter['value'] ?? 0.0,
                'unit' => 'mm[Hg]',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'mm[Hg]'
            ]
            ];
    }
}