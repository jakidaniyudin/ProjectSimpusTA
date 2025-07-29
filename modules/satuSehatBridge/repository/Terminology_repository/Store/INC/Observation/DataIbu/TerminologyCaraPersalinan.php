<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyCaraPersalinan implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $display = strtoupper(trim($parameter['display'] ?? ''));

        $valueCodeableConcept = [];

        if ($display === 'NORMAL') {
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code' => '48782003',
                'display' => 'Delivery normal',
            ];
        } elseif ($display === 'VACUUM') {
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code' => '200138003',
                'display' => 'Vacuum extractor delivery - delivered',
            ];
        } elseif ($display === 'FORCEPS') {
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code' => '200130005',
                'display' => 'Forceps delivery - delivered',
            ];
        } elseif ($display === 'SECTIO' || $display === 'CAESAR' || $display === 'SESAR') {
            $valueCodeableConcept = [
                'system' => 'http://snomed.info/sct',
                'code' => '200144004',
                'display' => 'Deliveries by cesarean',
            ];
        } else {
            return [
                'status' => false
            ];
        }

        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'survey',
                'display' => 'Survey',
            ],
            'code' => [
                [
                    'system' => 'http://loinc.org',
                    'code' => '57071-3',
                    'display' => 'Obstetric delivery method',
                ]
            ],
            'status' => 'final',
            'withCodeableConcept' => $valueCodeableConcept
        ];
    }
}
