<?php 
require_once APPPATH . 'modules/satuSehatBridge/service/SetUp/serviceSetupANC.php';
class ServicePacking {
    protected $setUpPayload;

    public function __construct(){
        $this->setUpPayload = new serviceSetupANC();
    }

    public function packingEcounter($uuidEcounter, $Condition, $location, $pasienId, $pasienName, $orgId, $episodeOfCare)
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
                    'condition',
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

    public function packingKunjunganData($payloadDataKunjungan, $uuidEcounter, $patientId, $patientName){
        $payloadUsiaKehamilan =  $this->setUpPayload->setObsetriQuantityValue('usia_hamil', $payloadDataKunjungan['usia_kehamilan']['value'],$uuidEcounter, $patientId, $patientName);
        $payloadTrimester = $this->setUpPayload->SetObservationValueInt('trimester',$payloadDataKunjungan['trimester']['value'], $uuidEcounter, $patientId, $patientName);
        return [
            $payloadUsiaKehamilan,
            $payloadTrimester
        ];

    }

    public function packingPemeriksaanIbu($payloadDataIbu, $uuidEcounter, $patientId, $patientName, $idDokter = null, $nameDokter = null)
    {
        $payloadBeratBadan = $this->setUpPayload->setObsetriQuantityValue('bb', $payloadDataIbu['beratBadan']['value'], $uuidEcounter, $patientId, $patientName);
        $payloadLingkarLengan = $this->setUpPayload->setObsetriQuantityValueAndInterpretation('lila', $payloadDataIbu['lingkarLengan']['value'], $uuidEcounter, $patientId, $patientName);
        $payloadTinggiFundus = $this->setUpPayload->setObsetriQuantityValue('tfu', $payloadDataIbu['tinggiFundus']['value'], $uuidEcounter, $patientId, $patientName);
    
        $payloadSistolik = !empty($payloadDataIbu['sistolik']) 
            ? $this->setUpPayload->setObsetriQuantityValue('sistolik', $payloadDataIbu['sistolik']['value'], $uuidEcounter, $patientId, $patientName)
            : [];
    
        $payloadDiastolik = !empty($payloadDataIbu['diastolik']) 
            ? $this->setUpPayload->setObsetriQuantityValue('diastolik', $payloadDataIbu['diastolik']['value'], $uuidEcounter, $patientId, $patientName)
            : [];
    
        $payloadNadi = !empty($payloadDataIbu['nadi']) 
            ? $this->setUpPayload->setObsetriQuantityValue('nadi', $payloadDataIbu['nadi']['value'], $uuidEcounter, $patientId, $patientName)
            : [];
    
        $payloadPernapasan = !empty($payloadDataIbu['pernapasan']) 
            ? $this->setUpPayload->setObsetriQuantityValue('napas', $payloadDataIbu['pernapasan']['value'], $uuidEcounter, $patientId, $patientName)
            : [];
    
        $payloadGolonganDarah = $this->setUpPayload->setObservationCodeLabel('goldar', $payloadDataIbu['golonganDarah']['value'], $uuidEcounter, $patientId, $patientName);
        $payloadRhesus = $this->setUpPayload->setObservationCodeLabel('rhesus', $payloadDataIbu['rhesus']['value'], $uuidEcounter, $patientId, $patientName);
    
        return [
            $payloadBeratBadan,
            $payloadLingkarLengan,
            $payloadTinggiFundus,
            $payloadSistolik,
            $payloadDiastolik,
            $payloadNadi,
            $payloadPernapasan,
            $payloadGolonganDarah,
            $payloadRhesus
        ];
    }
    

    public function packingPemeriksaanFisikIbu($payloadDataFisikIbu, $uuidEcounter, $patientId, $patientName, $idDokter = null, $nameDokter = null)
    {
        $payloadKonjungtiva   = $this->setUpPayload->setObservasiInterpretationBodySheet('konjungtiva', $payloadDataFisikIbu['konjungtiva']['value'], $uuidEcounter, $patientId, $patientName);
        $payloadSklera        = $this->setUpPayload->setObservasiInterpretationBodySheet('sklera', $payloadDataFisikIbu['sklera']['value'], $uuidEcounter, $patientId, $patientName);
        $payloadLeher         = $this->setUpPayload->setObservasiInterpretation('leher', $payloadDataFisikIbu['leher']['value'], $uuidEcounter, $patientId, $patientName);
        $payloadGigiMulut     = $this->setUpPayload->setObservasiInterpretation('gigi', $payloadDataFisikIbu['gigiMulut']['value'], $uuidEcounter, $patientId, $patientName);
        $payloadTungkai       = $this->setUpPayload->setObservasiInterpretation('tungkai', $payloadDataFisikIbu['tungkai']['value'], $uuidEcounter, $patientId, $patientName);
        $payloadTHT           = $this->setUpPayload->setObservasiInterpretation('tht', $payloadDataFisikIbu['tht']['value'], $uuidEcounter, $patientId, $patientName);
        $payloadDadaJantung   = $this->setUpPayload->setObservasiInterpretation('dada', $payloadDataFisikIbu['dadaJantung']['value'], $uuidEcounter, $patientId, $patientName);
        $payloadPerut         = $this->setUpPayload->setObservasiInterpretation('perut', $payloadDataFisikIbu['perut']['value'], $uuidEcounter, $patientId, $patientName);
    
        return [
            $payloadKonjungtiva,
            $payloadSklera,
            $payloadLeher,
            $payloadGigiMulut,
            $payloadTungkai,
            $payloadTHT,
            $payloadDadaJantung,
            $payloadPerut
        ];
    }
    
