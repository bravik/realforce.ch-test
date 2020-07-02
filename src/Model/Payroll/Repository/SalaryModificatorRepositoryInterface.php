<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Repository;

use App\Model\Payroll\Entity\Id;
use App\Model\Payroll\Entity\SalaryModificator;

interface SalaryModificatorRepositoryInterface
{
    /**
     * @param Id $id
     * @return SalaryModificator[]
     */
    public function findActiveForEmployee(Id $id): array;
}
