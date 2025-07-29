<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyConditionPNC implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
       return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/condition-category',
                'code' => 'encounter-diagnosis',
                'display' => 'Encounter Diagnosis'
            ],
            'code' => [
                'system' => 'http://hl7.org/fhir/sid/icd-10'
            ],
            'clinicStatus' => [
                "code" => "active",
                "display" => "Active",
                "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical"
            ],
            'meta' => [
                 "lastUpdated" => "2023-11-09T10:16:59.093957+00:00",
                 "versionId" => "MTY5OTUyNTAxOTA5Mzk1NzAwMA"
            ]
        ];
    }
}