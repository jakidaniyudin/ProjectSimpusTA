<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class BirthPlaceExtension implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'birthPlaceExtension' => [
                'url' => 'http://hl7.org/fhir/StructureDefinition/birthPlace',
                'valueAddress' => [
                    'city' => $parameter['birthPlaceDisplay'] ?? null,
                    'extension' => [
                        [
                            'url' => 'http://terminology.kemendagri.go.id/CodeSystem/kode-wilayah',
                            'valueCode' => $parameter['birthPlaceCode'] ?? null
                        ]
                    ]
                ]
            ]
        ];
    }
}
