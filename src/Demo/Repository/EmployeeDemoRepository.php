<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Demo\Repository;

use App\Demo\DemoEmployeeDataRow;
use App\Demo\InMemoryDataStorage;
use App\Model\Payroll\Entity\Employee;
use App\Model\Payroll\Entity\Id;
use App\Model\Payroll\Entity\Name;
use App\Model\Payroll\Exception\NotFoundException;
use App\Model\Payroll\Repository\EmployeeRepositoryInterface;

class EmployeeDemoRepository implements EmployeeRepositoryInterface
{
    private InMemoryDataStorage $dataStorage;

    public function __construct(InMemoryDataStorage $dataStorage)
    {
        $this->dataStorage = $dataStorage;
    }

    public function findAll(): array
    {
        if (empty($this->dataStorage->employeesData)) {
            return [];
        }

        $employees = [];

        foreach ($this->dataStorage->employeesData as $row) {
            $employees[] = $this->createEmployeeFromRow($row);
        }

        return $employees;
    }


    public function getById(Id $id): Employee
    {
        if (!isset($this->dataStorage->employeesData[$id->getValue()])) {
            throw new NotFoundException();
        }

        return $this->createEmployeeFromRow(
            $this->dataStorage->employeesData[$id->getValue()]
        );
    }

    private function createEmployeeFromRow(DemoEmployeeDataRow $row): Employee
    {
        $employee = new Employee(
            new Id($row->id),
            new Name($row->name, 'Naumenko') // @todo Surname is not important
        );
        $employee->setAge($row->age);
        $employee->setKids($row->kidsCount);
        $employee->setIsUsingCompanyCar($row->isUsingCompanyCar);

        return $employee;
    }
}
