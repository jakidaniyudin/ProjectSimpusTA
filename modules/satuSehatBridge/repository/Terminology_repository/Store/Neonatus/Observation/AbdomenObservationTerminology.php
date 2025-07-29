<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class AbdomenObservationTerminology implements InterfaceTerminologyByStore
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
            'abdomenObservation' => [
                'resourceType' => 'Observation',
                'status' => $status,
                'category' => [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'exam',
                    'display' => 'Exam'
                ],
                'code' => [
                    'system' => 'http://loinc.org',
                    'code' => '10191-5',
                    'display' => 'Physical findings of Abdomen Narrative'
                ],
                'valueString' => $value,
                'interpretation' => isset($interpretationCode) ? [
                    'system' => 'http://terminology.hl7.org/CodeSystem/v3-ObservationInterpretation',
                    'code' => $interpretationCode,
                    'display' => $interpretationDisplay
                ] : null
            ]
        ];
    }
}
