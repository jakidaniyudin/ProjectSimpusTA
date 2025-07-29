<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyKepalaPAP implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $valueCodeableConcept = [];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Kepala PAP', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Kepala PAP', 400);
        }
        if(strtoupper($parameter['value']) === 'MASUK PANGGUL'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '249112006',
                'display' => 'Head engaged'
            ];
        }else if (strtoupper($parameter['value']) === 'BELUM MASUK PANGGUL'){
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code'  => '62098001',
                'display' => 'Head not engaged'
            ];
        }else {
            throw new ServiceException ('pilihan yang diimputkan tidak ada pada Kepala PAP', 400);
        }


        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'exam',
                'display' => 'Exam',
            ],
            'code' => [
                [
                    'system' => 'http://snomed.info/sct',
                    'code' =>  '249111004',
                    'display' => 'Engagement of head',
                ],
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.SS.DE46',
                    'display' => 'Kepala Terhadap PAP',
                ]
                ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}