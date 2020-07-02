<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Repository;

use App\Model\Payroll\Entity\ContractTerms;
use App\Model\Payroll\Entity\Id;

interface ContractTermsRepositoryInterface
{
    public function getCurrentTermsForEmployee(Id $id): ContractTerms;
}