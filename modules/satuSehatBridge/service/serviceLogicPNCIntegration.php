<?php 

require_once APPPATH . 'modules/satuSehatBridge/service/Token/serviceTokenGenerate.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Main/serviceMainPayload.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Contract/serviceTerminologyLink.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Sender/serviceSenderIntegration.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Packing/servicePackingINC.php';
class ServiceLogicPNCIntegration  {
    protected $CI;
    protected $tokenService;
    protected $mainPayload;
    protected $senderService;
    protected $terminologyLink;
    protected $packingService;

    protected $SATUSEHAT_AUTH_STG = 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1';
    protected $SATUSEHAT_FHIR_STG = 'https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1';
    protected $orgid_prod = '665ed4bb-62dc-4fc8-bcb1-8f9c440102fb';
    protected $clientId = 'uEsVwq1Q72nypypRgwpAw3RZAhWsk5LVIMjvxTip8Y2kAGqq';
    protected $clientSecret = 'nADFUIufwpzAHduGo9nNFTRQm9ukgGvaDVNVHzpKaAkS4JftVC8f3Cv8lNLo2bJW';

    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->library('uuid');
        $this->tokenService = new serviceTokenGenerate();
        $this->mainPayload = new serviceMainPayload();
        $this->senderService = new serviceSenderIntegration();
        $this->terminologyLink = new serviceTerminologyLink();
        $this->packingService = new servicePackingINC();
    }

    public function sendPNC($input){
        $pasien = json_decode($input->post('pasien'), true);
        if (empty($pasien) || empty($pasien['NAMA_LGKP']) || empty($pasien['IHS_NUMBER'])) {
            throw new ServiceException('Data pasien tidak terdaftar di satu sehat', 400);
        }

        $pasienName = $pasien['NAMA_LGKP'];
        $pasienId = $pasien['IHS_NUMBER'];
        $diagnosaMedis = $input->post('diagnosaList');
        if (empty($diagnosaMedis)) {
            throw new ServiceException('tidak ada diagnosa Medis yang masuk', 400);
        }
        $token = $this->tokenService->generateToken($this->SATUSEHAT_AUTH_STG, $this->clientId, $this->clientSecret);
        if (!isset($token['access_token'])) {
            return $this->CI->response->send(400, 'Token tidak ditemukan');
        }
        $uuidEncounter = $this->CI->uuid->v4();
        $payloadDiagnosa = $this->packingService->packingConditionDiagnosaMedis($diagnosaMedis, $uuidEncounter, $pasienId, $pasienName);
        $conditions = $this->extractConditions($payloadDiagnosa);
        $location = $this->terminologyLink->getTerminologyLocation($this->SATUSEHAT_FHIR_STG, 'KIA', $token['access_token']);
        $payloadEncounter = $this->packingService->packingEcounter(
            $uuidEncounter,
            $conditions,
            $location,
            $pasienId,
            $pasienName,
            $this->orgid_prod,
            null
        );
            // Gabungkan semua
        $allPayloads = array_merge($payloadDiagnosa, $payloadEncounter);
        $finalPayload = $this->mainPayload->mainPayloadCreate($allPayloads);
        if (is_string($finalPayload) && json_decode($finalPayload) !== null) {
            $finalPayload = json_decode($finalPayload, true);
        }
        return $this->senderService->bundleANCSender($this->SATUSEHAT_FHIR_STG, $finalPayload, $token);
    }

    protected function extractConditions(array $entries): array
    {
        $conditions = [];
        $rank = 1;

        foreach ($entries as $entry) {
            $fullUrl = str_replace('urn\\:uuid:', 'urn:uuid:', $entry['fullUrl'] ?? '');
            $display = $entry['resource']['code']['coding'][0]['display'] ?? 'Unknown';
            $conditions[] = [
                'id' => $fullUrl,
                'display' => $display,
                'rank' => $rank++,
            ];
        }

        return $conditions;
    }

}