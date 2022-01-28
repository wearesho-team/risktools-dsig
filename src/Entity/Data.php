<?php

declare(strict_types=1);
namespace Wearesho\RiskTools\Dsig\Entity;
class Data
{
    public string $signTime;
    public bool $isUseTSP;
    public string $issuer;
    public string $issuerName;
    public string $serial;
    public string $owner;
    public User $user;
    public bool $isCorrect;

    public function __construct(
        $signTime,
        $isUseTSP,
        $issuer,
        $issuerName,
        $serial,
        $owner,
        $user,
        $isCorrect
    ) {
        $this->signTime = $signTime;
        $this->isUseTSP = $isUseTSP;
        $this->issuer = $issuer;
        $this->issuerName = $issuerName;
        $this->serial = $serial;
        $this->owner = $owner;
        $this->user = $user;
        $this->isCorrect = $isCorrect;
    }

}