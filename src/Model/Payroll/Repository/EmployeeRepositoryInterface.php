<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Repository;

use App\Model\Payroll\Entity\Employee;
use App\Model\Payroll\Entity\Id;

interface EmployeeRepositoryInterface
{
    /**
     * @return Employee[]
     */
    public function findAll(): array;

    public function getById(Id $id): Employee;
}