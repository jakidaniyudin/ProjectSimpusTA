<?php

require_once APPPATH . 'modules/satuSehatBridge/service/SetUp/serviceSetupINC.php';

class servicePackingINC {
    protected $setUpPayload;

    public function __construct(){
        $this->setUpPayload =  new serviceSetupINC();
    }

    public function packingEcounter($uuidEcounter, $Condition, $location, $pasienId, $pasienName, $orgId, $episodeOfCare = null)
    {
        // menyimpan array
        $payloadEcounter = $this->setUpPayload->setEcounter($uuidEcounter, $Condition, $location, $pasienId, $pasienName, $orgId );
        return [
            $payloadEcounter
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