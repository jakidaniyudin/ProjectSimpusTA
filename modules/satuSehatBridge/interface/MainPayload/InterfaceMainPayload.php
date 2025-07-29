<?php

interface InterfaceMainPayload
{
    public function basePayload(array $entris, array $config);
    public function setBase(array $payload): string;
}