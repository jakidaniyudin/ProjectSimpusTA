<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'modules/satuSehatBridge/service/Token/serviceTokenGenerate.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Main/serviceMainPayload.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Contract/serviceTerminologyLink.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Sender/serviceSenderIntegration.php';
require_once APPPATH . 'modules/satuSehatBridge/service/Packing/servicePacking.php';

class serviceLogicANCIntegration
{
    protected $CI;
    protected $tokenService;
    protected $mainPayload;
    protected $senderService;
    protected $terminologyLink;
    protected $packingService;
    protected $locationId = 'cbaaf80a-4cab-4a85-aa39-71c4b3e1fd51';
    protected $displayLocation = 'Ruang Layanan Pemeriksaan Ibu, Anak dan Kesehatan Keluarga';

    protected $SATUSEHAT_AUTH_STG = 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1';
    protected $SATUSEHAT_FHIR_STG = 'https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1';
    protected $orgid_prod = '665ed4bb-62dc-4fc8-bcb1-8f9c440102fb';
    protected $clientId = 'uEsVwq1Q72nypypRgwpAw3RZAhWsk5LVIMjvxTip8Y2kAGqq';
    protected $clientSecret = 'nADFUIufwpzAHduGo9nNFTRQm9ukgGvaDVNVHzpKaAkS4JftVC8f3Cv8lNLo2bJW';

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('uuid');
        $this->tokenService = new serviceTokenGenerate();
        $this->mainPayload = new serviceMainPayload();
        $this->senderService = new serviceSenderIntegration();
        $this->terminologyLink = new serviceTerminologyLink();
        $this->packingService = new servicePacking();
    }

    public function sendANC($input)
    {
        $pasien = json_decode($input->post('pasien'), true);
         // Cek apakah data pasien ada dan lengkap
        if (empty($pasien) || empty($pasien['NAMA_LGKP']) || empty($pasien['IHS_NUMBER'])) {
            throw new ServiceException('Data pasien  tidak terdaftar di Satu Sehat atau tidak ditemukan', 400);
        }

        $pasienName = $pasien['NAMA_LGKP'];
        $pasienId = $pasien['IHS_NUMBER'];

        // Generate UUID Encounter sekali saja
        $uuidEncounter = $this->CI->uuid->v4();

        // Ambil token dulu
        $token = $this->tokenService->generateToken($this->SATUSEHAT_AUTH_STG, $this->clientId, $this->clientSecret);
        
        if (!isset($token['access_token'])) {
            return $this->CI->response->send(400, 'Token tidak ditemukan');
        }

        // Packing Diagnosa (wajib ada)
        $diagnosaList = $input->post('diagnosaList');
        if (empty($diagnosaList)) {
            throw new ServiceException('tidak ada diagnosa Medis yang masuk', 400);
        }
        $payloadDiagnosa = $this->packingService->packingConditionDiagnosaMedis($diagnosaList, $uuidEncounter, $pasienId, $pasienName);

        // Packing data lain (jika ada)
        $payloadPemantauan = $this->processPayloadSafe('pemantauanData', 'packingConditionPemantauanData', $uuidEncounter, $pasienId, $pasienName);
        $payloadPemantauanObs = $this->processPayloadSafe('pemantauanData', 'packingPemantauanObservation', $uuidEncounter, $pasienId, $pasienName);
        $payloadKunjungan = $this->processPayloadSafe('kunjunganData', 'packingKunjunganData', $uuidEncounter, $pasienId, $pasienName);
        $payloadPemeriksaanIbu = $this->processPayloadSafe('pemeriksaanIbu', 'packingPemeriksaanIbu', $uuidEncounter, $pasienId, $pasienName);
        $payloadPemeriksaanFisik = $this->processPayloadSafe('pemeriksaanFisikIbu', 'packingPemeriksaanFisikIbu', $uuidEncounter, $pasienId, $pasienName);
        $payloadUSG = $this->processPayloadSafe('pemeriksaanUsg', 'packingPemeriksaanUSG', $uuidEncounter, $pasienId, $pasienName);
        $payloadJanin = $this->processPayloadSafe('form1', 'packingJanin', $uuidEncounter, $pasienId, $pasienName);
        $payload10T = $this->processPayloadSafe('pemeriksaan10T', 'packing10T', $uuidEncounter, $pasienId, $pasienName);
        $payloadObsteri = $this->processPayloadSafe('obsteri', 'packingObservationObsetri', $uuidEncounter, $pasienId, $pasienName);
        // Episode of Care: cek dulu
        $episodeOfCare = $this->terminologyLink->getTerminologyEpisodeOfCare($this->SATUSEHAT_FHIR_STG, $pasienId, $token['access_token']);
        if (!$episodeOfCare) {
            $episodePayload = $this->packingService->packingEpisodeOfCare($pasienId, $pasienName, $this->orgid_prod);
            $episodeOfCareId = null;
        } else {
            $episodeOfCareId = $episodeOfCare['uuid'] ?? null;
        }
        // Jika episodeOfCare baru dibuat, ambil UUID dari payload
        if (empty($episodeOfCareId) && !empty($episodePayload)) {
            $episodeOfCareId = $episodePayload[0]['fullUrl'] ?? null;
        } else if ($episodeOfCareId) {
            $episodeOfCareId = 'urn:uuid:' . $episodeOfCareId;
        }
        // Kumpulkan semua payload selain encounter
        $allPayloads = array_merge(
            $payloadDiagnosa,
            $payloadPemantauan,
            $payloadPemantauanObs,
            $payloadKunjungan,
            $payloadPemeriksaanIbu,
            $payloadPemeriksaanFisik,
            $payloadUSG,
            $payloadJanin,
            $payload10T,
            $payloadObsteri
        );
        $allPayloads = $this->removerDuplicateCondition($allPayloads);
        // Ambil semua kondisi (Condition) untuk dimasukkan ke encounter
        $conditions = [];
        foreach ($allPayloads as $p) {
            if (isset($p['resource']['resourceType']) && $p['resource']['resourceType'] === 'Condition') {
                $conditions[] = $p;
            }
        }
        // ambil condition ecounter
        $conditionsEcounter =  $this->extractConditions($conditions);
        // Ambil lokasi
        $location['uuid'] = $this->locationId;
        $location['display'] =  $this->displayLocation;
        // Packing Encounter
        $payloadEncounter = $this->packingService->packingEcounter($uuidEncounter, $conditionsEcounter, $location, $pasienId, $pasienName, $this->orgid_prod, $episodeOfCareId);
        // Merge semua payload
        $finalPayload = array_merge($payloadEncounter, $allPayloads);
        // Gabungkan ke format main payload bundle
        $mergePayload = $this->mainPayload->mainPayloadCreate($finalPayload);
        //ubah ke array
        if (is_string($mergePayload) && json_decode($mergePayload) !== null) {
            $mergePayload = json_decode($mergePayload, true);
        }
        // Kirim ke satu sehat
        return $this->senderService->bundleANCSender($this->SATUSEHAT_FHIR_STG, $mergePayload, $token);
    }

    protected function processPayloadSafe($postKey, $method, $uuidEncounter, $pasienId, $pasienName) {
        if (!$this->CI->input->post($postKey)) {
            return []; // atau return false, atau return string kosong sesuai kebutuhan
        }
        
        return $this->packingService->$method($this->CI->input->post($postKey), $uuidEncounter, $pasienId, $pasienName);
    }
     protected function extractConditions(array $conditionsBundle): array
    {
        $result = [];
        $rank = 1;

        foreach ($conditionsBundle as $entry) {
            $fullUrl = str_replace('urn\\:uuid:', 'urn:uuid:', $entry['fullUrl'] ?? '');
            $display = $entry['resource']['code']['coding'][0]['display'] ?? 'Unknown';

            $result[] = [
                'id' => $fullUrl,
                'display' => $display,
                'rank' => $rank++,
            ];
        }

        return $result;
    }

    protected function removerDuplicateCondition($conditions) {
        $seen = [];
        $unique = [];
        foreach ($conditions as $condition) {
            $code = $condition['resource']['code']['coding'][0]['code'] ?? '';
            if (!in_array($code, $seen)) {
                $seen[] = $code;
                $unique[] = $condition;
            }
        }
        return $unique;
    }
}
