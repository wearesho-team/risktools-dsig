<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig;

use GuzzleHttp;

class SignBinary
{
    protected ConfigInterface $config;
    protected GuzzleHttp\ClientInterface $client;
    protected Response\ParserInterface $parser;
    /** @param SourceBinary[] $sourceList */
    protected array $sourceList;

    public function __construct(
        ConfigInterface $config,
        GuzzleHttp\ClientInterface $client
    ) {
        $this->config = $config;
        $this->client = $client;
    }


    public function request(): array
    {
        try {
            $response = $this->client->request(
                'post',
                $this->getUrl(),
                [
                    GuzzleHttp\RequestOptions::HEADERS => [
                        'Content-Type' => $this->parser->accept(),
                    ],
                    GuzzleHttp\RequestOptions::JSON =>
                        [
                            "sources" => array_map(fn($src) => $src->toArray(), $this->sourceList),
                        ],
                    GuzzleHttp\RequestOptions::HTTP_ERRORS => false,
                ]
            );
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
            throw new Exception\Transfer("Network Error", 0, $e);
        }
        return $this->parser->parse($response)['data'];
    }

    private function getUrl(): string
    {
        return 'https://' . $this->config->getEndpoint() . '/api/v1/sign/create';
    }

    private function getHash(): string
    {
        return sha1(
            $this->config->getId() . $this->config->getToken() . md5($this->config->getPassword()) . implode(
                '',
                []
            )
        );
    }
}