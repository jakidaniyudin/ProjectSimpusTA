<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/imunization/InterfaceFHIRImunization.php');
class ImunizationFHIRRepository implements InterfaceFHIRImunization
{
    protected $imunization;

    public function __construct()
    {
        $this->reset();
    }

    public function validate(): void {}

    public function reset(): self
    {
        $this->imunization = [
            'resourceType' => 'Immunization'
        ];
        return $this;
    }

    public function vaccineCode(array $vacinned): self
    {
        $coding = [];
        foreach ($vacinned as $index) {
            $coding[] = [
                'system' => $index['system'],
                'code' =>  $index['code'],
                'display' => $index['display']
            ];
        }

        $this->imunization = [
            'vaccineCode' => [
                'coding' => $coding
            ]
        ];

        return $this;
    }

    public function addStatus(string $status): self
    {
        $this->imunization['status'] = $status;
        return $this;
    }

    public function  addPatient(string $reference, string $display): self
    {
        $this->imunization['patient'] = [
            'reference' =>  $reference,
            'display' =>  $display
        ];
        return $this;
    }
    public function  addEcounter(string $reference): self
    {
        $this->imunization['encounter'] = [
            'reference' => $reference
        ];
        return $this;
    }

    public function addOccurenceDateTime(string $occureTime): self
    {
        $this->imunization['occurrenceDateTime'] = $occureTime;
        return $this;
    }

    public function addRecorded(string $recorded): self
    {
        $this->imunization['recorded'] =  $recorded;
        return $this;
    }

    public function addPerformer(array $performer): self
    {
        $performerList = [];

        // Handle single performer array
        if (isset($performer['system'])) {
            $performer = [$performer];
        }

        foreach ($performer as $list) {
            $performerList[] = [
                'function' => [
                    'coding' => [
                        [
                            'system' => $list['system'],
                            'code' => $list['code'],
                            'display' => $list['display']
                        ]
                    ]
                ],
                'actor' => [
                    'reference' => $list['actor']
                ]
            ];
        }

        $this->imunization['performer'] = $performerList;
        return $this;
    }
    public function addReasonCode(string $system, string $code, string $display): self
    {
        $this->imunization['reasonCode'] = [
            'coding' => [
                [
                    'system' =>  $system,
                    'code' =>  $code,
                    'display' => $display
                ]
            ]
        ];

        return $this;
    }
    public function addProtocolApplied(int $dosis): self
    {
        $this->imunization['protocolApplied'] = [
            [
                'doseNumberPositiveInt' => $dosis
            ]
        ];
        return $this;
    }
    public function addprimarySource(string $boolean): self
    {
        $this->imunization['primarySource'] =  $boolean;
        return $this;
    }

    public function addLotNumber(string $lotNumber): self
    {
        $this->imunization['lotNumber'] = $lotNumber;
        return $this;
    }

    public function addExprationDate(string $expired): self
    {
        $this->imunization['expirationDate'] = $expired;
        return $this;
    }

    public function build(): array
    {
        $builtImunization = $this->imunization;
        $this->reset();
        return $builtImunization;
    }
}