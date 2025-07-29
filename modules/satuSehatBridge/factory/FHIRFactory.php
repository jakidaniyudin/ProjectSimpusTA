<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class FHIRFactory
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();

        // Load interfaces
        (!interface_exists('InterfaceFHI7RCondition') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/condition/InterfaceFHI7RCondition.php'));
        (!interface_exists('InterfaceFHI7REcounter') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/ecounter/InterfaceFHI7REcounter.php'));
        (!interface_exists('InterfaceFHI7RObservation') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/observation/InterfaceFHI7RObservation.php'));
        (!interface_exists('InterfaceFHI7RProcedure') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/procedure/InterfaceFHI7RProcedure.php'));
        (!interface_exists('InterfaceFHIRImunization') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/imunization/InterfaceFHIRImunization.php'));
        (!interface_exists('interfaceFHIREpisodeOfCare') && $this->ci->load->file(APPPATH . '/modules/satuSehatBridge/interface/FHI7R/episodeOfCare/interfaceFHIREpisodeOfCare.php'));
        (!interface_exists('interfaceFHI7RQuestionnaire') && $this->ci->load->file(APPPATH . '/modules/satuSehatBridge/interface/FHI7R/questionary/interfaceFHI7RQuestionnaire.php'));
        // Load repositories - PERHATIKAN PENULISAN PATH YANG BENAR
        (!class_exists('ConditionBuilderRepository') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/repository/FHI7RRepository/condition/ConditionBuilderRepository.php'));
        (!class_exists('EncounterBuilderRepository') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/repository/FHI7RRepository/ecounter/EncounterBuilderRepository.php'));
        (!class_exists('ObservationBuilderRepository') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/repository/FHI7RRepository/observation/ObservationBuilderRepository.php'));
        (!class_exists('ProcedureBuilderRepository') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/repository/FHI7RRepository/procedure/ProcedureBuilderRepository.php'));
        (!class_exists('ImunizationFHIRRepository') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/repository/FHI7RRepository/imunization/ImunizationFHIRRepository.php'));
        (!class_exists('EpisodeOfCareFHIRRepository') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/repository/FHI7RRepository/episodeOfCare/EpisodeOfCareFHIRRepository.php'));
        (!class_exists('QuestionaryFHIRRepository') && $this->ci->load->file(APPPATH . 'modules/satuSehatBridge/repository/FHI7RRepository/questionary/QuestionaryFHIRRepository.php'));
    }

    public  function createConditionBuilder(): InterfaceFHI7RCondition
    {
        return new ConditionBuilderRepository();
    }

    public  function createEncounterBuilder(): InterfaceFHI7REcounter
    {
        return new EncounterBuilderRepository();
    }

    public  function createObservationBuilder(): InterfaceFHI7RObservation
    {
        return new ObservationBuilderRepository();
    }

    public  function createProcedureBuilder(): InterfaceFHI7RProcedure
    {
        return new ProcedureBuilderRepository();
    }

    public function createImunizationBuilder(): InterfaceFHIRImunization
    {
        return new ImunizationFHIRRepository();
    }

    public function createEpisodeOfCareBuilder(): interfaceFHIREpisodeOfCare
    {
        return new EpisodeOfCareFHIRRepository();
    }

    public function createPayloadQuestionnaireResponseBuilder(): interfaceFHI7RQuestionnaire
    {
        return new  QuestionaryFHIRRepository();
    }
}