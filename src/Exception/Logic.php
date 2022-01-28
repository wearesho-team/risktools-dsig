<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig\Exception;

use Psr\Http\Message\ResponseInterface;

class Logic extends BadResponse
{
    protected string $rawCode;

    protected string $description;

    public function __construct(
        string $code,
        string $description,
        ResponseInterface $response
    ) {
        $this->rawCode = $code;
        $this->description = $description;

        $message = "Logic Error ({$code}): {$description}.";
        $code = (int)preg_replace('/[^\d]/', '', $code);

        parent::__construct($message, $code, $response);
    }

    public function getRawCode(): string
    {
        return $this->rawCode;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
