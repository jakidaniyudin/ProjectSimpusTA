<?php 

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyTHT implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada THT', 400);
        }elseif(!is_string($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada THT', 400);
        }
        $interpretation =[];
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
                        'code' =>  '297268004',
                        'display' => 'Ear, nose and throat finding',
                    ],
                    [
                        'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                        'code' => 'ANC.SS.DE30',
                        'display' => 'Pemeriksaan Fisik Telinga Hidung dan Tenggorokan (THT)',
                    ]
                ],
            'status' => 'final',
            'interpretation' => $interpretation
        ];
    }

}