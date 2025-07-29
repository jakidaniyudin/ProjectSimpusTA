<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/MainPayload/InterfaceMainPayload.php');
require_once(APPPATH . 'modules/satuSehatBridge/repository/MainPayload/MainPayloadBundleSatuSehatRepository.php');


class MainPayloadFactory
{
    protected $repository;
    public function __construct(InterfaceMainPayload $repository)
    {
        $this->repository =  $repository;
    }

    public function setBase(array $payloads)
    {
        return $this->repository->setBase($payloads);
    }
}