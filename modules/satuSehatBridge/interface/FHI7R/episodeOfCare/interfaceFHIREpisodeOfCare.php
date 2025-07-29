<?php 

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/InterfaceResource.php');

interface interfaceFHIREpisodeOfCare extends InterfaceResource {
    public function addIdentifier(array $identifier): self;
    public function withStatus(string $status): self;
    public function addStatusHistory(string $status, string $start, string $end): self;
    public function withType(array $type): self;
    public function forPatient(string $pasienId, string $patienName): self;
    public function byOrganization(string $orgId): self;
    public function withPeriod(string $start): self;
}