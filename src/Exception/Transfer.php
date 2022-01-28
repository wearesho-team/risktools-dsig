<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig\Exception;
use GuzzleHttp;

/**
 * Class Transfer
 * It should be thrown when no response received.
 *
 * @method GuzzleHttp\Exception\GuzzleException|null getPrevious()
 */
class Transfer extends \Exception implements Exception
{
    public function __construct(
        string $message = "",
        int $code = 0,
        GuzzleHttp\Exception\GuzzleException $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
