<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyProduksiASI implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        $code = $parameter['code'] ?? null;

        $mapping = [
            'OV000016' => 'Produksi ASI ada',
            'OV000017' => 'Produksi ASI ada tapi sedikit',
            'OV000018' => 'Produksi ASI tidak ada',
        ];

        $valueCodeableConcept = [];

        if ($code && isset($mapping[$code])) {
            $valueCodeableConcept = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => $code,
                'display' => $mapping[$code]
            ];
        }

        return [
            'category' => [
                [
                    'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                    'code' => 'survey',
                    'display' => 'Survey'
                ]
            ],
            'code' => [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => 'OC000017',
                'display' => 'Produksi ASI'
            ],
            'valueCodeableConcept' => $valueCodeableConcept
        ];
    }
}
