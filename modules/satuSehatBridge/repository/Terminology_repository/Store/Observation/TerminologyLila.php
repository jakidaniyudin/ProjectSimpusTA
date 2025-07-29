<?php 


require_once(APPPATH . 'modules/satuSehatBridge/interface/Terminology/InterfaceTerminologyByStore.php');
class TerminologyLila implements InterfaceTerminologyByStore {
    public function getTerminology($parameter): array{
        $interpretation = [];
        

        if(!isset($parameter['value'])) {
            throw new ServiceException('Parameter "value" tidak ada pada Lila', 400);
        }elseif(!is_numeric($parameter['value'])) {
            throw new ServiceException('Parameter "value" harus berupa string pada Lila', 400);
        }

        if($parameter['value'] < 10 || $parameter['value'] >  35){
            throw new ServiceException('Parameter "value" tidak sesuai pada Lila tidak boleh < 10 cm atau > 35 cm', 400);
        }else if($parameter['value']  < 23 ){
            $interpretation = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => 'OI000018',
                'display' => 'Kurang Energi Kronis (KEK)'
            ];
        }else if ($parameter['value'] >=  23 && $parameter['value'] < 23.5){
            $interpretation = [
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/clinical-term',
                'code' => 'OI000035',
                'display' => 'Risiko Kurang Energi Kronis (KEK)'
            ];
        }else {
            $interpretation = [
                'system' => 'http://terminology.hl7.org/CodeSystem/v3-ObservationInterpretation',
                'code' => 'N',
                'display' => 'Normal'
            ];
        }

    
       return [
            'category' => [
                'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                'code' => 'exam',
                'display' => 'Exam',
            ],
            'code' => [
                [
                    'system' => 'http://snomed.info/sct',
                    'code' =>  '284473002',
                    'display' => 'Mid upper arm circumference',
                ],
                [
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/anc-custom-codes',
                    'code' => 'ANC.SS.DE3',
                    'display' => 'Lingkar Lengan Atas (LILA)',
                ]
                ],
            'status' =>  'final',
            'withQuantityValue' => [
                'value' => (float) $parameter['value'] ?? 0.0,
                'unit' => 'cm',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'cm'
            ],
            'interpretation' =>  $interpretation
            ];
    }
}