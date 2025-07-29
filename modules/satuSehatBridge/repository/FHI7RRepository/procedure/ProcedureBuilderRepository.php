<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/procedure/InterfaceFHI7RProcedure.php');
class ProcedureBuilderRepository implements InterfaceFHI7RProcedure
{
    protected $procedure;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): self
    {
        $this->procedure = [
            'resourceType' => 'Procedure',
        ];
        return $this;
    }



    private function createCoding(string $code, string $display, string $system): array
    {
        return [
            'system' => $system,
            'code' => $code,
            'display' => $display
        ];
    }

    // Core Procedure methods
    public function withCode(string $code, string $display, string $system = null): self
    {
        $this->procedure['code'] = [
            'coding' => [
                $this->createCoding(
                    $code,
                    $display,
                    $system ?? 'http://hl7.org/fhir/sid/icd-9-cm'
                )
            ]
        ];
        return $this;
    }

    public function withStatus(string $status): self
    {
        $this->procedure['status'] = $status;
        return $this;
    }

    public function forPatient(string $patientId, string $display): self
    {
        $this->procedure['subject'] = [
            'reference' => 'Patient/' . $patientId,
            'display' => $display

        ];
        return $this;
    }

    public function forEncounter(string $encounterReference): self
    {
        $this->procedure['encounter'] = [
            'reference' => $encounterReference
        ];
        return $this;
    }

    public function addPerformer(string $performerId, string $display = null): self
    {
        $performer = [
            'actor' => [
                'reference' => 'Practitioner/' . $performerId,
                'display' => $display
            ]
        ];
        $this->procedure['performer'][] = $performer;
        return $this;
    }

    // Additional methods
    public function withPerformedPriode(string $start, string $end): self
    {
        $this->procedure['performedPeriod'] = [
            'start' => $start,
            'end' =>  $end
        ];

        return $this;
    }
    public function withReason(string $code, string $display, string $system = null): self
    {
        if (!isset($this->procedure['reasonCode'])) {
            $this->procedure['reasonCode'] = [];
        }

        $this->procedure['reasonCode'][] = [
            'coding' => [
                $this->createCoding(
                    $code,
                    $display,
                    $system ?? 'http://hl7.org/fhir/sid/icd-10'
                )
            ]
        ];
        return $this;
    }

    public function validate(): void
    {
        if (!isset($this->procedure['code'])) {
            throw new \InvalidArgumentException('Procedure code is required');
        }

        if (empty($this->procedure['performer'])) {
            throw new \InvalidArgumentException('At least one performer is required');
        }
    }

    public function build(): array
    {
        $builtProcedure = $this->procedure;
        $this->reset();
        return $builtProcedure;
    }
}