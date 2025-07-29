<?php

interface ResponseInterface
{
    public function sendMessage($type, $message, $data = null);
}
