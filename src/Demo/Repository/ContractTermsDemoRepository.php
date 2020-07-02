<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Demo\Repository;

use App\Demo\InMemoryDataStorage;
use App\Helpers\MoneyFactory;
use App\Model\Payroll\Entity\ContractTerms;
use App\Model\Payroll\Entity\Id;
use App\Model\Payroll\Exception\NotFoundException;
use App\Model\Payroll\Repository\ContractTermsRepositoryInterface;
use DateTimeImmutable;

class ContractTermsDemoRepository implements ContractTermsRepositoryInterface
{
    private InMemoryDataStorage $dataStorage;
    private MoneyFactory $moneyFactory;

    public function __construct(InMemoryDataStorage $dataStorage, MoneyFactory $moneyFactory)
    {
        $this->dataStorage = $dataStorage;
        $this->moneyFactory = $moneyFactory;
    }

    public function getCurrentTermsForEmployee(Id $id): ContractTerms
    {
        if (!isset($this->dataStorage->employeesData[$id->getValue()])) {
            throw new NotFoundException();
        }

        $dataRow = $this->dataStorage->employeesData[$id->getValue()];

        return new ContractTerms(
            $this->moneyFactory->create($dataRow->rate),
            $this->moneyFactory->create($dataRow->rate),
            new DateTimeImmutable('2019-06-30 00:00:00'),
            new DateTimeImmutable('2021-06-30 00:00:00'),
        );
    }
}
