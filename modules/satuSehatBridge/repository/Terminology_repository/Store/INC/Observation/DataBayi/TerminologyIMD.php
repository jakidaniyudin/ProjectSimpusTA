<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyIMD implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'code' => [
                [
                    'system'  => 'http://snomed.info/sct',
                    'code'    => '440626008',
                    'display' => 'Procedure related to breastfeeding',
                ],
                [
                    'system'  => 'http://snomed.info/sct',
                    'code'    => '431868002',
                    'display' => 'Initiation of breastfeeding',
                ]
            ],
            'status' => $this->mapStatus($parameter)
        ];
    }

    private function mapStatus($parameter): string
    {
        $parameter = strtolower(trim($parameter));
        if ($parameter === 'ya') {
            return 'completed';
        } elseif ($parameter === 'tidak') {
            return 'not-done';
        }
        return 'unknown'; 
    }
}
