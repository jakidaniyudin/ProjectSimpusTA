<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


require_once APPPATH . 'modules/satuSehatBridge/service/serviceBuilder.php';
require_once APPPATH . 'modules/satuSehatBridge/service/serviceTerminologyLink.php';
require_once APPPATH . 'modules/satuSehatBridge/service/serviceTerminologyStore.php';
//


class servicePackageLogicFhirResource
{

    protected $ci;
    protected $packet;
    protected $terminologyLink;
    protected $terminologyStore;
    private $mainPayload;
    public function __construct()
    {
        $this->ci  = &get_instance();
        $this->packet =  new serviceBuilder();
        $this->terminologyLink =  new serviceTerminologyLink();
        $this->terminologyStore =  new serviceTerminologyStore();
    }

    public function observation($ecounterId, $observationId, $code)
    {
        $code = ['code' => '8867-4', 'display' => 'Heart rate', 'system' => 'http://loinc.org'];
        $status = 'final';
        $patient = '10000003006';
        $ecounter = 'urn:uuid:' . $ecounterId;
        $withIntegerValue = 72;
        $dateTime = '2023-08-31T14:30:00+00:00';
        $category = ['code' => 'laboratory', 'display' => 'Laboratory'];
        $issuedTime = '2023-08-31T14:30:00+00:00';
        $performer = ['Practitioner/N10000001', 'Practitioner/N10000002'];
        $payload =  $this->packet->createPayloadObservation($observationId, $code, $status, $patient, $ecounter, $withIntegerValue, $dateTime, $issuedTime, $performer, $category);
        return $payload;
    }

    public function Ecounter($uuid, $conditionId, $baseUrl, $location_name, $accesToken)
    {
        $patientId = '100000030009';
        $episodeId =  $this->terminologyLink->getTerminologyEpisodeOfCare($baseUrl, $patientId, $accesToken);
        $patient = [
            'id' => '100000030009',
            'name' => 'Budi Santoso',
            'orgId' => '665ed4bb-62dc-4fc8-bcb1-8f9c440102fb',
            'episodeId' => $episodeId['uuid']
        ];

        $statusFinish = 'finished';
        $classDisplay = $this->terminologyStore->setClassEcounter('AMB');

        $indetifier = [
            [
                "system" => "http://sys-ids.kemkes.go.id/encounter/665ed4bb-62dc-4fc8-bcb1-8f9c440102fb",
                "value" => "P20240001"
            ]
        ];
        $period = [
            'start' => '2023-08-31T14:30:00+00:00',
            'end' => '2023-09-20T15:30:00+00:00'
        ];
        $participant = [
            [
                'id' => '10014058550',
                'name' => 'Sheila Annisa S.Kep',
                'type' => $this->terminologyStore->setEcounterParticipant('ATND')
            ]

        ];

        $locationTerminology = $this->terminologyLink->getTerminologyLocation($baseUrl, $location_name, $accesToken);
        $location = [
            [
                'id' => 'Location/' . $locationTerminology['uuid'],
                'display' => $locationTerminology['display']
            ]
        ];

        $indetifier = [
            [
                "system" => "http://sys-ids.kemkes.go.id/encounter/665ed4bb-62dc-4fc8-bcb1-8f9c440102fb",
                "value" => "P20240001"
            ]
        ];
        $condition = [
            'id' => 'urn:uuid:' . $conditionId,
            'display' => 'Tuberculosis of lung, confirmed by sputum microscopy with or without culture',
            'rank' =>  1,
        ];
        $role = $this->terminologyStore->setEcounterDiagnosisUse('DD');

        $status = 'arrived';
        $start = '2023-08-31T14:00:00+00:00';
        $end = '2023-08-31T14:30:00+00:00';
        $hospitalization = $this->terminologyStore->setEcounterDischargePosition('home');
        $payload =  $this->packet->createPayloadEcounter($uuid, $indetifier, $patient, $statusFinish, $classDisplay, $period, $participant, $location, $condition, $role, $status, $start, $end, $hospitalization);
        return $payload;
    }


    public function condition($uuid, $ecounterCondition)
    {
        $code = [
            "code" => "E44.1",
            "display" =>  "Mild protein-calorie malnutrition",
            "system" => "http://hl7.org/fhir/sid/icd-10"
        ];
        $ecounter = [
            "display" => "Kunjungan Jane Smith di hari Selasa, 14 Juni 2023",
            "reference" => 'urn:uuid:' . $ecounterCondition
        ];
        $category = [
            "code" => "encounter-diagnosis",
            "display" => "Encounter Diagnosis",
            "system" => "http://terminology.hl7.org/CodeSystem/condition-category"
        ];

        $patient = [
            "display" => "Budi Santoso",
            "reference" => "Patient/100000030009"
        ];

        $clinicStatus = [
            "code" => "active",
            "display" => "Active",
            "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical"
        ];
        $additionalCode = [
            "code" => "E44.1",
            "display" =>  "Mild protein-calorie malnutrition",
            "system" => "http://hl7.org/fhir/sid/icd-10"
        ];
        $meta  = [
            "lastUpdated" => "2022-11-30T08:17:52.530758+00:00",
            "versionId" => "MTY2OTc5NjI3MjUzMDc1ODAwMA"
        ];

        $onsetDateTime = '2023-06-14T00:00:00+00:00';
        $recordDateTime = '2023-06-14T00:00:00+00:00';

        $payload =  $this->packet->createPayloadCondition($uuid, $code, $ecounter, $category, $patient, $clinicStatus, $additionalCode, $meta, $onsetDateTime, $recordDateTime);
        return $payload;
    }

