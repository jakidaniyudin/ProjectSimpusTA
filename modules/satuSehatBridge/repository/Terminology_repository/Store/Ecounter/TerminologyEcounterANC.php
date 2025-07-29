<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyEcounterANC implements InterfaceTerminologyByStore {
  
    public function getTerminology($parameter): array 
    {
        return [
            'statusFinish' => 'finished',
            'class' => [
                "system" =>  "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" =>  "AMB",
                "display" =>  "ambulatory"
            ],
            'type' => [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                "code" =>  "ATND",
                "display" => "attender"
            ],
            'code' => [
               "system" =>  "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                "code" =>  "DD",
                "display"=> "Discharge diagnosis"
            ],
            'hospitalization' => [
                "system"=> "http://terminology.hl7.org/CodeSystem/discharge-disposition",
                "code"=> "home",
                "display"=> "Home"
            ],
            'history' => [
                [
                    "status" =>"arrived",
                    "period"=> [
                        "start" =>  (new DateTime())->format('c'),
                        "end" =>  (new DateTime())->format('c')
                    ]
                ],
                [
                    "status" => "in-progress",
                    "period"=> [
                        "start"=>  (new DateTime())->format('c'),
                        "end"=>  (new DateTime())->format('c')
                    ]
                ],
                [
                    "status" => "finished",
                    "period" => [
                        "start" =>  (new DateTime())->format('c'),
                        "end" =>  (new DateTime())->format('c')
                    ]
                ]
            ]
        ];
    }

}