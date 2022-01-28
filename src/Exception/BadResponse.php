<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig\Exception;

use Psr\Http\Message\ResponseInterface;


class BadResponse extends \Exception implements Exception
{
    protected ResponseInterface $response;

    public function __construct(
        string $message,
        int $code,
        ResponseInterface $response,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
