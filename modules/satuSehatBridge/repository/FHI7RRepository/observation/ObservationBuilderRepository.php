<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/observation/InterfaceFHI7RObservation.php');

class  ObservationBuilderRepository implements InterfaceFHI7RObservation
{
    private $observation;

    public function __construct()
    {
        $this->reset();
    }

    public function validate(): void {}
    public function reset(): self
    {
        $this->observation = [
            'resourceType' => 'Observation',
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

    public function withCode(array $codings): self
    {
        $this->observation['code'] = [
            'coding' => array_map(function ($coding) {
                return $this->createCoding(
                    $coding['code'],
                    $coding['display'],
                    $coding['system'] ?? 'http://loinc.org'
                );
            }, $codings)
        ];
        return $this;
    }

    public function withStatus(string $status): self
    {
        $this->observation['status'] = $status;
        return $this;
    }

    public function forPatient(string $patientId, string $name): self
    {
        $this->observation['subject'] = [
            'reference' => 'Patient/' . $patientId,
            "display" =>  $name
        ];
        return $this;
    }


    public function forEncounter(string $encounterReference): self
    {
        $this->observation['encounter'] = [
            'reference' => $encounterReference
        ];
        return $this;
    }

    // Value methods
    public function withIntegerValue($value): self
    {
        $this->observation['valueInteger'] = $value;
        return $this;
    }

    public function withQuantityValue(array $value): self
    {
        $this->observation['valueQuantity'] = [
            'value' => $value['value'],
            'unit' => $value['unit'],
            'system' => $value['system'] ?? 'http://unitsofmeasure.org',
            'code' => $value['code']
        ];
        return $this;
    }

    public function withStringValue(string $value): self
    {
        $this->observation['valueDateTime'] = $value;
        return $this;
    }

    // Additional methods
    public function withEffectiveDateTime(string $dateTime): self
    {
        $this->observation['effectiveDateTime'] = $dateTime;
        return $this;
    }

    public function withCategory(string $code, string $display, string $system = null): self
    {
        if (!isset($this->observation['category'])) {
            $this->observation['category'] = [];
        }

        $this->observation['category'][] = [
            'coding' => [
                $this->createCoding(
                    $code,
                    $display,
                    $system ?? 'http://terminology.hl7.org/CodeSystem/observation-category'
                )
            ]
        ];
        return $this;
    }

    public function issuedTime(string $timeStamp)
    {
        $this->observation['issued'] =  $timeStamp;
        return $this;
    }

    public function performer(array $performer)
    {
        $arrayPerformer = [];
        foreach ($performer as $reference) {
            $arrayPerformer[] = ['reference' => $reference];
        }
        $this->observation['performer'] = $arrayPerformer;
        return $this;
    }

    public function withInterpretation(string $code, string $display, string $system): self
    {
        $this->observation['interpretation'] = [[
            'coding' => [[
                'system' => $system,
                'code' => $code,
                'display' => $display
            ]]
        ]];

        return $this;
    }

    public function withReferenceRange(array $ranges): self
    {
        $this->observation['referenceRange'] = [];

        foreach ($ranges as $range) {
            $entry = [];

            if (isset($range['low']) && is_array($range['low'])) {
                $entry['low'] = $range['low'];
            } elseif (isset($range['low']) && is_numeric($range['low'])) {
                $entry['low'] = [
                    'value' => $range['low']
                ];
            }

            if (isset($range['high']) && is_array($range['high'])) {
                $entry['high'] = $range['high'];
            } elseif (isset($range['high']) && is_numeric($range['high'])) {
                $entry['high'] = [
                    'value' => $range['high']
                ];
            }

            if (isset($range['text'])) {
                $entry['text'] = $range['text'];
            }

            $this->observation['referenceRange'][] = $entry;
        }

        return $this;
    }

    public function withBodySite(string $code, string $display, string $system): self
    {
        $this->observation['bodySite'] = [
            'coding' => [
                $this->createCoding($code, $display, $system)
            ]
        ];
        return $this;
    }

    public function withCodeableConceptValue(string $system, string $code, string $display, ?string $text = null): self
    {
        $this->observation['valueCodeableConcept'] = [
            'coding' => [
                [
                    'system'  => $system,
                    'code'    => $code,
                    'display' => $display,
                ]
            ]
        ];

        if ($text !== null) {
            $this->observation['valueCodeableConcept']['text'] = $text;
        }

        return $this;
    }
    // Verification and build
    // public function validate(): void
    // {
    //     if (!isset($this->observation['code'])) {
    //         throw new \InvalidArgumentException('Observation code is required');
    //     }

    //     if (!isset($this->observation['subject'])) {
    //         throw new \InvalidArgumentException('Patient reference is required');
    //     }

    //     $valueFields = ['valueInteger', 'valueQuantity', 'valueString', 'valueBoolean', 'valueDateTime'];
    //     $hasValue = false;
    //     foreach ($valueFields as $field) {
    //         if (isset($this->observation[$field])) {
    //             $hasValue = true;
    //             break;
    //         }
    //     }

    //     if (!$hasValue) {
    //         throw new \InvalidArgumentException('Observation value is required');
    //     }
    // }

    public function build(): array
    {
        // $this->validate();
        $builtObservation = $this->observation;
        $this->reset();
        return $builtObservation;
    }
}