<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Repository;

interface TaxRepositoryInterface
{
    public function getForCountryCode(string $code): float;
}
