<?php 

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyDada implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $interpretation =[];
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Dada', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Dada', 400);
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
                        'code' =>  '10200-4',
                        'display' => 'Physical findings of Heart Narrative',
                    ],
                    [
                        'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                        'code' => 'ANC.SS.DE31',
                        'display' => 'Pemeriksaan FisPemeriksaan Fisik Dada (Auskultasi Jantung)',
                    ]
                ],
            'status' => 'final',
            'interpretation' => $interpretation
        ];
    }

}