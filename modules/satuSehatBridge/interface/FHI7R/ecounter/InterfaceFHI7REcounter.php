<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/InterfaceResource.php');

interface InterfaceFHI7REcounter extends InterfaceResource
{
    public function forPatient(array $patient);
    public function withStatus(string $status);
    public function withClass(array $classConfig);
    public function withPeriod(string $start, string $end);
    public function addParticipant(array $practitioner);
    public function addLocation(array $location);
    public function addLocationExtension(array $locaiton);
    public function addDiagnosis(array $condition, array $role);
    public function addStatusHistory(string $status, string $start, string $end);
    public function withHospitalization(array $dischargeConfig);
    public function addIdentifier(array $indetifier);
}
