<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Entity;

use DomainException;
use Webmozart\Assert\Assert;

/**
 * Bonuses/Deductions for tax
 * Each modificator represent additive (delta) bonus or deduction on base tax
 * Positive amount is a bonus, negative is a deduction
 */
class TaxModificator
{
    public const OPERATION__FIXED_VALUE = 'fixed';

    private string $title;
    private string $operation;
    private float $amount;


    public function __construct(string $title, string $operation, float $amount)
    {
        Assert::inArray($operation, [self::OPERATION__FIXED_VALUE]);

        $this->title = $title;
        $this->operation = $operation;
        $this->amount = $amount;
    }

    /**
     * @param float $baseTax
     * @return float Delta based on $baseTax
     */
    public function apply(float $baseTax): float
    {
        $delta = null;

        switch ($this->operation) {
            case self::OPERATION__FIXED_VALUE:
                $delta = $this->amount;
                break;
            //@todo other operations
            default:
                throw new DomainException("Unsupported operation");
        }

        return $this->amount;
    }
}
