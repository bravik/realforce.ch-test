<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Entity;

use DateTimeImmutable;

/**
 * Represents tax modificator assignment to employee
 */
class EmployeeTaxModificator
{
    private string $employeeId;
    private string $modificatorId;
    private DateTimeImmutable $effectiveFrom;
    private ?DateTimeImmutable $effectiveTill;

    public function __construct(
        string $employeeId,
        string $modificatorId,
        DateTimeImmutable $effectiveFrom,
        DateTimeImmutable $effectiveTill = null
    ) {
        $this->employeeId = $employeeId;
        $this->modificatorId = $modificatorId;
        $this->effectiveFrom = $effectiveFrom;
        $this->effectiveTill = $effectiveTill;
    }

    public function getEmployeeId(): string
    {
        return $this->employeeId;
    }

    public function getModificatorId(): string
    {
        return $this->modificatorId;
    }

    public function getEffectiveFrom(): DateTimeImmutable
    {
        return $this->effectiveFrom;
    }

    public function getEffectiveTill(): ?DateTimeImmutable
    {
        return $this->effectiveTill;
    }
}
