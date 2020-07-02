<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Entity;

/**
 * Represents employee profile
 */
class Employee
{
    private Id $id;

    private Name $name;

    private ?int $kids = null;
    private ?int $age = null;
    private ?bool $isUsingCompanyCar = null;

    public function __construct(Id $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getKids(): ?int
    {
        return $this->kids;
    }

    public function setKids(?int $kids): self
    {
        $this->kids = $kids;
        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;
        return $this;
    }

    public function isUsingCompanyCar(): ?bool
    {
        return $this->isUsingCompanyCar;
    }

    public function setIsUsingCompanyCar(?bool $isUsingCompanyCar): self
    {
        $this->isUsingCompanyCar = $isUsingCompanyCar;
        return $this;
    }

    /**
     * Mock method with constant country code instead of Country object
     */
    public function getCountry(): string
    {
        return 'us';
    }
}
