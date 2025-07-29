<?php
require_once APPPATH . '/modules/satuSehatBridge/interface/FHI7R/episodeOfCare/interfaceFHIREpisodeOfCare.php';
class EpisodeOfCareFHIRRepository implements interfaceFHIREpisodeOfCare
{
    protected $resource;

    public function __construct(){
        $this->reset();
    }

    public function reset(): self
    {
        $this->resource = [
            'resourceType' => 'EpisodeOfCare'
        ];
        return $this;
    }

    public function addIdentifier(array $identifier): self
    {
        $this->resource['identifier'][] = $identifier;
        return $this;
    }

    public function withStatus(string $status): self
    {
        $this->resource['status'] = $status;
        return $this;
    }

    public function addStatusHistory(string $status, string $start, string $end = null): self
    {
        if($end){
            $this->resource['statusHistory'][] = [
                'status' => $status,
                'period' => [
                    'start' => $start,
                     'end' => $end]
            ];
        }else{
            $this->resource['statusHistory'][] = [
                'status' => $status,
                'period' => [
                    'start' => $start
                ]
            ];
        }
        
        return $this;
    }

    public function withType(array $type): self
    {
        $this->resource['type'][] = [
            'coding' => [$type]
        ];
        return $this;
    }

    public function forPatient(string $pasienId, string $patienName): self
    {
        $this->resource['patient'] = [
            'reference' => 'Patient/'. $pasienId,
            'display' => $patienName
        ];
        return $this;
    }

    public function byOrganization(string $orgId): self
    {
        $this->resource['managingOrganization'] = [
            'reference' => 'Organization/' . $orgId
        ];
        return $this;
    }


    public function withPeriod(string $start): self
    {
        $this->resource['period'] = ['start' => $start];
        return $this;
    }

    public function build(): array
    {
        return $this->resource;
    }

    public function validate(): void
    {
        // Optional: Tambahkan validasi skema sesuai kebutuhan
    }
}