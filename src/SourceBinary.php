<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig;

class SourceBinary
{
    public string $data;
    public array $keys;
    public bool $external;

    public function __construct(string $data, array $keys, bool $external)
    {
        $this->data = $data;
        $this->keys = $keys;
        $this->external = $external;
    }

    public function toArray(): array
    {
        $keys = [
            'token' => $this->keys['token'],
        ];
        if (array_key_exists('password', $this->keys)) {
            $keys = array_merge($keys, ['password' => $this->keys['password']]);
        }
        return [
            'data' => $this->data,
            'keys' => $keys,
            'external' => $this->external,
        ];
    }
}