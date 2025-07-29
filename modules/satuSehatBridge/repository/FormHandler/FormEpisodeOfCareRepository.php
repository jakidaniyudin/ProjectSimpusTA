<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once (APPPATH . 'modules/satuSehatBridge/interface/InterfaceForm.php');
require_once (APPPATH . 'modules/satuSehatBridge/factory/SetupFactory.php');
class FormEpisodeOfCareRepository implements InterfaceForm {
    public function handle($data, $uuidEcounter, $patientId, $patientName) {
        if (empty($data)) {
            return [];
        }
        $setUpPayload = new SetupFactory();
        $payload = $setUpPayload->setUpManajemen('episode_of_care')->setUp('episode_of_care', $data, $uuidEcounter, $patientId, $patientName);
        return [
            $payload
        ];
    }
}