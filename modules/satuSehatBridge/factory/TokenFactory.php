<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'modules/satuSehatBridge/interface/Token/TokenInterface.php');
require_once(APPPATH . 'modules/satuSehatBridge/repository/Token/TokenCredetialSatuSehatRepository.php');
class TokenFactory
{
    protected $repository;

    public function __construct(TokenInteface $repository)
    {
        $this->repository =  $repository;
    }

    public function getPayload($credetial)
    {
        return $this->repository->getPayload($credetial);
    }
}
