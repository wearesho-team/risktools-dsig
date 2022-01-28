<?php

declare(strict_types=1);


namespace Wearesho\RiskTools\Dsig;

class Config implements ConfigInterface
{
    protected string $id;
    protected string $callbackUrl;
    protected string $endpoint;
    protected string $password;
    protected string $token;
    protected string $redirectUrl;

    public function __construct(
        string $id,
        string $callbackUrl,
        string $password,
        string $token,
        string $redirectUrl,
        string $endpoint = self::ENDPOINT
    ) {
        $this->id = $id;
        $this->callbackUrl = $callbackUrl;
        $this->endpoint = $endpoint;
        $this->password = $password;
        $this->token = $token;
        $this->redirectUrl = $redirectUrl;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
