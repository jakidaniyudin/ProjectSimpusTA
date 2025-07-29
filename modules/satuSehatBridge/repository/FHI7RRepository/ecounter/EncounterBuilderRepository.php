<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/ecounter/InterfaceFHI7REcounter.php');
class EncounterBuilderRepository implements InterfaceFHI7REcounter
{
    private $encounter;

    public function __construct()
    {
        // untuk melakukan resert semua nilai
        $this->reset();
    }

    public function validate(): void {}
    public function reset($config = null): self
    {
        $this->encounter = [
            'resourceType' => 'Encounter',
            'status' => 'finished',
            'identifier' => [],
            'class' => $this->defaultClass(),
        ];
        return $this;
    }

    private function defaultClass(): array
    {
        return [
            'system' => 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
            'code' => 'AMB',
            'display' => 'ambulatory'
        ];
    }

    // Core encounter methods
    public function forPatient(array $patient): self
    {
        $this->encounter['subject'] = [
            'reference' => 'Patient/' . $patient['id'],
            'display' => $patient['name']
        ];

        if (isset($patient['orgId'])) {
            $this->encounter['serviceProvider'] = [
                'reference' => 'Organization/' . $patient['orgId']
            ];
        }
        if (isset($patient['episodeId'])) {
            $this->encounter['episodeOfCare'] = [[
                'reference' => $patient['episodeId']
            ]];
        }
        return $this;
    }

    public function withStatus(string $status): self
    {
        $this->encounter['status'] = $status;
        return $this;
    }

    public function withClass(array $classConfig = []): self
    {
        $this->encounter['class'] = [
            'system' => $classConfig['system'] ?? 'http://terminology.hl7.org/CodeSystem/v3-ActCode',
            'code' => $classConfig['code'] ?? 'AMB',
            'display' => $classConfig['display'] ?? 'ambulatory'
        ];
        return $this;
    }

    // Period methods
    public function withPeriod(string $start, string $end = null): self
    {
        $this->encounter['period'] = [
            'start' => $start ?? date('c'),
            'end' => $end ?? date('c')
        ];
        return $this;
    }

    // Participant methods
    public function addParticipant(array $participantData): self
    {
        // Deteksi apakah input adalah single participant (tidak punya index 0)
        if (!isset($participantData[0])) {
            // Convert single participant menjadi array untuk konsistensi
            $participantData = [$participantData];
        }

        foreach ($participantData as $participant) {
            $this->encounter['participant'][] = $this->buildParticipantEntry($participant);
        }

        return $this;
    }

    private function buildParticipantEntry(array $participant): array
    {
        $entry = [
            'type' => [
                [
                    'coding' => [
                        [
                            'system' => $participant['type']['system'] ?? 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType',
                            'code' => $participant['type']['code'] ?? 'ATND',
                            'display' => $participant['type']['display'] ?? 'attender'
                        ]
                    ]
                ]
            ],
            'individual' => [
                'reference' => 'Practitioner/' . $participant['id'],
                'display' => $participant['name']
            ]
        ];

        // Optional: Handle case ketika type langsung berupa array coding
        if (isset($participant['coding'])) {
            $entry['type'][0]['coding'] = $participant['coding'];
        }

        return $entry;
    }

    // Location methods
    public function addLocation(array $locationData): self
    {
        // Jika input adalah single location (tidak punya index 0)
        if (!isset($locationData[0])) {
            $locationData = [$locationData]; // Ubah ke array of locations
        }

        foreach ($locationData as $location) {
            $this->encounter['location'][] = [
                'location' => [
                    'reference' => 'Location/' . $location['id'],
                    'display' => $location['display']
                ]
            ];
        }

        return $this;
    }

    public function addLocationExtension(array $locationData){
        // Jika input adalah single location (tidak punya index 0)
        $locations = isset($locationData[0]) ? $locationData : [$locationData];

        foreach ($locations as $location) {
            // Validasi minimal: id, display, start, end, serviceClass
            if (
                !isset($location['id'], $location['display'], $location['start'], $location['end'], $location['serviceClass']['code'])
            ) {
                continue; // Skip jika ada yang penting hilang
            }

            $extension = [
                [
                    'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/ServiceClass',
                    'extension' => [
                        [
                            'url' => 'value',
                            'valueCodeableConcept' => [
                                'coding' => [[
                                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Outpatient',
                                    'code' => $location['serviceClass']['code'],
                                    'display' => $location['serviceClass']['display'] ?? null,
                                ]]
                            ]
                        ]
                    ]
                ]
            ];

            // Tambahkan upgradeClass jika ada
            if (isset($location['upgradeClass']['code'])) {
                $extension[0]['extension'][] = [
                    'url' => 'upgradeClassIndicator',
                    'valueCodeableConcept' => [
                        'coding' => [[
                            'system' => 'http://terminology.kemkes.go.id/CodeSystem/locationUpgradeClass',
                            'code' => $location['upgradeClass']['code'],
                            'display' => $location['upgradeClass']['display'] ?? null,
                        ]]
                    ]
                ];
            }

            // Tambahkan ke encounter
            $this->encounter['location'][] = [
                'location' => [
                    'reference' => 'Location/' . $location['id'],
                    'display' => $location['display'],
                ],
                'period' => [
                    'start' => $location['start'],
                    'end' => $location['end'],
                ],
                'extension' => $extension
            ];
        }

        return $this;

       
    }

    // Diagnosis methods
    public function addDiagnosis(array $condition, array $role = []): self
    {
        $diagnosis = [
            'condition' => [
                'reference' => $condition['id'],
            ],
            'use' => [
                'coding' => [[
                    'system' => $role['system'] ?? 'http://terminology.hl7.org/CodeSystem/diagnosis-role',
                    'code' => $role['code'] ?? 'DD',
                    'display' => $role['display'] ?? 'Discharge diagnosis'
                ]]
            ]
        ];
    
        if (!empty($condition['display'])) {
            $diagnosis['condition']['display'] = $condition['display'];
        }
    
        if (isset($condition['rank'])) {
            $diagnosis['rank'] = $condition['rank'];
        }
    
        $this->encounter['diagnosis'][] = $diagnosis;
    
        return $this;
    }
    
    

    // Status history methods
    public function addStatusHistory(string $status, string $start, string $end = null): self
    {
        $this->encounter['statusHistory'][] = [
            'status' => $status,
            'period' => [
                'start' => $start,
                'end' => $end ?? $start
            ]
        ];
        return $this;
    }

    public function addIdentifier(array $identifierData): self
    {
        // If input is single identifier (doesn't have 0 index)
        if (!isset($identifierData[0])) {
            $identifierData = [$identifierData]; // Convert to array of identifiers
        }

        foreach ($identifierData as $identifier) {
            $this->encounter['identifier'][] = [
                'system' => $identifier['system'],
                'value' => $identifier['value']
            ];
        }

        return $this;
    }

    // Hospitalization methods
    public function withHospitalization(array $dischargeConfig = []): self
    {
        $this->encounter['hospitalization'] = [
            'dischargeDisposition' => [
                'coding' => [[
                    'system' => $dischargeConfig['system'] ?? 'http://terminology.hl7.org/CodeSystem/discharge-disposition',
                    'code' => $dischargeConfig['code'] ?? 'home',
                    'display' => $dischargeConfig['display'] ?? 'Home'
                ]],
                'text' => $dischargeConfig['text'] ?? 'Anjuran dokter untuk pulang dan kontrol kembali'
            ]
        ];
        return $this;
    }

    // Build method
    public function build(): array
    {
        $builtEncounter = $this->encounter;
        $this->reset();
        return $builtEncounter;
    }
}
