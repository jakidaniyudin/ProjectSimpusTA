<?php  

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyJumlahJanin implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array
    {
        return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'exam',
                'display' => 'Exam',
            ],
            'code' => [
                [
                    'system' => 'http://snomed.info/sct',
                    'code' =>  '246435002',
                    'display' => 'Number of fetuses',
                ],
                [
                    'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.B8.DE109',
                    'display' => 'Number of fetuses',
                ]
            ],
            'status' =>  'final'
    
        ];
    }
}