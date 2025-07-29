<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyPenolongPersalinan implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $display = strtoupper(trim($parameter['display'] ?? ''));

        $valueCodeableConcept = [];

        if ($display === 'KELUARGA') {
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code' => '303071001',
                'display' => 'Person in the family',
            ];
        } elseif ($display === 'DUKUN') {
            $valueCodeableConcept = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => 'OV000012',
                'display' => 'Dukun',
            ];
        } elseif ($display === 'BIDAN') {
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code' => '309453006',
                'display' => 'Registered midwife',
            ];
        } elseif ($display === 'DOKTER') {
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code' => '309343006',
                'display' => 'Physician Occupation',
            ];
        } elseif ($display === 'OBSTETRI') {
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code' => '11935004',
                'display' => 'Obstetrician Occupation',
            ];
        } else {
            return [
                'status' => false
            ];
        }

        return [
            'category' => [
                'system'  => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code'    => 'survey',
                'display' => 'Survey',
            ],
            'code' => [
                [
                    'system'  => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                    'code'    => 'OC000013',
                    'display' => 'Penolong Persalinan',
                ]
            ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}
