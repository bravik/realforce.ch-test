<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Demo;

use RuntimeException;
use Throwable;

/**
 * Parse JSON mock dataset and store in class attributes
 */
class InMemoryDataStorage
{
    /**
     * @var DemoEmployeeDataRow[]
     */
    public array $employeesData = [];
    public array $salaryModificators = [];
    public array $salaryModificatorsToEmployees = [];
    public array $taxModificators = [];
    public array $taxModificatorsToEmployees = [];


    public function __construct(string $datasetDir)
    {
        try {
            $data = json_decode(file_get_contents("$datasetDir/employees.json"), true, 512, JSON_THROW_ON_ERROR);
            foreach ($data as $row) {
                $this->employeesData[$row['id']] = new DemoEmployeeDataRow(
                    $row['id'],
                    $row['name'],
                    $row['age'],
                    $row['rate'],
                    $row['kids'],
                    $row['is_using_company_car']
                );
            }

            $data = json_decode(file_get_contents("$datasetDir/salary-modificators.json"),
                true, 512, JSON_THROW_ON_ERROR);
            foreach ($data as $row) {
                $this->salaryModificators[$row['id']] = $row;
            }

            $data = json_decode(file_get_contents("$datasetDir/tax-modificators.json"),
                true, 512, JSON_THROW_ON_ERROR);
            foreach ($data as $row) {
                $this->taxModificators[$row['id']] = $row;
            }

            $data = json_decode(file_get_contents("$datasetDir/employee__salary-modificators.json"),
                true, 512, JSON_THROW_ON_ERROR);
            foreach ($data as $row) {
                $this->salaryModificatorsToEmployees[] = $row;
            }

            $data = json_decode(file_get_contents("$datasetDir/employee__tax-modificators.json"),
                true, 512, JSON_THROW_ON_ERROR);
            foreach ($data as $row) {
                $this->taxModificatorsToEmployees[] = $row;
            }
        } catch (Throwable $e) {
            throw new RuntimeException("Error reading dataset file : " . $e->getMessage());
        }
    }
}
