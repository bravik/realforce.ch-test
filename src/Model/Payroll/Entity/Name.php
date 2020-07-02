<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Entity;

use Webmozart\Assert\Assert;


class Name
{
    private string $first;
    private string $last;
    private ?string $middle;

    public function __construct(string $first, string $last, string $middle = null)
    {
        Assert::notEmpty($first);
        Assert::notEmpty($last);

        $this->first = $first;
        $this->middle = $middle;
        $this->last = $last;
    }

    public function first(): string
    {
        return $this->first;
    }

    public function middle(): ?string
    {
        return $this->middle;
    }

    public function last(): string
    {
        return $this->last;
    }

    public function full(): string
    {
        $full = $this->first;
        if ($this->middle) {
            $full .= ' ' . $this->middle;
        }

        return $full . ' ' . $this->last;
    }
}
