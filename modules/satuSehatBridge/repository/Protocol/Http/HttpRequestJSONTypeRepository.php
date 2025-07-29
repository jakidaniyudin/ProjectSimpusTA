<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'modules/satuSehatBridge/interface/Protocol/ProtocolInterface.php');

class HttpRequestJSONTypeRepository implements ProtocolInterface
{
    protected $curl;

    public function __construct()
    {
        $this->curl =  curl_init();
    }

    public function send(string $url, array $payload = [], array $headers = [], string $method)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        if (strtoupper($method) === 'POST') {
            curl_setopt($this->curl, CURLOPT_POST, true);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($payload));

            // Pastikan header berisi Content-Type: application/json
            $headers[] = 'Content-Type: application/json';
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        } elseif (!empty($headers)) {
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($this->curl);
        curl_close($this->curl);

        return json_decode($response, true);
    }

}