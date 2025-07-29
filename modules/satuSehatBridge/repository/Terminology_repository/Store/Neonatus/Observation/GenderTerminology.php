<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class GenderTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $genderCode = $parameter['gender'] ?? null;

        $genderDisplayMapping = [
            'male' => 'Male',
            'female' => 'Female',
            'other' => 'Other',
            'unknown' => 'Unknown'
        ];

        return [
            'gender' => [
                'system' => 'http://hl7.org/fhir/administrative-gender',
                'code' => $genderCode,
                'display' => $genderDisplayMapping[$genderCode] ?? null
            ]
        ];
    }
}
