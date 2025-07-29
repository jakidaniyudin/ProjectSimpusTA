<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class LastLaboratoryObservationTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $value = $parameter['value'] ?? null; // decimal value, e.g. 15.5
        $status = $parameter['status'] ?? null;
        $interpretationCode = $parameter['interpretation'] ?? null;

        $interpretationDisplay = null;
        if ($interpretationCode === 'N') {
            $interpretationDisplay = 'Normal';
        } elseif ($interpretationCode === 'H') {
            $interpretationDisplay = 'High';
        }

        // Keterangan interpretation untuk visualisasi (bisa diolah di UI)
        $interpretationNote = null;
        if ($interpretationCode === 'N') {
            $interpretationNote = '< 20 m[IU]/L';  // TSH Normal
        } elseif ($interpretationCode === 'H') {
            $interpretationNote = '≥ 20 m[IU]/L'; // TSH Tinggi
        }

        return [
            'lastLabObservation' => [
                'resourceType' => 'Observation',
                'status' => $status,
                'category' => [
                    [
                        'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                        'code' => 'laboratory',
                        'display' => 'Laboratory'
                    ]
                ],
                'code' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' => '29575-8',
                        'display' => 'Thyrotropin [Units/volume] in DBS'
                    ]
                ],
                'valueQuantity' => [
                    [
                        'value' => $value,
                        'unit' => 'm[IU]/L',
                        'system' => 'http://unitsofmeasure.org',
                        'code' => 'm[IU]/L'
                    ]
                ],
                'interpretation' => isset($interpretationCode) ? [
                    [
                        'system' => 'http://terminology.hl7.org/CodeSystem/v3-ObservationInterpretation',
                        'code' => $interpretationCode,
                        'display' => $interpretationDisplay
                    ]
                ] : null,
                'interpretationNote' => $interpretationNote  // tambahan opsional buat visualisasi keterangan
            ]
        ];
    }
}
