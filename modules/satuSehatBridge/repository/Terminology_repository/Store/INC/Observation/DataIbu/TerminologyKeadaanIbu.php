<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyKeadaanIbu implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $valueCodeableConcept = [];

        // Konversi ke huruf besar agar konsisten
        $display = strtoupper(trim($parameter['display'] ?? ''));

        if ($display === 'SEHAT') {
            $valueCodeableConcept = [
                'system'  => 'http://snomed.info/sct',
                'code'    => '102514002',
                'display' => 'Well female adult',
            ];
        } elseif ($display === 'SAKIT') {
            $valueCodeableConcept = [
                'system'  => 'http://snomed.info/sct',
                'code'    => '39104002',
                'display' => 'Illness',
            ];
        } elseif ($display === 'PERDARAHAN PASCA PERSALINAN') {
            $valueCodeableConcept = [
                'system'  => 'http://snomed.info/sct',
                'code'    => '47821001',
                'display' => 'Postpartum hemorrhage',
            ];
        } elseif ($display === 'DEMAM') {
            $valueCodeableConcept = [
                'system'  => 'http://snomed.info/sct',
                'code'    => '386661006',
                'display' => 'Fever',
            ];
        } elseif ($display === 'KEJANG') {
            $valueCodeableConcept = [
                'system'  => 'http://snomed.info/sct',
                'code'    => '91175000',
                'display' => 'Seizure',
            ];
        } elseif ($display === 'BAU LOKIA') {
            $valueCodeableConcept = [
                'system'  => 'http://snomed.info/sct',
                'code'    => '249215002',
                'display' => 'Odor of lochia',
            ];
        } elseif ($display === 'LAINNYA') {
            $valueCodeableConcept = [
                'system'  => 'http://snomed.info/sct',
                'code'    => '74964007',
                'display' => 'Other',
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
                    'system'  => 'http://snomed.info/sct',
                    'code'    => '249197004',
                    'display' => 'Postpartum condition of mother',
                ]
            ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}
