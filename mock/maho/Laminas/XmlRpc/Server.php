<?php

namespace Laminas\XmlRpc;

class Server
{
    public function handle(Request|bool $request = false): Response|Fault
    {
    }

    public function setEncoding(string $encoding): Server
    {
    }

    public function setClass(string|object $class, string $namespace = '', mixed $argv = null): void
    {
    }
}
