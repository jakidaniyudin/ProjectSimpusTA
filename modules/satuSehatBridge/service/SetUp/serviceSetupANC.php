<?php
require_once APPPATH . 'modules/satuSehatBridge/service/Builder/serviceBuilder.php';
require_once APPPATH . 'modules/satuSehatBridge/factory/TerminolgyBaseFactoryByStore.php';
class serviceSetupANC
{
    protected $CI;
    protected $packet;
    protected $terminologyStore;

    public function __construct()
    {
        $this->packet = new serviceBuilder();
        $this->CI = &get_instance();
        $this->terminologyStore =  new TerminolgyBaseFactoryByStore();
    }

    protected function generateEncounterIdentifier($id_pasien) {
        date_default_timezone_set('Asia/Jakarta'); // sesuaikan timezone
        $timestamp = date('YmdHis'); // format: TahunBulanTanggalJamMenitDetik
        return $id_pasien . '-' . $timestamp;
    }
    public function setEcounter($uuid, array $condition, $location, $pasienId, $pasienName, $orgId, $episodeOfCareId)
    {

        $episodeId = $episodeOfCareId;
        $terminologySetup =  ($this->terminologyStore->getTerminology('ecounter_anc'))->getTerminology($parameter = null);
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

    public function setConditionRiwayat(string $ecounterCondition, string $pasien_id, string $pasien_name, string $codeRiwayat, string $codeRiwayatDisplay)
    {
        $uuid = $this->CI->uuid->v4();
        $terminologySetup =  ($this->terminologyStore->getTerminology('condition'))->getTerminology($parameter = null);
        $code = [
            "code" => $codeRiwayat,
            "display" =>  $codeRiwayatDisplay,
            "system" => $terminologySetup['code']['system']
        ];
        $ecounter = [
            "reference" => 'urn:uuid:' . $ecounterCondition
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

    public function setConditionComplication($key,string $ecounterCondition, string $pasien_id, string $pasien_name, string $codeKomplikasi, string $codeDisplay)
    {
        $uuid = $this->CI->uuid->v4();
        $terminologySetup =  ($this->terminologyStore->getTerminology($key))->getTerminology($parameter = null);
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
    public function SetObservationValueInt($key,$value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $TerminologySetup = ($this->terminologyStore->getTerminology($key))->getTerminology($parameter = null);
        $category = $TerminologySetup['category'];

        $code = $TerminologySetup['code'];
        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/10014058550'];
        $withIntegerValue = (int)  $value;
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservation($uuidObservation, $code, $status, $patient, $ecounter, $withIntegerValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }


    public function setObservationDateTime($key, $value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $TerminologySetup = ($this->terminologyStore->getTerminology($key))->getTerminology($parameter = null);
        $category = $TerminologySetup['category'];
        $code = $TerminologySetup['code'];
        $status = $TerminologySetup['status'];
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/10014058550'];
        $withDateTime =  (new DateTime($value, new DateTimeZone('UTC')))->format('Y-m-d\TH:i:sP');
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationDateAndString($uuidObservation, $code, $status, $patient, $ecounter, $withDateTime, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

    // public function setHPL($value, $uuidEcounter, $pasien_id, $pasien_name)

    public function setObsetriQuantityValue($key, $value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        
        $uuidObservation = $this->CI->uuid->v4();
        $terminologySetup = ($this->terminologyStore->getTerminology($key))->getTerminology($parameter = ['value' =>  $value]);
       
        $category = $terminologySetup['category'];
        $code =$terminologySetup['code'];
        $status = $terminologySetup['status'];
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/10014058550'];
        $withQuantityValue = $terminologySetup['withQuantityValue'];
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationQuantty($uuidObservation, $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

    public function setObsetriQuantityValueAndInterpretation($key, $value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $terminologySetup = ($this->terminologyStore->getTerminology($key))->getTerminology($parameter = ['value' =>  $value]);
        $category = $terminologySetup['category'];
        $code =$terminologySetup['code'];
        $status = $terminologySetup['status'];
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/10014058550'];
        $withQuantityValue = $terminologySetup['withQuantityValue'];
        $interpretation = $terminologySetup['interpretation'];
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationQuantityAndIntrepretation($uuidObservation, $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, $performer, $category, $interpretation);
        return $result;
    }

    public function setObservasiInterpretation($key, $value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $terminologySetup = ($this->terminologyStore->getTerminology($key))->getTerminology($parameter = ['value' =>  $value]);
        $category = $terminologySetup['category'];
        $code =$terminologySetup['code'];
        $status = $terminologySetup['status'];
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/10014058550'];
        $interpretation = $terminologySetup['interpretation'];
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationIntrepretation($uuidObservation, $code, $status, $patient, $ecounter, $dateTime, $issuedTime, $performer, $category, $interpretation);
        return $result;
    }


    public function setObservasiInterpretationBodySheet ($key,$value, $uuidEcounter, $pasien_id, $pasien_name){
        $uuidObservation = $this->CI->uuid->v4();
        $terminologySetup = ($this->terminologyStore->getTerminology($key))->getTerminology($parameter = ['value' =>  $value]);
        $category = $terminologySetup['category'];
        $code =$terminologySetup['code'];
        $status = $terminologySetup['status'];
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/10014058550'];
        $interpretation = $terminologySetup['interpretation'];
        $bodyshit = $terminologySetup['bodySite'];
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationIntrepretationAndBodySheet($uuidObservation, $code, $status, $patient, $ecounter, $dateTime, $issuedTime, $performer, $category, $interpretation, $bodyshit);
        return $result;
    }

    public function setObservasiRange($key,$value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $terminologySetup = ($this->terminologyStore->getTerminology($key))->getTerminology($parameter = ['value' =>  $value]);
        $category = $terminologySetup['category'];
        $code = $terminologySetup['code'];
        $status = $terminologySetup['status'];
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/10014058550'];
        $withQuantityValue = $terminologySetup['withQuantityValue'];

        $interpretation = $terminologySetup['interpretation'];
        if($interpretation){
            throw new ServiceException('interpretation dari observasi Tidak ditemukan', 400);
        }
        $range = $terminologySetup['range'];
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationRange($uuidObservation, $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, $performer, $category, $interpretation, $range);
        return $result;
    }

    public function setObservationCodeLabel($key, $value, $uuidEcounter, $pasien_id, $pasien_name)
    {   
       
        $uuidObservation = $this->CI->uuid->v4();
        $terminologySetup = ($this->terminologyStore->getTerminology($key))->getTerminology($parameter = ['value' =>  $value]);
        $category = $terminologySetup['category'];
        $code = $terminologySetup['code'];
        $status = $terminologySetup['status'];
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/10014058550'];
        // ini masih perlu klasifikasi
        $codeableConcept = $terminologySetup['withCodeableConcept'];
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationCodeableConcept($uuidObservation, $code, $status, $patient, $ecounter, $dateTime, $issuedTime, $performer, $category, $codeableConcept);
        return $result;
    }

    

  

}