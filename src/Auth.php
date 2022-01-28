<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig;

use GuzzleHttp;

class Auth
{
    protected ConfigInterface $config;


    protected GuzzleHttp\ClientInterface $client;
    protected Response\ParserInterface $parser;
    /** @param Source[] $sourceList */
    protected array $sourceList;

    public function __construct(
        ConfigInterface $config,
        GuzzleHttp\ClientInterface $client
    ) {
        $this->config = $config;
        $this->client = $client;
    }


    public function request(string $idgov): bool
    {
        try {
            $this->client->request(
                'post',
                $this->getUrl(),
                [
                    GuzzleHttp\RequestOptions::HEADERS => [
                        'Content-Type' => $this->parser->accept(),
                    ],
                    GuzzleHttp\RequestOptions::JSON =>
                        [
                            "token" => $this->config->getToken(),
                            "unique_id" => $this->config->getId(),
                            "hash" => $this->getHash(),
                            "redirect_url" => $this->config->getRedirectUrl(),
                            "callback_url" => $this->config->getCallbackUrl(),
                            "auth_type" => [
                                "idgov" => $idgov,
                            ]
                        ],
                    GuzzleHttp\RequestOptions::HTTP_ERRORS => false,
                ]
            );
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
            throw new Exception\Transfer("Network Error", 0, $e);
        }

        return true;
    }

    private function getUrl(): string
    {
        return 'https://' . $this->config->getEndpoint() . '/auth/init/';
    }

    private function getHash(): string
    {
        return sha1(
            $this->config->getId() . $this->config->getToken() . md5($this->config->getPassword())
        );
    }
}