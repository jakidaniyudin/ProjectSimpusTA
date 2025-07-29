<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyCondition implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
       return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/condition-category',
                'code' => 'encounter-diagnosis',
                'display' => 'Encounter Diagnosis'
            ],
            'code' => [
                'system' => 'http://snomed.info/sct'
            ],
            'clinicStatus' => [
                "code" => "active",
                "display" => "Active",
                "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical"
            ],
            'meta' => [
                 "lastUpdated" => "2022-11-30T08:17:52.530758+00:00",
                 "versionId" => "MTY2OTc5NjI3MjUzMDc1ODAwMA"
            ]
        ];
    }
}