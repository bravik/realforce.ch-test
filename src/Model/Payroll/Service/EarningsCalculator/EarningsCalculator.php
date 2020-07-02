<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Model\Payroll\Service\EarningsCalculator;

use App\Model\Payroll\Repository\SalaryModificatorRepositoryInterface;
use App\Model\Payroll\Repository\TaxModificatorRepositoryInterface;
use App\Model\Payroll\Repository\ContractTermsRepositoryInterface;
use App\Model\Payroll\Repository\EmployeeRepositoryInterface;
use App\Model\Payroll\Repository\TaxRepositoryInterface;
use Money\Money;

class EarningsCalculator
{
    private EmployeeRepositoryInterface $employeeRepository;
    private ContractTermsRepositoryInterface $contractTermsRepository;
    private SalaryModificatorRepositoryInterface $salaryModificatorRepository;
    private TaxModificatorRepositoryInterface $taxModificatorRepository;
    private TaxRepositoryInterface $taxRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        ContractTermsRepositoryInterface $contractTermsRepository,
        SalaryModificatorRepositoryInterface $salaryModificatorRepository,
        TaxModificatorRepositoryInterface $taxModificatorRepository,
        TaxRepositoryInterface $taxRepository
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->contractTermsRepository = $contractTermsRepository;
        $this->salaryModificatorRepository = $salaryModificatorRepository;
        $this->taxModificatorRepository = $taxModificatorRepository;
        $this->taxRepository = $taxRepository;
    }


    public function getNetSalary(Query $query): Money
    {
        $employee = $this->employeeRepository->getById($query->employeeId);
        $terms = $this->contractTermsRepository->getCurrentTermsForEmployee($query->employeeId);

        $baseRate = $terms->getRate();
        $baseTax = $this->taxRepository->getForCountryCode($employee->getCountry());

        // @todo Adjust baseRate based on work records (absent days, overtime, e.t.c.
        // Out of scope for demo

        $salary = $baseRate;
        $tax = $baseTax;

        // Apply salary modificators
        $contractSalaryOptions = $this->salaryModificatorRepository->findActiveForEmployee($employee->getId());

        foreach ($contractSalaryOptions as $modificator) {
            $salary = $salary->add(
                $modificator->apply($baseRate)
            );
        }

        // Apply tax modificators
        $taxModificators = $this->taxModificatorRepository->findActiveForEmployee($employee->getId());

        foreach ($taxModificators as $modificator) {
            $tax += $modificator->apply($baseTax);
        }

        // @todo Apply manual adjustments by accountant
        // Out of scope for demo

        return $salary->multiply(1 - $tax);
    }
}
