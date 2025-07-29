<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/Protocol/ProtocolInterface.php');
require_once(APPPATH . 'modules/satuSehatBridge/repository/Protocol/Http/HttpRequestRepository.php');
require_once(APPPATH . 'modules/satuSehatBridge/repository/Protocol/Http/HttpRequestJSONTypeRepository.php');

class ProtocolFactory
{
    protected $repository;

    public function __construct(ProtocolInterface $repository)
    {
        $this->repository =  $repository;
    }

    public function send(string $url, array $payload = [], array $headers = [], string $method)
    {
        return $this->repository->send($url, $payload, $headers, $method);
    }
}