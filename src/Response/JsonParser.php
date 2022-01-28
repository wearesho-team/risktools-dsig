<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig\Response;

use Wearesho\RiskTools\Dsig;
use Psr\Http\Message\ResponseInterface;

class JsonParser implements ParserInterface
{
    /**
     * @param ResponseInterface $response
     * @return array
     * @throws Dsig\Exception\BadResponse
     */
    public function parse(ResponseInterface $response): array
    {
        $body = $response->getBody()->__toString();
        try {
            $data = json_decode($body, true, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new Dsig\Exception\Parse($e->getMessage(), $e->getCode(), $response, $e->getPrevious());
        }

        if ($response->getStatusCode() === 200) {
            if (!array_key_exists('error', $data)) {
                return $data;
            }

            throw new Dsig\Exception\Logic(
                $data['code'] ?? '0',
                $data['error_description'] ?? "Unknown Error",
                $response
            );
        }

        throw new Dsig\Exception\Tech(
            $data['error'] ?? 'unknown',
            $data['error_description'] ?? 'Missing error description',
            $response
        );
    }

    public function accept(): string
    {
        return 'application/json';
    }
}
