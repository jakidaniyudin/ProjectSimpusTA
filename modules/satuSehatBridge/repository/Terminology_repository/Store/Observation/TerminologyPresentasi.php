<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyPresentasi implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $valueCodeableConcept = [];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Presentasi', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Presentasi', 400);
        }
        if(strtoupper($parameter['value']) === 'PRESENTASI KEPALA'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '1209182005',
                'display' => 'Cephalic fetal presentation'
            ];
        }else if (strtoupper($parameter['value']) === 'PRESENTASI BOKONG'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '6096002',
                'display' => 'Breech presentation'
            ];
        }else if (strtoupper($parameter['value']) === 'LETAK LINTANG'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '288203005',
                'display' => 'Transverse/oblique lie'
            ];
        }else {
            throw new ServiceException ('pilihan yang diimputkan tidak ada pada Presentasi', 400);
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
                    'code' =>  '72155-5',
                    'display' => 'Position in womb Fetus [RHEA]',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B8.DE111',
                    'display' => 'Fetal presentation',
                ]
                ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}