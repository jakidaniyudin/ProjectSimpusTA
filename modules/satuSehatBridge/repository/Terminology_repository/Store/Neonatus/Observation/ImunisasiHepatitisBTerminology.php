<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class ImunisasiHepatitisBTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $status = $parameter['status'] ?? null;
        $lotNumber = ($status === 'completed') ? ($parameter['lotNumber'] ?? null) : null;

        return [
            'hepatitisBImmunization' => [
                'vaccineCode' => [
                    'system' => 'http://sys-ids.kemkes.go.id/kfa',
                    'code' => 'VG45',
                    'display' => 'HepB'
                ],
                'occurrenceDateTime' => $parameter['occurrenceDateTime'] ?? null,
                'status' => $status,
                'lotNumber' => $lotNumber
            ]
        ];
    }
}
