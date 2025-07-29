<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class ResuscitationProcedureTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $status = $parameter['status'] ?? null;

        return [
            'resuscitationProcedure' => [
                'category' => [
                    'system' => 'http://snomed.info/sct',
                    'code' => '373110003',
                    'display' => 'Emergency procedure',
                ],
                'code' => [
                    'system' => 'http://snomed.info/sct',
                    'code' => '386412000',
                    'display' => 'Resuscitation of neonate',
                ],
                'status' => $status,
            ]
        ];
    }
}
