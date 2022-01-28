<?php

declare(strict_types=1);
namespace Wearesho\RiskTools\Dsig;

interface TokenInterface
{
    public function getAccess(): string;

    public function getRefresh(): string;

    public function getExpireDate(): \DateTimeInterface;
}
