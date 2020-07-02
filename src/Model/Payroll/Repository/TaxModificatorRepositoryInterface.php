<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Repository;

use App\Model\Payroll\Entity\Id;
use App\Model\Payroll\Entity\TaxModificator;

interface TaxModificatorRepositoryInterface
{
    /**
     * @param Id $id
     * @return TaxModificator[]
     */
    public function findActiveForEmployee(Id $id): array;
}
