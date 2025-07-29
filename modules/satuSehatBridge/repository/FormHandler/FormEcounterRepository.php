<?php 

require_once (APPPATH . 'modules/satuSehatBridge/interface/InterfaceForm.php');
require_once (APPPATH . 'modules/satuSehatBridge/factory/SetupFactory.php');
class FormEcounterRepository implements InterfaceForm {
    public function handle($data) {
        if (empty($data)) {
            return [];
        }
        $setUpPayload = new SetupFactory();
        $payload = $setUpPayload->setUpManajemen('encounter')->setUp('encounter', $data, $data['uuidEcounter'], $data['patientId'], $data['$patientName']);
        return [
            $payload
        ];
    }
}