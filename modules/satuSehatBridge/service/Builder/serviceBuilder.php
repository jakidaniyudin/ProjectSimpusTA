<?php

class serviceBuilder
{
    protected $ci;
    protected $builder;



    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->library('uuid');
        (!class_exists('FHIRFactory') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/factory/FHIRFactory.php'));
    }

    private function basePayload($payload, $method, $url, string $uuid)
    {
        return  $fullPayload = [
            'fullUrl' => 'urn:uuid:' . $uuid,
            'resource' => $payload,
            'request' => [
                'method' => $method,
                'url' => $url
            ]
        ];
    }

    public function setBuilder($class)
    {
        return  $this->builder = $class;
    }

    public function createPayloadEcounter(string $uuid, array $indentifier, array $patient, $statusFinish, array $classDisplay, array $period, array $participant, array $location, array $condition, array $role, array $historys, $hospitalization = null)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder = $this->builder->createEncounterBuilder();
        $this->builder
            ->addIdentifier($indentifier)
            ->withStatus($statusFinish)
            ->withClass($classDisplay)
            ->forPatient($patient)
            ->addParticipant($participant)
            ->withPeriod($period['start'], $period['end'])
            ->addLocation($location);
        foreach ($condition as $conditionIndex) {
            $this->builder->addDiagnosis($conditionIndex, $role);
        }
        foreach ($historys as $history){
            $this->builder->addStatusHistory($history['status'], $history['period']['start'], $history['period']['end']);
        }   
        if($hospitalization){
            $this->builder->withHospitalization($hospitalization);
        }
         
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Encounter', $uuid);
        return $payload;
    }

    public function createPayloadEcounterIMP(string $uuid, array $indentifier, array $patient, $statusFinish, array $classDisplay, array $period, array $participant, array $location, array $condition, array $role, array $historys, $hospitalization): array
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder = $this->builder->createEncounterBuilder();
        $this->builder
            ->addIdentifier($indentifier)
            ->withStatus($statusFinish)
            ->withClass($classDisplay)
            ->forPatient($patient)
            ->addParticipant($participant)
            ->withPeriod($period['start'], $period['end'])
            ->addLocationExtension($location);
        foreach ($condition as $conditionIndex) {
            $this->builder->addDiagnosis($conditionIndex, $role);
        }
        foreach ($historys as $history){
            $this->builder->addStatusHistory($history['status'], $history['period']['start'], $history['period']['end']);
        }   
        
        if($hospitalization){
            $this->builder->withHospitalization($hospitalization);
        }else{
            $hospitalization = null;
        }
            
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Encounter', $uuid);
        return $payload;
    }

    public function createPayloadCondition(string $uuid, array $code, array $ecounter, array $category, array $patient, array $clinicalStatus, array $meta, string $onsetDateTime, string $recordDateTime)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createConditionBuilder();
        $this->builder
            ->withCode($code['code'], $code['display'], $code['system'])
            ->forEncounter($ecounter)
            ->addSubject($patient)
            ->withCategory($category['code'], $category['display'], $category['system'])
            ->withOnsetDateTime($onsetDateTime)
            ->recordDateTime($recordDateTime)
            ->withClinicalStatus($clinicalStatus['code'], $clinicalStatus['display'], $clinicalStatus['system']);
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Condition', $uuid);
        return $payload;
    }

    public function createPayloadProcedure(string $uuid, array $code, $withStatus, array $patient, $ecounter, array $addPerformer, array $date, array $reason = null)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createProcedureBuilder();
        $this->builder
            ->withCode($code['code'], $code['display'], $code['system'])
            ->withStatus($withStatus)
            ->forPatient($patient['patientId'], $patient['display'])
            ->forEncounter($ecounter)
            ->addPerformer($addPerformer['performerId'], $addPerformer['display'])
            ->withPerformedPriode($date['start'], $date['end']);
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Procedure', $uuid);
        return $payload;
    }

    public function createPayloadObservation(string $uuid, array $code, $status, $patient, $ecounter, $integerValue, $dateTime, $issuedTime, array $performer, array $category)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createObservationBuilder();
        $this->builder
            ->withStatus($status)
            ->withCategory($category['code'], $category['display'], $category['system'] ?? null)
            ->withCode($code)
            ->forPatient($patient['reference'], $patient['display'])
            ->forEncounter($ecounter)
            ->withEffectiveDateTime($dateTime)
            ->issuedTime($issuedTime)
            ->performer($performer)
            ->withIntegerValue($integerValue);
        //     // ->withQuantityValue($withQuantityValue['value'], $withQuantityValue['unit'], $withQuantityValue['system'], $withQuantityValue['code'])
        //     // ->withStringValue($string)  
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Observation', $uuid);
        return $payload;
    }

    public function createPayloadObservationQuantty(string $uuid, array $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, array $performer, array $category)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createObservationBuilder();
        $this->builder
            ->withStatus($status)
            ->withCategory($category['code'], $category['display'], $category['system'] ?? null)
            ->withCode($code)
            ->forPatient($patient['reference'], $patient['display'])
            ->forEncounter($ecounter)
            ->withEffectiveDateTime($dateTime)
            ->issuedTime($issuedTime)
            ->performer($performer)
            ->withQuantityValue($withQuantityValue);
        //     // ->withStringValue($string)  
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Observation', $uuid);
        
        return $payload;
    }

    public function createPayloadObservationDateAndString(string $uuid, array $code, $status, $patient, $ecounter, $ValueDateString, $dateTime, $issuedTime, array $performer, array $category)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createObservationBuilder();
        $this->builder
            ->withStatus($status)
            ->withCategory($category['code'], $category['display'], $category['system'] ?? null)
            ->withCode($code)
            ->forPatient($patient['reference'], $patient['display'])
            ->forEncounter($ecounter)
            ->withEffectiveDateTime($dateTime)
            ->issuedTime($issuedTime)
            ->performer($performer)
            ->withStringValue($ValueDateString);
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Observation', $uuid);
        return $payload;
    }

    public function createPayloadObservationRange(string $uuid, array $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, array $performer, array $category, array $interpretation, array $ranges)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createObservationBuilder();
        $this->builder
            ->withStatus($status)
            ->withCategory($category['code'], $category['display'], $category['system'] ?? null)
            ->withCode($code)
            ->forPatient($patient['reference'], $patient['display'])
            ->forEncounter($ecounter)
            ->withEffectiveDateTime($dateTime)
            ->issuedTime($issuedTime)
            ->performer($performer)
            ->withQuantityValue($withQuantityValue)
            ->withInterpretation($interpretation['code'], $interpretation['display'], $interpretation['system'])
            ->withReferenceRange($ranges);
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Observation', $uuid);
        return $payload;
    }

    public function createPayloadObservationQuantityAndIntrepretation(string $uuid, array $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, array $performer, array $category, array $interpretation)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createObservationBuilder();
        $this->builder
            ->withStatus($status)
            ->withCategory($category['code'], $category['display'], $category['system'] ?? null)
            ->withCode($code)
            ->forPatient($patient['reference'], $patient['display'])
            ->forEncounter($ecounter)
            ->withEffectiveDateTime($dateTime)
            ->issuedTime($issuedTime)
            ->performer($performer)
            ->withQuantityValue($withQuantityValue)
            ->withInterpretation($interpretation['code'], $interpretation['display'], $interpretation['system']);
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Observation', $uuid);
        return $payload;
    }

    
    public function createPayloadObservationIntrepretation(string $uuid, array $code, $status, $patient, $ecounter, $dateTime, $issuedTime, array $performer, array $category, array $interpretation)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createObservationBuilder();
        $this->builder
            ->withStatus($status)
            ->withCategory($category['code'], $category['display'], $category['system'] ?? null)
            ->withCode($code)
            ->forPatient($patient['reference'], $patient['display'])
            ->forEncounter($ecounter)
            ->withEffectiveDateTime($dateTime)
            ->issuedTime($issuedTime)
            ->performer($performer)
            ->withInterpretation($interpretation['code'], $interpretation['display'], $interpretation['system']);
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Observation', $uuid);
       
        return $payload;
    }


    public function createPayloadObservationIntrepretationAndBodySheet(string $uuid, array $code, $status, $patient, $ecounter, $dateTime, $issuedTime, array $performer, array $category, array $interpretation, array $bodySite)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createObservationBuilder();
        $this->builder
            ->withStatus($status)
            ->withCategory($category['code'], $category['display'], $category['system'] ?? null)
            ->withCode($code)
            ->withBodySite($bodySite['code'], $bodySite['display'], $bodySite['system'])
            ->forPatient($patient['reference'], $patient['display'])
            ->forEncounter($ecounter)
            ->withEffectiveDateTime($dateTime)
            ->issuedTime($issuedTime)
            ->performer($performer)
            ->withInterpretation($interpretation['code'], $interpretation['display'], $interpretation['system']);
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Observation', $uuid);
       
        return $payload;
    }

    public function createPayloadObservationCodeableConcept(string $uuid, array $code, $status, $patient, $ecounter, $dateTime, $issuedTime, array $performer, array $category, array $codeableConcept)
    {
        
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createObservationBuilder();
        $this->builder
            ->withStatus($status)
            ->withCategory($category['code'], $category['display'], $category['system'] ?? null)
            ->withCode($code)
            ->forPatient($patient['reference'], $patient['display'])
            ->forEncounter($ecounter)
            ->withEffectiveDateTime($dateTime)
            ->issuedTime($issuedTime)
            ->performer($performer)
            ->withCodeableConceptValue($codeableConcept['system'], $codeableConcept['code'], $codeableConcept['display']);
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Observation', $uuid);
        return $payload;
    }

    public function  createPayloadImunization(string $uuid, array $vacinned, string $boolean, string $status, array $patient, string $ecounter, array $performer, array $reason, int $dosis, string $lotNumber, string $occurTime, string $recorded,  string $expired)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder =  $this->builder->createImunizationBuilder();
        $this->builder
            ->vaccineCode($vacinned)
            ->addprimarySource($boolean)
            ->addStatus($status)
            ->addPatient($patient['reference'], $patient['display'])
            ->addEcounter($ecounter)
            ->addOccurenceDateTime($occurTime)
            ->addRecorded($recorded)
            ->addPerformer($performer)
            ->addReasonCode($reason['system'], $reason['code'], $reason['display'])
            ->addProtocolApplied($dosis)
            ->addLotNumber($lotNumber)
            ->addExprationDate($expired);
        $payload = $this->basePayload($this->builder->build(), 'POST', 'Imunization', $uuid);
        return $payload;
    }

    public function createPayloadEpisodeOfCare(string $uuid, array $identifier, string $status, array $statusHistorys, array $type, array $patient, string $orgId, string $periodStart)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder = $this->builder->createEpisodeOfCareBuilder(); // pastikan ada method ini di FHIRFactory

        $this->builder
            ->addIdentifier($identifier)
            ->withStatus($status);
        foreach($statusHistorys as $statusHistory){
            $this->builder->addStatusHistory($statusHistory['status'], $statusHistory['start'], $statusHistory['end']);
        }
            $this->builder->withType($type)
            ->forPatient($patient['pasienId'], $patient['pasienName'])
            ->byOrganization($orgId)
            ->withPeriod($periodStart);

        $payload = $this->basePayload($this->builder->build(), 'POST', 'EpisodeOfCare', $uuid);
        return $payload;
    }

    public function createPayloadQuestionnaireResponse(string $uuid, array $ecounter, string $status, array $subject, array $questionnaire, string $authored, string $practitionerId, array $startItem = null, array $item, string $type)
    {
        $this->setBuilder(new FHIRFactory());
        $this->builder = $this->builder->createPayloadQuestionnaireResponseBuilder();

        $this->builder
            ->setQuestionnaire($questionnaire['reference'])
            ->setStatus($status)
            ->setSubject($subject['patientId'], $subject['name'])
            ->setEncounter($ecounter['reference'])
            ->setAuthored($authored)
            ->setAuthor($practitionerId)
            ->setSource($subject['patientId']);
        if ($type = 'bertingkat') {
            $this->builder->startItem($startItem['linkId'], $startItem['text']);
            foreach ($item as $i) {
                $linkId = $i['linkId'];
                $text = $i['text'];
                $answer = $i['answer'];

                $this->builder->addItem($linkId, $text, $answer);
            }
        } else {
            $this->builder->addItem($item['linkId'], $item['text'], $item['$answer']);
        }

        $this->builder->commitItem();
        $payload = $this->basePayload($this->builder->build(), 'POST', 'QuestionnaireResponse', $uuid);
        return $payload;
    }
}