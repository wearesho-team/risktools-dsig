<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig;

use GuzzleHttp;
use Psr\Http\Message\ResponseInterface;
use Wearesho\RiskTools\Dsig\Exception;
use Wearesho\RiskTools\Dsig\Response;
class GetFile
{
    protected ConfigInterface $config;
    protected Response\ParserInterface $parser;
    protected GuzzleHttp\ClientInterface $client;

    public function __construct(
        ConfigInterface $config,
        GuzzleHttp\ClientInterface $client
    ) {
        $this->config = $config;
        $this->client = $client;
    }


    public function request(tokenInterface $token, int $documentId): array
    {
        if ($token->getExpireDate() < date_create()) {
            throw new \InvalidArgumentException("Token is expired.");
        }

        try {
            $response = $this->client->request(
                'post',
                $this->getUrl(),
                [
                    GuzzleHttp\RequestOptions::HEADERS => [
                        'Content-Type' => $this->parser->accept(),
                        'Authorization' => $this->getAuthHeader($token),
                    ],
                    GuzzleHttp\RequestOptions::JSON =>
                        [
                            "unique_id" => $documentId,
                        ],
                    GuzzleHttp\RequestOptions::HTTP_ERRORS => false,
                ]
            );
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
            throw new Exception\Transfer("Network Error", 0, $e);
        }

        $data = $this->parser->parse($response);

        return $data;
    }



    private function getUrl(): string
    {
        return 'https://' . $this->config->getEndpoint() . ' /api/v1/sign/get-file';
    }

    private function getAuthHeader(TokenInterface $token): string
    {
        return "Bearer {$token->getAccess()}";
    }

}