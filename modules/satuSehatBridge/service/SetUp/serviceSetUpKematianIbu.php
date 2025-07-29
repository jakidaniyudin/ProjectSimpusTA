<?php 
require_once APPPATH . 'modules/satuSehatBridge/service/Builder/serviceBuilder.php';
require_once APPPATH . 'modules/satuSehatBridge/factory/TerminolgyBaseFactoryByStore.php';

class serviceSetUpKematianIbu {
    protected $packet;
    protected $CI;
    protected $terminologyStore;

    public function __construct(){
        $this->packet = new serviceBuilder();
        $this->CI =  &get_instance();
        $this->terminologyStore =  new TerminolgyBaseFactoryByStore();
    }

    protected function generateEncounterIdentifier($id_pasien) {
        date_default_timezone_set('Asia/Jakarta'); // sesuaikan timezone
        $timestamp = date('YmdHis'); // format: TahunBulanTanggalJamMenitDetik
        return $id_pasien . '-' . $timestamp;
    }

    public function setEcounter($uuid, array $conditions, $location, $pasienId, $pasienName, $orgId) {
        $terminologySetup =  ($this->terminologyStore->getTerminology('ecounter_kematian'))->getTerminology($parameter = null);
        
        $patient = [
            'id' =>  $pasienId,
            'name' => $pasienName,
            'orgId' => $orgId,
        ];
        $statusFinish =  $terminologySetup['statusFinish'];
        $classDisplay =  $terminologySetup['class'];
        $indetifier = [
            [
                "system" => "http://sys-ids.kemkes.go.id/encounter/" . $orgId,
                "value" =>  $this->generateEncounterIdentifier($pasienId)
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
                'display' => $location['display'],
                'start' => (new DateTime())->format('c'),
                'end' =>  (new DateTime())->format('c'),
                'serviceClass' => [
                    'code' => 'reguler',
                    'display' => 'Kelas Reguler'
                ]

            ]
        ];

        $condition = $conditions;
        $role = $terminologySetup['code'];
        $history =  $terminologySetup['history'];
        $hospitalization = null;
        $payload =  $this->packet->createPayloadEcounterIMP($uuid, $indetifier, $patient, $statusFinish, $classDisplay, $period, $participant, $location, $condition, $role, $history, $hospitalization);
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
}