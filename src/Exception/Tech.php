<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig\Exception;

use Psr\Http\Message\ResponseInterface;

class Tech extends BadResponse
{
    public function __construct(
        string $error,
        string $description,
        ResponseInterface $response
    ) {
        parent::__construct("Technical Error ({$error}): $description", 0, $response);
    }
}
