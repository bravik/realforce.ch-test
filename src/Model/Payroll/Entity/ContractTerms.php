<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Entity;

use DateTimeImmutable;
use Money\Money;

class ContractTerms
{
    private Money $rate;
    private Money $overtimeRate;

    private DateTimeImmutable $effectiveFrom;
    private DateTimeImmutable $effectiveTill;

    public function __construct(
        Money $rate,
        Money $overtimeRate,
        DateTimeImmutable $effectiveFrom,
        DateTimeImmutable $effectiveTill
    ) {
        $this->rate = $rate;
        $this->overtimeRate = $overtimeRate;
        $this->effectiveFrom = $effectiveFrom;
        $this->effectiveTill = $effectiveTill;
    }


    public function getRate(): Money
    {
        return $this->rate;
    }

    public function getOvertimeRate(): Money
    {
        return $this->overtimeRate;
    }

    public function getEffectiveFrom(): DateTimeImmutable
    {
        return $this->effectiveFrom;
    }

    public function getEffectiveTill(): DateTimeImmutable
    {
        return $this->effectiveTill;
    }
}
