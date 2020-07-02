<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Demo\Repository;

use App\Demo\InMemoryDataStorage;
use App\Model\Payroll\Entity\Id;
use App\Model\Payroll\Entity\TaxModificator;
use App\Model\Payroll\Repository\TaxModificatorRepositoryInterface;

class TaxModificatorDemoRepository implements TaxModificatorRepositoryInterface
{
    private InMemoryDataStorage $dataStorage;

    public function __construct(InMemoryDataStorage $dataStorage)
    {
        $this->dataStorage = $dataStorage;
    }

    public function findActiveForEmployee(Id $id): array
    {
        $modificators = [];

        foreach ($this->dataStorage->taxModificatorsToEmployees as $row) {
            if (
                $row['employee_id'] === $id->getValue()
                && isset($this->dataStorage->taxModificators[$row['modificator_id']])
            ) {
                $modificatorRow = $this->dataStorage->taxModificators[$row['modificator_id']];
                $modificators[] = new TaxModificator(
                    $modificatorRow['title'],
                    $modificatorRow['operation'],
                    $modificatorRow['amount']
                );
            }
        }

        return $modificators;
    }
}
