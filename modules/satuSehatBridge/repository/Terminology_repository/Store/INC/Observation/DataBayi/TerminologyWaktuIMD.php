<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyWaktuIMD implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'category' => [
                'system'  => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code'    => 'survey',
                'display' => 'Survey',
            ],
            'code' => [
                [
                    'system'  => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                    'code'    => 'OC000016',
                    'display' => 'Waktu Inisiasi Menyusui Dini',
                ]
            ],
            'valueCodeableConcept' => $this->mapValue($parameter)
        ];
    }

    private function mapValue($parameter): array
    {
        $parameter = strtolower(trim($parameter));
        if ($parameter === 'kurang dari 1 jam') {
            return [
                'coding' => [[
                    'system'  => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                    'code'    => 'OV000014',
                    'display' => 'Kurang dari 1 Jam',
                ]]
            ];
        } elseif ($parameter === 'lebih dari 1 jam') {
            return [
                'coding' => [[
                    'system'  => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                    'code'    => 'OV000015',
                    'display' => 'Lebih dari 1 Jam',
                ]]
            ];
        }
        return []; 
    }
}
