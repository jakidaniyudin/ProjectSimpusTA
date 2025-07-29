<?php

interface ProtocolInterface
{
    public function send(string $url, array $payload = [], array $headers = [], string $method);
}
