<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyMerokok implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, pada Merokok', 400);
        } elseif (!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada Merokok', 400);
        }

        $valueCodeableConcept = [];
        if(strtoupper($parameter['value']) === 'AKTIF'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '77176002',
                'display' => 'Smoker'
            ];
        }else if (strtoupper($parameter['value']) === 'PASIF'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '43381005',
                'display' => 'Passive smoker'
            ];
        }else if (strtoupper($parameter['value']) === 'TIDAK MEROKOK'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '8392000',
                'display' => 'Non-smoker'
            ];
        }else {
            throw new ServiceException ('pilihan yang diimputkan tidak ada pada Merokok', 400);
        }


        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'social-history',
                'display' => 'Social History',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' =>  '72166-2',
                    'display' => 'Tobacco smoking status',
                ]
            ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}