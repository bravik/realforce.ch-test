<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Demo\Repository;

use App\Model\Payroll\Repository\TaxRepositoryInterface;

/**
 * Mock with constant tax for all countries
 */
class TaxDemoRepository implements TaxRepositoryInterface
{

    public function getForCountryCode(string $code): float
    {
        return 0.2;
    }
}
