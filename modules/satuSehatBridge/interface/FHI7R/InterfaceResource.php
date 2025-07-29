<?php


interface InterfaceResource
{
    public function reset(): self;
    public function build(): array;
    public function validate(): void;
}