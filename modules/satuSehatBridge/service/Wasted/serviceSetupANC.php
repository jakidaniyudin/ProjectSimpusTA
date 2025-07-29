<?php
require_once APPPATH . 'modules/satuSehatBridge/service/serviceBuilder.php';
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
                "value" => "P20240001"
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
                'type' => $terminologySetup['code']
            ]
        ];
        $location = [
            [
                'id' => 'Location/' . $location['uuid'],
                'display' => $location['display']
            ]
        ];
        $condition = $condition;
        $role = $terminologySetup['code'];
        $status = $terminologySetup['status'];
        $start = (new DateTime())->format('c');
        $end = (new DateTime())->format('c');
        $hospitalization = $terminologySetup['hospitalization'];
        $payload =  $this->packet->createPayloadEcounter($uuid, $indetifier, $patient, $statusFinish, $classDisplay, $period, $participant, $location, $condition, $role, $status, $start, $end, $hospitalization);
        return $payload;
    }

    public function setEpisodeOfCare ($patientId, $patienName, $orgId ){
        $uuid = $this->CI->uuid->v4();
        $identifier = [
            'system' => 'http://sys-ids.kemkes.go.id/episode-of-care/{{Org_id}}',
            'value' => 'EOC998803'
        ];
        $status = 'finished';
        $statusHistory = [   
            'status' => 'active',
            'start' => (new DateTime())->format('c'),
            'end' => (new DateTime())->format('c') 
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

    public function setConditionComplication(string $ecounterCondition, string $pasien_id, string $pasien_name, string $codeKomplikasi, string $codeDisplay)
    {
        $uuid = $this->CI->uuid->v4();
        $terminologySetup =  ($this->terminologyStore->getTerminology('condition'))->getTerminology($parameter = null);
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
    public function setGravida($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'survey',
            'display' => 'Survey',
        ];
        $code = [
            [
                'system' => 'http://loinc.org',
                'code' =>  '11996-6',
                'display' => '[#] Pregnancies',
            ],
            [
                'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                'code' => 'ANC.B6.DE24',
                'display' => 'Number of pregnancies (gravida)',
            ]
        ];
        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withIntegerValue = (int)  $value;
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservation($uuidObservation, $code, $status, $patient, $ecounter, $withIntegerValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

    public function setPartus($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'survey',
            'display' => 'Survey',
        ];
        $code = [
            [
                'system' => 'http://loinc.org',
                'code' =>  '11977-6',
                'display' => '[#] Parity',
            ],
            [
                'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                'code' => 'ANC.B6.DE32',
                'display' => 'Parity',
            ]
        ];

        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withIntegerValue = (int) $value;
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservation($uuidObservation, $code, $status, $patient, $ecounter, $withIntegerValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

    public function setAbortus($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'survey',
            'display' => 'Survey',
        ];
        $code = [
            [
                'system' => 'http://loinc.org',
                'code' =>  '69043-8',
                'display' => 'Other pregnancy outcomes #',
            ],
            [
                'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                'code' => 'ANC.B6.DE25',
                'display' => 'Number of miscarriages and/or abortions',
            ]
        ];

        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withIntegerValue =  (int) $value;
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservation($uuidObservation, $code, $status, $patient, $ecounter, $withIntegerValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

    public function setHPHT($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'survey',
            'display' => 'Survey',
        ];
        $code = [
            [
                'system' => 'http://loinc.org',
                'code' =>  '8665-2',
                'display' => 'Last menstrual period start date',
            ],
            [
                'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                'code' => 'ANC.B6.DE14',
                'display' => 'Last menstrual period (LMP) date',
            ]
        ];

        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withIntegerValue = $withIntegerValue = (new DateTime($value, new DateTimeZone('UTC')))->format('Y-m-d\TH:i:sP');
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationDateAndString($uuidObservation, $code, $status, $patient, $ecounter, $withIntegerValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

    public function setHPL($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'survey',
            'display' => 'Survey',
        ];
        $code = [
            [
                'system' => 'http://loinc.org',
                'code' =>  '11778-8',
                'display' => 'Delivery date Estimated',
            ],
            [
                'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                'code' => 'ANC.B6.DE22',
                'display' => 'Expected date of delivery (EDD)',
            ]
        ];

        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withIntegerValue = $value;
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationDateAndString($uuidObservation, $code, $status, $patient, $ecounter, $withIntegerValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

    public function setBBSebelumHamil($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'survey',
            'display' => 'Survey',
        ];
        $code = [
            [
                'system' => 'http://loinc.org',
                'code' =>  '56077-1',
                'display' => 'Body weight --pre current pregnancy',
            ],
            [
                'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                'code' => 'ANC.B8.DE2',
                'display' => 'Pre-gestational weight',
            ]
        ];

        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withQuantityValue = [
            'value' => (float) $value,
            'unit' => 'kg',
            'system' => 'http://unitsofmeasure.org',
            'code' => 'kg'
        ];
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationQuantty($uuidObservation, $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

    public function setTinggiBadan($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'vital-signs',
            'display' => 'Vital Signs',
        ];
        $code = [
            [
                'system' => 'http://loinc.org',
                'code' =>  '8302-2',
                'display' => 'Body height',
            ],
            [
                'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                'code' => 'ANC.B8.DE1',
                'display' => 'Height',
            ]
        ];

        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withQuantityValue = [
            'value' => (float) $value,
            'unit' => 'cm',
            'system' => 'http://unitsofmeasure.org',
            'code' => 'cm'
        ];
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationQuantty($uuidObservation, $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }
    public function setIMT($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'exam',
            'display' => 'Exam',
        ];
        $code = [
            [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' =>  'OC000010',
                'display' => 'Indeks Massa Tubuh Sebelum Hamil',
            ],
            [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                'code' => 'ANC.SS.DE58',
                'display' => 'IMT Sebelum Hamil',
            ]
        ];
        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withQuantityValue = [
            'value' => (float) $value,
            'unit' => 'kg/m2',
            'system' => 'http://unitsofmeasure.org',
            'code' => 'kg/m2'
        ];

        $interpretation = [
            "system" => "http://snomed.info/sct",
                "code" => "43664005",
                "display" =>  "Normal weight"
        ];
        $range = [
            [
                'high' => [
                    'value' => 18.4,
                    'unit' => 'kg/m2',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'kg/m2'
                ],
                'text' => 'Kurus'
            ],
            [
                'low' => [
                    'value' => 18.5,
                    'unit' => 'kg/m2',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'kg/m2'
                ],
                'high' => [
                    'value' => 24.9,
                    'unit' => 'kg/m2',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'kg/m2'
                ],
                'text' => 'Normal'
            ],
            [
                'low' => [
                    'value' => 25,
                    'unit' => 'kg/m2',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'kg/m2'
                ],
                'high' => [
                    'value' => 29.9,
                    'unit' => 'kg/m2',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'kg/m2'
                ],
                'text' => 'Gemuk'
            ],
            [
                'low' => [
                    'value' => 30,
                    'unit' => 'kg/m2',
                    'system' => 'http://unitsofmeasure.org',
                    'code' => 'kg/m2'
                ],
                'text' => 'Obesitas'
            ]
        ];

        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationRange($uuidObservation, $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, $performer, $category, $interpretation, $range);
        return $result;
    }
    public function setTNBB($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'exam',
            'display' => 'Exam',
        ];
        $code = [
            [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' =>  'OC000011',
                'display' => 'Target Kenaikan Berat Badan',
            ],
            [
                'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                'code' => 'ANC.B8.DE10',
                'display' => 'Expected weight gain',
            ]
        ];
        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        // ini masih perlu klasifikasi
        $codeableConcept = [
            'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
            'code' => "OV000009",
            'display' => $value
        ];

        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationCodeableConcept($uuidObservation, $code, $status, $patient, $ecounter, $dateTime, $issuedTime, $performer, $category, $codeableConcept);
        return $result;
    }

    public function setJKS($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'survey',
            'display' => 'Survey',
        ];
        $code = [
            [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' =>  'OC000001',
                'display' => 'Jarak kehamilan',
            ],
            [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                'code' => 'ANC.SS.DE53',
                'display' => 'Jarak kehamilan',
            ]
        ];
        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withQuantityValue = [
            'value' => (float) $value,
            'unit' => 'mo',
            'system' => 'http://unitsofmeasure.org',
            'code' => 'mo'
        ];
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationQuantty($uuidObservation, $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

    public function setUsiaKehamilan($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'survey',
            'display' => 'Survey',
        ];
        $code = [
            [
                'system' => 'http://loinc.org',
                'code' =>  '18185-9',
                'display' => 'Gestational age',
            ],
            [
                'system' => 'http://fhir.org/guides/who/anc-cds/CodeSystem/anc-custom-codes',
                'code' => 'ANC.B6.DE17',
                'display' => 'Gestational age',
            ]
        ];
        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withQuantityValue = [
            'value' => (float) $value,
            'unit' => 'mo',
            'system' => 'http://unitsofmeasure.org',
            'code' => 'mo'
        ];
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservationQuantty($uuidObservation, $code, $status, $patient, $ecounter, $withQuantityValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

    public function SetTrimesterke($value, $uuidEcounter, $pasien_id, $pasien_name)
    {
        $uuidObservation = $this->CI->uuid->v4();
        $category = [
            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
            'code' => 'survey',
            'display' => 'Survey',
        ];
        $code = [
            [
                'system' => 'http://loinc.org',
                'code' =>  '32418-6',
                'display' => 'Obstetric trimester Stated',
            ],
            [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                'code' => 'ANC.SS.DE13',
                'display' => 'Trimester ke',
            ]
        ];
        $status = 'final';
        $dateTime = (new DateTime())->format('c');
        $issuedTime =  (new DateTime())->format('c');
        $performer = ['Practitioner/N10000001'];
        $withIntegerValue =  (int) $value;
        $patient =  [
            'reference' => $pasien_id,
            'display' => $pasien_name
        ];
        $ecounter  = 'urn:uuid:' . $uuidEcounter;
        $result =  $this->packet->createPayloadObservation($uuidObservation, $code, $status, $patient, $ecounter, $withIntegerValue, $dateTime, $issuedTime, $performer, $category);
        return $result;
    }

}