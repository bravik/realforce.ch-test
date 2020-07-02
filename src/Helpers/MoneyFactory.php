<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Helpers;

use Money\Currency;
use Money\Money;

class MoneyFactory
{
    private Currency $defaultCurrency;

    public function __construct(string $defaultCurrency)
    {
        $this->defaultCurrency = new Currency($defaultCurrency);
    }

    public function create($amount, Currency $currency = null): Money
    {
        return new Money($amount, $currency ?? $this->defaultCurrency);
    }
}
