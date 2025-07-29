<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class ShkProcedureTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $statusCode = $parameter['status'] ?? null; 

        return [
            'shkProcedure' => [
                'resourceType' => 'Procedure',
                'status' => $statusCode,
                'category' => [
                    [
                        'system' => 'http://snomed.info/sct',
                        'code' => '103693007',
                        'display' => 'Diagnostic procedure'
                    ]
                ],
                'code' => [
                    [
                        'system' => 'http://snomed.info/sct',
                        'code' => '400984005',
                        'display' => 'Congenital hypothyroidism screening test'
                    ]
                ]
            ]
        ];
    }
}
