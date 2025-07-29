<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'modules/satuSehatBridge/interface/InterfaceForm.php');

class FormPackingFactory {
    public function manajemenFormPacking($formName) :InterfaceForm {
        switch ($formName) {
            case 'kunjungan_data': return new FormKunjuganDataRepository();
            case 'ecounter': return new FormEcounterRepository();
            case 'condition_riwayat': return new FormConditionRiwayatRepository();
            case 'condition_complication': return new FormConditionPemantauanRepository();  
            case 'pemeriksaan_ibu': return new FormPemeriksaanIbuRepository();
            case 'pemeriksaan_fisik_ibu': return new FormPemeriksaanFisikIbuRepository();
            case 'pemeriksaan_usg': return new FormPemeriksaanUsgRepository();
            case 'janin': return new FormJaninRepository();
            case 'pemeriksaan_10t': return new FormPemeriksaan10TRepository();
            case 'obsetri': return new FormObsetriRepository();
            case 'kunjungan_data': return new FormKunjuganDataRepository();
            case 'obsetri':return new FormObsetriRepository();
            case 'episode_of_care':return new FormEpisodeOfCareRepository();
            default: return null;
        }
    }
}
