<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/condition/InterfaceFHI7RCondition.php');
class ConditionBuilderRepository implements InterfaceFHI7RCondition
{
    protected $condition;

    public function __construct()
    {
        $this->reset();
    }

    public function validate(): void
    {
        if (!isset($this->condition['code'])) {
            throw new \InvalidArgumentException('Condition code is required');
        }

        if (!isset($this->condition['subject'])) {
            throw new \InvalidArgumentException('Patient reference is required');
        }
    }

    public function reset(): self
    {
        $this->condition = [
            "resourceType" => "Condition",
            'subject' => [
                'reference' => 'Patient/100000030006'
            ]
        ];
        return $this;
    }

    public function clinicalStatus(string $code, string $display, string $system): self
    {
        $this->condition['clinicalStatus'] = [
            'coding' => [
                'code' => $code,
                'display' => $display,
                'system' => $system
            ]
        ];
        return $this;
    }

    public function addSubject(array $patient): self
    {
        $this->condition['subject'] = [
            'display' => $patient['display'],
            'reference' => $patient['reference']
        ];
        return $this;
    }
    private function createCoding(string $code, string $display, string $system): array
    {
        return [
            'code' => $code,
            'display' => $display,
            'system' => $system
        ];
    }
    public function withCode(string $code, string $display, string $system = null): self
    {
        $this->condition['code'] = [
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

    public function withClinicalStatus(string $code, string $display, string $system = null): self
    {
        $this->condition['clinicalStatus'] = [
            'coding' => [
                $this->createCoding(
                    $code,
                    $display,
                    $system ?? 'http://terminology.hl7.org/CodeSystem/condition-clinical'
                )
            ]
        ];
        return $this;
    }

    public function forEncounter(array $encounter): self
    {
        $this->condition['encounter'] = [
            'reference' => $encounter['reference']
        ];

        if (isset($encounter['display'])) {
            $this->condition['encounter']['display'] = $encounter['display'];
        }

        return $this;
    }

    // Additional coding methods
    public function addAdditionalCode(string $code, string $display, string $system): self
    {
        if (!isset($this->condition['code']['coding'])) {
            $this->condition['code'] = ['coding' => []];
        }
        $this->condition['code']['coding'][] = $this->createCoding($code, $display, $system);
        return $this;
    }


    // Tambahan method untuk kategori condition
    public function withCategory(string $code, string $display, string $system = null): self
    {
        if (!isset($this->condition['category'])) {
            $this->condition['category'] = [];
        }

        $this->condition['category'][] = [
            'coding' => [
                $this->createCoding(
                    $code,
                    $display,
                    $system ?? 'http://terminology.hl7.org/CodeSystem/condition-category'
                )
            ]
        ];
        return $this;
    }

    public function addMeta(array $meta): self
    {
        $this->condition['meta'] = [
            'lastUpdated' => $meta['lastUpdated'],
            'versionId' => $meta['versionId']
        ];
        return $this;
    }



    // Tambahan method untuk severity
    public function withSeverity(string $code, string $display, string $system = null): self
    {
        $this->condition['severity'] = [
            'coding' => [
                $this->createCoding(
                    $code,
                    $display,
                    $system ?? 'http://snomed.info/sct'
                )
            ]
        ];
        return $this;
    }

    public function withOnsetDateTime(string $dateTime): self
    {
        $this->condition['onsetDateTime'] = $dateTime;
        return $this;
    }

    public function recordDateTime(string $recordTiome): self
    {
        $this->condition['recordedDate'] =  $recordTiome;
        return $this;
    }



    // Tambahan method untuk verification status
    public function withVerificationStatus(string $code, string $display, string $system = null): self
    {
        $this->condition['verificationStatus'] = [
            'coding' => [
                $this->createCoding(
                    $code,
                    $display,
                    $system ?? 'http://terminology.hl7.org/CodeSystem/condition-ver-status'
                )
            ]
        ];
        return $this;
    }

    public function build(): array
    {
        if (!isset($this->condition['code'])) {
            throw new Exception('Condition code is required');
        }

        $builtCondition = $this->condition;
        $this->reset();
        return $builtCondition;
    }
}