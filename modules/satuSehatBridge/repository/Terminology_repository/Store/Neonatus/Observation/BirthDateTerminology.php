<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class BirthDateTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'birthDate' => $parameter['birthDate'] ?? null
        ];
    }
}
