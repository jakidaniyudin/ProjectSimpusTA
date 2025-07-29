<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/InterfaceResource.php');

interface InterfaceFHI7RCondition extends InterfaceResource
{
    public function withCode(string $code, string $display, ?string $system = null): self;
    public function withClinicalStatus(string $code, string $display, ?string $system = null): self;
    public function addSubject(array $patientId): self;
    public function forEncounter(array $encounter): self;
    public function withCategory(string $code, string $display, ?string $system = null): self;
    public function withSeverity(string $code, string $display, ?string $system = null): self;
    public function addMeta(array $meta): self;
    public function recordDateTime(string $recordTime): self;
    public function withVerificationStatus(string $code, string $display, ?string $system = null): self;
    public function withOnsetDateTime(string $dateTime): self;
    public function addAdditionalCode(string $code, string $display, string $system): self;
}
