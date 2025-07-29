<?php

require_once APPPATH . 'modules/satuSehatBridge/service/SetUp/serviceSetupPNC.php';

class servicePackingINC {
    protected $setUpPayload;

    public function __construct(){
        $this->setUpPayload =  new serviceSetupPNC();
    }

    public function packingEcounter($uuidEcounter, $Condition, $location, $pasienId, $pasienName, $orgId, $episodeOfCare = null)
    {
        // menyimpan array
        $payloadEcounter = $this->setUpPayload->setEcounter($uuidEcounter, $Condition, $location, $pasienId, $pasienName, $orgId, $episodeOfCare );
        return [
            $payloadEcounter
        ];
    }

    public function packingEpisodeOfCare ($patientId, $patienName, $orgId) {
        $payloadEpisodeOfCare =  $this->setUpPayload->setEpisodeOfCare($patientId, $patienName, $orgId);
        return[
            $payloadEpisodeOfCare
        ];
    }

    public function packingConditionDiagnosaMedis($payloadDiagnosaMedis, $uuidEcounter, $patientId, $patienName)
    {
        $results = [];
        foreach ($payloadDiagnosaMedis as $diagnosa) {
            $kodeDiagnosa = $diagnosa['value'] ?? null;
            $namaDiagnosa = $diagnosa['display'] ?? null;

            if ($kodeDiagnosa && $namaDiagnosa) {
                $result = $this->setUpPayload->setConditionComplication(
                    null,
                    $uuidEcounter,
                    $patientId,
                    $patienName,
                    $kodeDiagnosa,
                    $namaDiagnosa
                );
                $results[]=$result;
            }
        }
        return $results;
    }

}