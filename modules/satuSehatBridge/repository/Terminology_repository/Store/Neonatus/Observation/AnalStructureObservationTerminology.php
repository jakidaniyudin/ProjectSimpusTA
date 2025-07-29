<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class AnalStructureObservationTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = $parameter['value'] ?? null; // valueString
        $status = $parameter['status'] ?? null;
        $interpretationCode = $parameter['interpretation'] ?? null;

        $interpretationDisplay = null;
        if ($interpretationCode === 'N') {
            $interpretationDisplay = 'Normal';
        } elseif ($interpretationCode === 'A') {
            $interpretationDisplay = 'Abnormal';
        }

        return [
            'analObservation' => [
                'resourceType' => 'Observation',
                'status' => $status,
                'category' => [
                        [
                            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                            'code' => 'exam',
                            'display' => 'Exam'
                        ]
                    ]
                ],
                'code' => [
                        [
                            'system' => 'http://loinc.org',
                            'code' => '11388-6',
                            'display' => 'Physical findings of Buttocks Narrative'
                        ]
                ],
                'bodySite' => [
                        [
                            'system' => 'http://snomed.info/sct',
                            'code' => '53505006',
                            'display' => 'Anal structure (body structure)'
                        ]
                ],
                'valueString' => $value,
                'interpretation' => isset($interpretationCode) ? [
                        [
                            'system' => 'http://terminology.hl7.org/CodeSystem/v3-ObservationInterpretation',
                            'code' => $interpretationCode,
                            'display' => $interpretationDisplay
                        ]
                ] : null
            ]
        ];
    }
}