    public function packingPemeriksaanUsg($payloadUsg, $uuidEncounter, $patientId, $patientName)
    {
        $result = [];

        if (!empty($payloadUsg['gsDiameter']['value'])) {
            $result[] = $this->setUpPayload->setObsetriQuantityValue('gs', $payloadUsg['gsDiameter']['value'], $uuidEncounter, $patientId, $patientName);
        }

        if (!empty($payloadUsg['crl']['value'])) {
            $result[] = $this->setUpPayload->setObsetriQuantityValue('crl', (float)$payloadUsg['crl']['value'], $uuidEncounter, $patientId, $patientName);
        }

        if (!empty($payloadUsg['djj']['value'])) {
            $result[] = $this->setUpPayload->setObsetriQuantityValue('djj_usg', $payloadUsg['djj']['value'], $uuidEncounter, $patientId, $patientName);
        }

        if (!empty($payloadUsg['usiaKehamilan']['value'])) {
            $result[] = $this->setUpPayload->setObsetriQuantityValue('usia_usg', (float)$payloadUsg['usiaKehamilan']['value'], $uuidEncounter, $patientId, $patientName);
        }

        if (!empty($payloadUsg['perkiraanLahir']['value'])) {
            $result[] = $this->setUpPayload->setObservationDateTime('hpl_usg', $payloadUsg['perkiraanLahir']['value'], $uuidEncounter, $patientId, $patientName);
        }

        if (!empty($payloadUsg['letakJanin']['value'])) {
            $result[] = $this->setUpPayload->setObservationCodeLabel('letak_janin', $payloadUsg['letakJanin']['value'], $uuidEncounter, $patientId, $patientName);
        }

        if (!empty($payloadUsg['bpd']['value'])) {
            $result[] = $this->setUpPayload->setObsetriQuantityValue('bpd', $payloadUsg['bpd']['value'], $uuidEncounter, $patientId, $patientName);
        }

        if (!empty($payloadUsg['hc']['value'])) {
            $result[] = $this->setUpPayload->setObsetriQuantityValue('hc', $payloadUsg['hc']['value'], $uuidEncounter, $patientId, $patientName);
        }

        if (!empty($payloadUsg['ac']['value'])) {
            $result[] = $this->setUpPayload->setObsetriQuantityValue('ac', $payloadUsg['ac']['value'], $uuidEncounter, $patientId, $patientName);
        }

        if (!empty($payloadUsg['fl']['value'])) {
            $result[] = $this->setUpPayload->setObsetriQuantityValue('fl', $payloadUsg['fl']['value'], $uuidEncounter, $patientId, $patientName);
        }

        if (!empty($payloadUsg['beratJanin']['value'])) {
            $result[] = $this->setUpPayload->setObsetriQuantityValue('bb_janin', $payloadUsg['beratJanin']['value'], $uuidEncounter, $patientId, $patientName);
        }

        return $result;
    }

    

    public function packingJanin($payloadJanin, $uuidEncounter, $patientId, $patientName)
    {
        $payloadDJJ = $this->setUpPayload->setObsetriQuantityValue('djj', $payloadJanin['denyutJantungJanin']['value'], $uuidEncounter, $patientId, $patientName);
        $payloadKepalaPAP = $this->setUpPayload->setObservationCodeLabel('kepala_pap', $payloadJanin['kendalaPAP']['value'], $uuidEncounter, $patientId, $patientName);
        $payloadTBJ = $this->setUpPayload->setObsetriQuantityValue('takberatjanin', $payloadJanin['taksiranBeratJanin']['value'], $uuidEncounter, $patientId, $patientName);
        $payloadPresentasi = $this->setUpPayload->setObservationCodeLabel('presentasi', $payloadJanin['presentasi']['value'], $uuidEncounter, $patientId, $patientName);

        return [
            $payloadDJJ,
            $payloadKepalaPAP,
            $payloadTBJ,
            $payloadPresentasi
        ];
    }



