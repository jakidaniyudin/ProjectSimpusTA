<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');

class TerminologyDeliveryLocation implements InterfaceTerminologyByStore
{
    public function getTerminology($parameter): array
    {
        return [
            'category' => [
                'system'  => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code'    => 'survey',
                'display' => 'Survey',
            ],
            'code' => [
                [
                    'system'  => 'http://loinc.org',
                    'code'    => '72150-6',
                    'display' => 'Delivery location',
                ]
            ],
            'status' => 'final',
            'valueCodeableConcept' => $this->mapDeliveryLocation($parameter)
        ];
    }

    private function mapDeliveryLocation($parameter): array
    {
        $mapping = [
            'rumah' => [
                'system'  => 'http://snomed.info/sct',
                'code'    => '264362003',
                'display' => 'Home',
            ],
            'polindes' => [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/organization-type',
                'code'    => 'OT000001',
                'display' => 'Polindes',
            ],
            'pustu' => [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/organization-type',
                'code'    => 'OT000002',
                'display' => 'Pustu',
            ],
            'puskesmas' => [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/organization-type',
                'code'    => '102',
                'display' => 'Pusat Kesehatan Masyarakat',
            ],
            'klinik' => [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/organization-type',
                'code'    => '103',
                'display' => 'Klinik',
            ],
            'rumah_bersalin' => [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/organization-type',
                'code'    => 'OT000008',
                'display' => 'Rumah Bersalin',
            ],
            'rsia' => [
                'system'  => 'http://snomed.info/sct',
                'code'    => '82242000',
                'display' => 'Children’s hospital',
            ],
            'rumah_sakit' => [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/organization-type',
                'code'    => '104',
                'display' => 'Rumah Sakit',
            ],
            'rs_odha' => [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/organization-type',
                'code'    => 'OT000003',
                'display' => 'RS ODHA',
            ],
            'bidan_praktek' => [
                'system'  => 'http://terminology.kemkes.go.id/CodeSystem/organization-type',
                'code'    => 'OT000004',
                'display' => 'Bidan Praktek Mandiri',
            ],
        ];

        return $mapping[strtolower($parameter)] ?? [
            'system'  => '',
            'code'    => '',
            'display' => 'Tidak diketahui'
        ];
    }
}
