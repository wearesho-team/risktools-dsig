<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp;
use Wearesho\RiskTools\Dsig\Exception;
use Wearesho\RiskTools\Dsig\Response;

class Decode
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


    public function request(tokenInterface $token, int $documentId): Entity\Data
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

        return $this->createEntity($response, $data);
    }


    protected function createEntity(ResponseInterface $response, array $data): Entity\Data
    {
        $userData = $data['data']['user'];
        $user = new Entity\User(
            $userData['name'],
            $userData['organization'],
            $userData['organizationUnit'],
            $userData['position'],
            $userData['region'],
            $userData['city'],
            $userData['fullName'],
            $userData['address'],
            $userData['phone'],
            $userData['email'],
            $userData['dns'],
            $userData['EDRPOUCode'],
            $userData['DRFOCode'],
        );

        return new Entity\Data(
            $data['data']['signTime'],
            $data['data']['isUseTSP'],
            $data['data']['issuer'],
            $data['data']['issuerName'],
            $data['data']['serial'],
            $data['data']['owner'],
            $user,
            $data['data']['isCorrect'],
        );
    }


    private function getUrl(): string
    {
        return 'https://' . $this->config->getEndpoint() . '/api/v1/sign/get-data';
    }

    private function getAuthHeader(TokenInterface $token): string
    {
        return "Bearer {$token->getAccess()}";
    }

}