<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Demo\Repository;

use App\Demo\InMemoryDataStorage;
use App\Model\Payroll\Entity\Id;
use App\Model\Payroll\Entity\SalaryModificator;
use App\Model\Payroll\Repository\SalaryModificatorRepositoryInterface;

class SalaryModificatorsDemoRepository implements SalaryModificatorRepositoryInterface
{
    private InMemoryDataStorage $dataStorage;

    public function __construct(InMemoryDataStorage $dataStorage)
    {
        $this->dataStorage = $dataStorage;
    }

    public function findActiveForEmployee(Id $id): array
    {
        $modificators = [];

        foreach ($this->dataStorage->salaryModificatorsToEmployees as $row) {
            if (
                $row['employee_id'] === $id->getValue()
                && isset($this->dataStorage->salaryModificators[$row['modificator_id']])
            ) {
                $modificatorRow = $this->dataStorage->salaryModificators[$row['modificator_id']];
                $modificators[] = new SalaryModificator(
                    $modificatorRow['title'],
                    $modificatorRow['operation'],
                    $modificatorRow['amount']
                );
            }
        }

        return $modificators;
    }
}
