<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/InterfaceResource.php');

interface InterfaceFHIRImunization extends InterfaceResource
{
    public function vaccineCode(array $vacinned): self;
    public function addStatus(string $status): self;
    public function addPatient(string $reference, string $display): self;
    public function addEcounter(string $reference): self;
    public function addOccurenceDateTime(string $occureTime): self;
    public function addRecorded(string $recorded): self;
    public function addPerformer(array $performer): self;
    public function addReasonCode(string $system, string $code, string $display): self;
    public function addProtocolApplied(int $dosis): self;
    public function addprimarySource(string $boolean): self;
    public function addLotNumber(string $lotNumber): self;
    public function addExprationDate(string $expired): self;
}
