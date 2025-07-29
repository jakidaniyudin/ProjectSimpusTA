<?php 

require_once APPPATH . 'modules/satuSehatBridge/service/Token/serviceTokenGenerate.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Main/serviceMainPayload.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Contract/serviceTerminologyLink.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Sender/serviceSenderIntegration.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Packing/servicePackingKematianIbu.php';

class serviceLogicKematianIbuIntegration {
    protected $tokenService;
    protected $mainPayload;
    protected $senderService;
    protected $setUpPayload;
    protected $terminologyLink;
    protected $packingService;
    protected $SATUSEHAT_AUTH_STG = 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1';
    protected $SATUSEHAT_FHIR_STG = 'https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1';
    protected $orgid_prod = '665ed4bb-62dc-4fc8-bcb1-8f9c440102fb';
    protected $clientId = 'uEsVwq1Q72nypypRgwpAw3RZAhWsk5LVIMjvxTip8Y2kAGqq';
    protected $clientSecret = 'nADFUIufwpzAHduGo9nNFTRQm9ukgGvaDVNVHzpKaAkS4JftVC8f3Cv8lNLo2bJW';
    protected $CI;

    public function __construct () {
        $this->CI =  &get_instance();
        $this->CI->load->library('uuid');

        $this->tokenService =  new serviceTokenGenerate();
        $this->mainPayload =  new serviceMainPayload();
        $this->senderService =  new serviceSenderIntegration();
        $this->terminologyLink =  new serviceTerminologyLink();
        $this->packingService =  new servicePackingKematianIbu();
    }

    public function sendKematianReport($input) {
        $pasien = json_decode($input->post('pasien'), true);
        $pasienName = $pasien['NAMA_LGKP'];
        $pasienId = $pasien['IHS_NUMBER'];
        $diagnosaMedis = $input->post('diagnosaList');
        if (empty($pasien) || empty($pasien['NAMA_LGKP']) || empty($pasien['IHS_NUMBER'])) {
            throw new ServiceException('Data pasien tidak terdaftar di satu sehat', 400);
        }

        if (!empty($input->post('KematianIbu'))) {
            return $this->sendKematianIbu($pasienId, $pasienName, $diagnosaMedis);
        } else {
            throw new ServiceException('tidak ada data Laporan kematian ibu', 400);
        }
    }

    public function sendKematianIbu($pasienId, $pasienName, $diagnosaMedis) {
        $token = $this->getToken();
        $uuidEncounter = $this->CI->uuid->v4();
        $payloads = [];
        $payloadsCondition = [];

        // Diagnosa
        if (empty($diagnosaMedis)) {
            throw new ServiceException('tidak ada diagnosa Medis yang masuk', 400);
        }

        $diagnosaPayloads = $this->packingService->packingConditionDiagnosaMedis(
            $diagnosaMedis, 
            $uuidEncounter, 
            $pasienId, 
            $pasienName
        );

        $payloads = array_merge($payloads, $diagnosaPayloads);
        $payloadsCondition = array_merge($payloadsCondition, $diagnosaPayloads);

        // Encounter
        $extractedConditions = $this->extractConditions($payloadsCondition);
        $location = $this->terminologyLink->getTerminologyLocation(
            $this->SATUSEHAT_FHIR_STG, 
            'KIA', 
            $token['access_token']
        );

        $encounterPayload = $this->packingService->packingEcounter(
            $uuidEncounter,
            $extractedConditions,
            $location,
            $pasienId,
            $pasienName,
            $this->orgid_prod,
            null
        );

        $payloads = array_merge($payloads, $encounterPayload);

        // Merge & Send
        $finalPayload = $this->mainPayload->mainPayloadCreate($payloads);
        if (is_string($finalPayload) && json_decode($finalPayload) !== null) {
            $finalPayload = json_decode($finalPayload, true);
        }

        return $this->senderService->bundleANCSender($this->SATUSEHAT_FHIR_STG, $finalPayload, $token);
    }

    protected function getToken() {
        $token = $this->tokenService->generateToken($this->SATUSEHAT_AUTH_STG, $this->clientId, $this->clientSecret);
        if (!isset($token['access_token'])) {
            return $this->CI->response->send(400, 'Token tidak ditemukan');
        }
        return $token;
    }

    public function tesMergePayloads($payloads) {
        return $this->mainPayload->mainPayloadCreate($payloads);
    }

    protected function extractConditions(array $conditionsBundle): array {
        $result = [];
        foreach ($conditionsBundle as $entry) {
            $fullUrl = str_replace('urn\\:uuid:', 'urn:uuid:', $entry['fullUrl'] ?? '');
            $result[] = ['id' => $fullUrl];
        }
        return $result;
    }
}
