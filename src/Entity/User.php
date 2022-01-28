<?php

declare(strict_types=1);

namespace Wearesho\RiskTools\Dsig\Entity;

class User
{
    public string $name;
    public string $organization;
    public string $organizationUnit;
    public string $position;
    public string $region;
    public string $city;
    public string $fullName;
    public string $address;
    public string $phone;
    public string $email;
    public string $dns;
    public string $EDRPOUCode;
    public string $DRFOCode;

    public function __construct(
        $name,
        $organization,
        $organizationUnit,
        $position,
        $region,
        $city,
        $fullName,
        $address,
        $phone,
        $email,
        $dns,
        $EDRPOUCode,
        $DRFOCode
    ) {
        $this->name = $name;
        $this->organization = $organization;
        $this->organizationUnit = $organizationUnit;
        $this->position = $position;
        $this->region = $region;
        $this->city = $city;
        $this->fullName = $fullName;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->dns = $dns;
        $this->EDRPOUCode = $EDRPOUCode;
        $this->DRFOCode = $DRFOCode;
    }


}