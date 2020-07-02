<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Service\EarningsCalculator;

use App\Model\Payroll\Entity\BillingPeriod;
use App\Model\Payroll\Entity\Id;

class Query
{
    public Id $employeeId;

    public BillingPeriod $billingPeriod;
}
