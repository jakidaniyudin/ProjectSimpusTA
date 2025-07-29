<?php 

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyLeher implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $interpretation =[];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Leher', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Leher', 400);
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
                        'code' =>  '11411-6',
                        'display' => 'Physical findings of Neck Narrative',
                    ],
                    [
                        'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                        'code' => 'ANC.SS.DE28',
                        'display' => 'Pemeriksaan Fisik Leher',
                    ]
                ],
            'status' => 'final',
            'interpretation' => $interpretation
        ];
    }

}