    public function procedure($uuid, $ecounterId)
    {
        $code = [
            "system" => "http://hl7.org/fhir/sid/icd-9-cm",
            "code" =>  "88.78",
            "display" => "Diagnostic ultrasound of gravid uterus"
        ];
        $withStatus = 'completed';
        $patient = [
            "patientId" => "100000030006",
            "display" => "Budi Santoso"
        ];
        $ecounter = 'urn:uuid:2ba985a6-dccc-499b-a4ff-22d9564c9dbb';
        $performer = [
            "performerId" => "N10000001",
            "display" => "Dokter Bronsig"
        ];

        $performedPeriode = [
            "start" => "2023-06-14T12:31:00+00:00",
            "end" => "2023-06-14T13:27:00+00:00"
        ];
        $payload =  $this->packet->createPayloadProcedure($uuid, $code, $withStatus,  $patient, $ecounter, $performer, $performedPeriode);
        return $payload;
    }

    public function imunization()
    {
        $vacinned = [
            [
                "system" => "http://sys-ids.kemkes.go.id/kfa",
                "code" =>  "93006992",
                "display" =>  "Vaksin Tetanus Toxoid 10 Lf 0.5 mL (BIO FARMA)"
            ],
            [
                "system" =>  "http://sys-ids.kemkes.go.id/kfa",
                "code" => "VG139",
                "display" => "Td"
            ],
            [
                "system" =>  "http://hl7.org/fhir/sid/cvx",
                "code" =>  "35",
                "display" => "tetanus toxoid, adsorbed"
            ]
        ];

        $status = 'completed';
        $patient = [
            "reference" =>  "Patient/100000030006",
            "display" => "Jane Smith"
        ];

        $ecounter = 'Encounter/{{Encounter_uuid}}';
        $performer = [
            "system" =>  "http://terminology.hl7.org/CodeSystem/v2-0443",
            "code" =>  "AP",
            "display" => "Administering Provider",
            "actor" => "Practitioner/N10000001"
        ];

        $reason = [
            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
            "code" => "IM-WUS",
            "display" => "Imunisasi Program Rutin Lanjutan Wanita Usia Subur"
        ];
        $occurTime = '2023-08-31T01:14:00+00:00';
        $recorded = '2023-08-31T01:14:00+00:00';
        $booleanPrimarySource = 'true';
        $dosis = 2;
        $lotNumber = 'AB0092';
        $expired = '2025-11-19';
        $payload =  $this->packet->createPayloadImunization($vacinned, $booleanPrimarySource, $status, $patient, $ecounter, $performer, $reason, $dosis, $lotNumber, $occurTime, $recorded, $expired);
        $payload =  $this->mainPayloadCreate($payload);
        return  $payload;
    }
    public function episodeOfCare($uuid)
    {
        $identifier = [
            [
                "system" => "http://sys-ids.kemkes.go.id/episodeofcare/665ed4bb-62dc-4fc8-bcb1-8f9c440102fb",
                "value" => "EPISODE123456"
            ]
        ];
        $status = 'active';
        $type = [
            [
                "system" => "http://terminology.hl7.org/CodeSystem/episodeofcare-type",
                "code" => "hacc",
                "display" => "Home and Community Care"
            ]
        ];
        $patient = [
            "reference" => "Patient/100000030009",
            "display" => "Budi Santoso"
        ];
        $managingOrganization = [
            "reference" => "Organization/665ed4bb-62dc-4fc8-bcb1-8f9c440102fb",
            "display" => "RS Permata Ibu"
        ];
        $period = [
            "start" => "2023-06-14T00:00:00+00:00",
            "end" => "2023-12-31T00:00:00+00:00"
        ];
        $careManager = [
            "reference" => "Practitioner/N10000001",
            "display" => "Dr. Andi Wijaya"
        ];
        $payload = $this->packet->createPayloadEpisodeOfCare($uuid, $identifier, $status, $type, $patient, $managingOrganization, $period, $careManager);
        return $payload;
    }


    public function questionarry($uuid, $ecounterId)
    {
        $status = 'completed';
        $subject = [
            "patientId" => "100000030009",
            "name" => "Budi Santoso"
        ];
        $type = 'bertingkat';

        $encounter = [
            "reference" => "urn:uuid:" . $ecounterId
        ];

        $authored = "2023-06-14T14:30:00+00:00";

        $practitionerId = "N10000001";


        $questionnaire = [
            'reference' => 'https://fhir.kemkes.go.id/Questionnaire/Q0002'
        ];
        $startItem = [
            'linkId' => '2',
            'text' => 'pemantauan & pendampingan',
        ];

        $items = [
            [
                "linkId" => "2.1",
                "text" => "Apakah ibu mengalami mual?",
                "answer" => [
                    [
                        "valueBoolean" => true
                    ]
                ]
            ],
            [
                "linkId" => "2.2",
                "text" => "Berat badan ibu (kg)",
                "answer" => [
                    [
                        "valueDecimal" => 54.3
                    ]
                ]
            ],
            [
                "linkId" => "2.3",
                "text" => "Tekanan darah ibu",
                "answer" => [
                    [
                        "valueString" => "120/80"
                    ]
                ]
            ]
        ];

        $payload = $this->packet->createPayloadQuestionnaireResponse(
            $uuid,
            $encounter,
            $status,
            $subject,
            $questionnaire,
            $authored,
            $practitionerId,
            $startItem,
            $items,
            $type
        );

        return $payload;
    }
}