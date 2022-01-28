<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig;

interface ConfigInterface
{
    public const ENDPOINT = 'dsig.risktools.pro';


    public function getId(): string;

    public function getPassword(): string;

    public function getEndpoint(): string;


    public function getToken(): string;

    /**
     * Вебадреса ПП, на яку буде виконано запит із кодом авторизації (authorization_code) та переадресацію користувача.
     * Адреса фіксована, не повинна містити змінних параметрів.
     */
    public function getCallbackUrl(): string;

    public function getRedirectUrl(): string;

}
