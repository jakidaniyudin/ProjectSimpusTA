<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/InterfaceResource.php');

interface InterfaceFHI7RProcedure extends InterfaceResource
{
    public function withCode(string $code, string $display, ?string $system = null): self;
    public function withStatus(string $status): self;
    public function forPatient(string $patientId, string $display): self;
    public function forEncounter(string $encounterReference): self;
    public function addPerformer(string $performerId, ?string $display = null): self;
    public function withPerformedPriode(string $start, string $end): self;
    public function withReason(string $code, string $display, ?string $system = null): self;
}