    public function packing10T($payload10T, $uuidEncounter, $patientId, $patientName)
    {
        // Data numeric atau boolean
        $payloadHbg = $this->setUpPayload->setObsetriQuantityValue('hbg', $payload10T['hemoglobin']['value'], $uuidEncounter, $patientId, $patientName);
        $payloadGds = $this->setUpPayload->setObsetriQuantityValue('gds', $payload10T['gulaDarah']['value'], $uuidEncounter, $patientId, $patientName);
        $payloadProteinUrin = $this->setUpPayload->setObsetriQuantityValue('protein_urin', $payload10T['proteinUrin']['value'], $uuidEncounter, $patientId, $patientName);

        // Data kualitatif
        $payloadHiv = $this->setUpPayload->setObservationCodeLabel('ppia_hiv', $payload10T['hivTest']['value'], $uuidEncounter, $patientId, $patientName);
        $payloadSyphilis = $this->setUpPayload->setObservationCodeLabel('ppia_rpr', $payload10T['syphilisTest']['value'], $uuidEncounter, $patientId, $patientName);
        $payloadHepatitisB = $this->setUpPayload->setObservationCodeLabel('ppia_hbsag', $payload10T['hepatitisBTest']['value'], $uuidEncounter, $patientId, $patientName);

        return [
            $payloadHbg,
            $payloadGds,
            $payloadProteinUrin,
            $payloadHiv,
            $payloadSyphilis,
            $payloadHepatitisB
        ];
    }
    public function packingConditionPemantauanData($payloadDataCodition, $uuidEcounter, $patientId, $patienName)
    {
        $payloadComplication =  $this->setUpPayload->setConditionComplication('condition',$uuidEcounter, $patientId, $patienName, $payloadDataCodition['kdDiagnosa']['value'], $payloadDataCodition['nmDiagnosa']['value']);
        $payloadRiwayatPribadi =  $this->setUpPayload->setConditionRiwayat($uuidEcounter, $patientId, $patienName, $payloadDataCodition['codePribadi']['value'], $payloadDataCodition['valueSetPribadi']['value']);
        $payloadRiwayatKeluarga =  $this->setUpPayload->setConditionRiwayat($uuidEcounter, $patientId, $patienName, $payloadDataCodition['codeKeluarga']['value'], $payloadDataCodition['valueSetKeluarga']['value']);
        return [
            $payloadComplication,
            $payloadRiwayatPribadi,
            $payloadRiwayatKeluarga
        ];
    }

    public function packingPemantauanObservation($payloadPemantauan, $uuidEncounter, $patientId, $patientName)
    {
    

        $payloadRokok = $this->setUpPayload->setObservationCodeLabel('rokok', $payloadPemantauan['status_merokok']['value'], $uuidEncounter, $patientId, $patientName);
        $payloadAlkohol = $this->setUpPayload->setObservationCodeLabel('alkohol', $payloadPemantauan['status_alkohol']['value'], $uuidEncounter, $patientId, $patientName);
        
    
        return [
            $payloadRokok,
            $payloadAlkohol
        ];
    }
    

    public function packingObservationObsetri($payloadObservation, $uuidEcounter, $pasienId, $pasienName)
    {
        $payloadGravida = $this->setUpPayload->SetObservationValueInt('gravida',$payloadObservation['gravida'], $uuidEcounter, $pasienId, $pasienName);
        $payloadPartus = $this->setUpPayload->SetObservationValueInt('partus',$payloadObservation['partus'], $uuidEcounter, $pasienId, $pasienName);
        $payloadAbortus = $this->setUpPayload->SetObservationValueInt('abortus',$payloadObservation['abortus'], $uuidEcounter, $pasienId, $pasienName);
        $payloadHPHT = $this->setUpPayload->setObservationDateTime('hpht',$payloadObservation['tphtDate'], $uuidEcounter, $pasienId, $pasienName);
        //$payloadHPL = $this->setUpPayload->setHPL($payloadObservation['bbSebelumHamil'], $uuidEcounter, $pasien_id, $nama_lengkap);
        $payloadBBSebelumHamil = $this->setUpPayload->setObsetriQuantityValue('bb_sebelum',$payloadObservation['bbSebelumHamil'], $uuidEcounter, $pasienId, $pasienName);
        $payloadTB = $this->setUpPayload->setObsetriQuantityValue('tb',$payloadObservation['tinggiBadan'], $uuidEcounter, $pasienId, $pasienName);
        $payloadBBT =  $this->setUpPayload->setObservationCodeLabel('tnbb',$payloadObservation['bb_target'], $uuidEcounter, $pasienId, $pasienName);
        $payloadIMT =  $this->setUpPayload->setObsetriQuantityValueAndInterpretation('imt',$payloadObservation['imt'], $uuidEcounter, $pasienId,  $pasienName);
        $payloadJKS = $this->setUpPayload->setObsetriQuantityValue('jks',$payloadObservation['jarak_hamil'], $uuidEcounter, $pasienId,  $pasienName);

        return [
            $payloadGravida,
            $payloadPartus,
            $payloadAbortus,
            $payloadHPHT,
            //$payloadHPL,
            $payloadBBSebelumHamil,
            $payloadTB,
            $payloadBBT,
            $payloadIMT,
            $payloadJKS
        ];
    }
}