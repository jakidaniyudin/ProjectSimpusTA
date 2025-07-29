<?php
require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyGigidanMulut implements InterfaceTerminologyByStore
{
    
    public function getTerminology($parameter): array{
        $interpretation =[];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Gigi dan Mulut', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Gigi dan Mulut', 400);
        }
        if($parameter['value'] ===  'Normal'){
            $interpretation = [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ObservationInterpretation",
                "code" => "N",
                "display" =>  "Normal"
            ];
        } else {
            $interpretation = [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ObservationInterpretation",
                "code" => "A",
                "display" =>  "Abnormal"
            ];
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
                        'code' =>  '423066003',
                        'display' => 'Finding of mouth region',
                    ],
                    [
                        'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                        'code' => 'ANC.SS.DE29',
                        'display' => 'Pemeriksaan Fisik Area Mulut',
                    ]
                ],
            'status' => 'final',
            'interpretation' => $interpretation
        ];
    }

}