<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class KelasIbuBalitaTerminology implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'resourceType' => 'QuestionnaireResponse',
            'questionnaire' => 'https://fhir.kemkes.go.id/Questionnaire/Q0004',
            'status' => 'completed',
            'item' => [
                [
                    'linkId' => '1',
                    'text' => 'Apakah mengikuti kelas ibu balita',
                    'answer' => [
                        [
                            'valueBoolean' => filter_var($parameter['valueBoolean'] ?? false, FILTER_VALIDATE_BOOLEAN)
                        ]
                    ]
                ]
            ]
        ];
    }
}
