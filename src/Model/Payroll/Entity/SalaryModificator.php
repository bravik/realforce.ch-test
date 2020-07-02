<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Entity;

use DomainException;
use Money\Money;
use Webmozart\Assert\Assert;

/**
 * Bonuses/Deductions for salary
 * Each modificator represent additive (delta) bonus or deduction on base salary
 * Positive amount is a bonus, negative is a deduction
 */
class SalaryModificator
{
    public const OPERATION__FIXED_VALUE = 'fixed';
    public const OPERATION__PERCENT = 'percent';

    private string $title;
    private string $operation;
    private float $amount;


    public function __construct(string $title, string $operation, float $amount)
    {
        Assert::inArray($operation, [self::OPERATION__FIXED_VALUE, self::OPERATION__PERCENT]);

        $this->title = $title;
        $this->operation = $operation;
        $this->amount = $amount;
    }

    public function apply(Money $baseSalary): Money
    {
        $delta = null;

        switch ($this->operation) {
            case self::OPERATION__FIXED_VALUE:
                $delta = new Money($this->amount, $baseSalary->getCurrency());
                break;
            case self::OPERATION__PERCENT:
                $delta = $baseSalary->multiply($this->amount / 100);
                break;
            default:
                throw new DomainException("Unsupported operation");
        }

        return $delta;
    }
}
