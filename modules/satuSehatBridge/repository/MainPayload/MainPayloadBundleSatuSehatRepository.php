<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'modules/satuSehatBridge/interface/MainPayload/InterfaceMainPayload.php');
class MainPayloadBundleSatuSehatRepository implements InterfaceMainPayload
{

    protected $mainPayload;
    public function basePayload(array $entries, array $config = null)
    {
        $this->mainPayload = [
            "resourceType" => "Bundle",
            "type" => "transaction",
            "entry" => $entries
        ];

        return json_encode($this->mainPayload, JSON_PRETTY_PRINT);
    }

    public function setBase(array $payloads): string
    {

        $entries = [];
        foreach ($payloads as $payload) {
            if (is_string($payload)) {
                $decoded = json_decode($payload, true);
                if (json_last_error() == JSON_ERROR_NONE) {
                    $entries[] = $decoded; // <- Sudah benar sekarang
                }
            } else {
                $entries[] = $payload;
            }
        }


        return $this->basePayload($entries);
    }
}