<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologySistolik implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Sistolik', 400);
        }elseif(!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa numeric pada Sistolik', 400);
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
                    'code' =>  '8480-6',
                    'display' => 'Systolic blood pressure',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B8.DE17',
                    'display' => 'Systolic blood pressure',
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