<?php

interface RequestInterface
{
    public function __construct();
    public function rules();
    public function setDataRequest($request);
    public function setProtocol($request);
}
