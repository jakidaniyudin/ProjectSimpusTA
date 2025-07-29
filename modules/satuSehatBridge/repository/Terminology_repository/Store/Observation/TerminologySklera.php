<?php 

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologySklera implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $interpretation =[];
        if (!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada, pada Sklera', 400);
        } elseif (!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" berupa angka. pada Sklera', 400);
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
                        'system' => 'http://loinc.org',
                        'code' =>  '10197-2',
                        'display' => 'Physical findings of Eye Narrative',
                    ],
                    [
                        'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                        'code' => 'ANC.SS.DE27',
                        'display' => 'Pemeriksaan Fisik Sklera',
                    ]
                ],
            'status' => 'final',
            'bodySite' => [
                "system" => "http://snomed.info/sct",
                "code" => "18619003",
                "display" => "Scleral structure"
            ],
            'interpretation' => $interpretation
        ];
    }
}