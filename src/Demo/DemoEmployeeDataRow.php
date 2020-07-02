<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Demo;

class DemoEmployeeDataRow
{
    public string $id;
    public string $name;
    public int $age;
    public float $rate;
    public int $kidsCount;
    public bool $isUsingCompanyCar;

    public function __construct(
        string $id,
        string $name,
        int $age,
        float $rate,
        int $kidsCount,
        bool $isUsingCompanyCar
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->rate = $rate;
        $this->kidsCount = $kidsCount;
        $this->isUsingCompanyCar = $isUsingCompanyCar;
    }
}
