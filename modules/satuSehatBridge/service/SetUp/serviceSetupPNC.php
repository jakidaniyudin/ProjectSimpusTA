<?php

require_once APPPATH . 'modules/satuSehatBridge/service/servicePackageLogicFhirResource.php';
require_once APPPATH . 'modules/satuSehatBridge/service/serviceBuilder.php';
require_once APPPATH . 'modules/satuSehatBridge/service/serviceTerminologyLink.php';
require_once APPPATH . 'modules/satuSehatBridge/service/serviceTerminologyStore.php';
class serviceSetupPNC
{
    protected $payloadService;
    protected $CI;
    protected $packet;
    protected $setUpPayload;
    protected $terminologyLink;
    protected $terminologyStore;

    public function __construct()
    {
        $this->packet = new serviceBuilder();
        $this->CI = &get_instance();
        $this->payloadService = new servicePackageLogicFhirResource();
        $this->terminologyLink =  new serviceTerminologyLink();
        $this->terminologyStore =  new serviceTerminologyStore();
    }

     protected function generateEncounterIdentifier($id_pasien) {
        date_default_timezone_set('Asia/Jakarta'); // sesuaikan timezone
        $timestamp = date('YmdHis'); // format: TahunBulanTanggalJamMenitDetik
        return $id_pasien . '-' . $timestamp;
    }


     public function setEcounter($uuid, array $condition, $location, $pasienId, $pasienName, $orgId, $episodeOfCareId)
    {

        $episodeId = $episodeOfCareId;
        $terminologySetup =  ($this->terminologyStore->getTerminology('ecounter_pnc'))->getTerminology($parameter = null);
        $patient = [
            'id' => $pasienId,
            'name' => $pasienName,
            'orgId' => $orgId,
            'episodeId' => $episodeId
        ];
        $statusFinish = $terminologySetup['statusFinish'];
        $classDisplay =  $terminologySetup['class'];
        $indetifier = [
            [
                "system" => "http://sys-ids.kemkes.go.id/encounter/" . $orgId,
                "value" => $this->generateEncounterIdentifier($pasienId)
            ]
        ];
        $period = [
            'start' => (new DateTime())->format('c'),
            'end' => (new DateTime())->format('c')
        ];
        $participant = [
            [
                'id' => '10014058550',
                'name' => 'Sheila Annisa S.Kep',
                'type' => $terminologySetup['type']
            ]
        ];
        $location = [
            [
                'id' => $location['uuid'],
                'display' => $location['display']
            ]
        ];
        $conditionValue = $condition;
        $role = $terminologySetup['code'];
        $history = $terminologySetup['history'];
        $hospitalization = $terminologySetup['hospitalization'];
        $payload =  $this->packet->createPayloadEcounter($uuid, $indetifier, $patient, $statusFinish, $classDisplay, $period, $participant, $location, $conditionValue, $role, $history, $hospitalization);
        return $payload;
    }
 public function setEpisodeOfCare ($patientId, $patienName, $orgId ){
        
        $uuid = $this->CI->uuid->v4();
        
        
        $identifier = [
            'system' => 'http://sys-ids.kemkes.go.id/episode-of-care/'.$orgId,
            'value' => $this->generateEncounterIdentifier($patientId)
        ];
        $status = 'active';
        $statusHistory = [   
            [
                'status' => 'active',
                'start' => (new DateTime())->format('c'),
                'end' => (new DateTime())->format('c') 
            ],
            [
                'status' => 'finished',
                'start' => (new DateTime())->format('c'),
                'end' => (new DateTime())->format('c')
            ]
           
        ];
        $type = [
            'system' =>'http://terminology.kemkes.go.id/CodeSystem/episodeofcare-type',
            'code' => "ANC",
            'display' => "Antenatal Care"
        ];
        $patient = [
            'pasienId' => $patientId,
            'pasienName' => $patienName
        ];
        $priodeStart = (new DateTime())->format('c');
        
        $payload = $this->packet->createPayloadEpisodeOfCare($uuid, $identifier, $status,$statusHistory, $type, $patient, $orgId, $priodeStart);
        return $payload;
    }

    public function setConditionComplication($key,string $ecounterCondition, string $pasien_id, string $pasien_name, string $codeKomplikasi, string $codeDisplay)
    {
        $uuid = $this->CI->uuid->v4();
        $terminologySetup =  ($this->terminologyStore->getTerminology('condition_pnc'))->getTerminology($parameter = null);
        $code = [
            "code" => $codeKomplikasi,
            "display" =>  $codeDisplay,
            "system" => 'http://hl7.org/fhir/sid/icd-10'
        ];
        $ecounter = [
            "reference" => 'urn:uuid:' . $ecounterCondition,
        ];
        $category = $terminologySetup['category'];
        $patient = [
            "display" => $pasien_name,
            "reference" => "Patient/" . $pasien_id
        ];
        $clinicStatus = $terminologySetup['clinicStatus'];
        $meta  = $terminologySetup['meta'];
        $onsetDateTime =  (new DateTime())->format('c');
        $recordDateTime =  (new DateTime())->format('c');
        $payload =  $this->packet->createPayloadCondition($uuid, $code, $ecounter, $category, $patient, $clinicStatus, $meta, $onsetDateTime, $recordDateTime);
        return $payload;
    }



 
}