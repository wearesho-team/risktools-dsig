<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig;

class Source
{
    public string $data;
    public string $fileName;
    public bool $merchantSign;

    public function __construct(string $data, string $fileName, bool $merchantSign)
    {
        $this->data = $data;
        $this->fileName = $fileName;
        $this->merchantSign = $merchantSign;
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'fileName' => $this->fileName,
            'merchantSign' => $this->merchantSign,
        ];
    }
}