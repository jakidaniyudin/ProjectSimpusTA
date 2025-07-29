<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class WaktuInisiasiMenyusuiDiniTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $valueCode = $parameter['valueCode'] ?? null;

        $displayMapping = [
            'OV000014' => 'Kurang dari 1 Jam',
            'OV000015' => 'Lebih dari 1 Jam'
        ];

        return [
            'waktuInisiasiMenyusuiDiniObservation' => [
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey'
                ],
                'code' => [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                    'code' => 'OC000016',
                    'display' => 'Waktu Inisiasi Menyusui Dini'
                ],
                'valueCodeableConcept' => [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                    'code' => $valueCode,
                    'display' => $displayMapping[$valueCode] ?? null
                ]
            ]
        ];
    }
}
