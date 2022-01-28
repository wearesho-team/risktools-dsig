<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig\Response;

use Psr\Http\Message\ResponseInterface;


interface ParserInterface
{
    /**
     * Content-type acceptable by parser.
     * Should be used in `Accept` header.
     */
    public function accept(): string;

    /**
     * Parses and validated response
     * or throws bad response exception.
     *
     * @throws Wearesho\RiskTools\Dsig\Exception\BadResponse
     */
    public function parse(ResponseInterface $response): array;
}
