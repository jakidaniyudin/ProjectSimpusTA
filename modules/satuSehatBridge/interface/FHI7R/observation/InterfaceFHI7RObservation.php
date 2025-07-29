<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/InterfaceResource.php');


interface InterfaceFHI7RObservation extends InterfaceResource
{
    public function withCode(array $codings): self;
    public function withStatus(string $status): self;
    public function forPatient(string $patientId, string $name): self;
    public function forEncounter(string $encounterReference): self;
    public function withIntegerValue($value): self;
    public function withQuantityValue(array $value): self;
    public function withStringValue(string $value): self;
    public function withEffectiveDateTime(string $dateTime): self;
    public function withCategory(string $code, string $display, ?string $system = null): self;
    public function issuedTime(string $timeStamp);
    public function performer(array $performer);
    public function withBodySite(string $code, string $display, string $system): self;
    public function withInterpretation(string $code, string $display, string $system): self;
    public function withReferenceRange(array $ranges): self;
    public function withCodeableConceptValue(string $system, string $code, string $display, ?string $text = null): self;
}