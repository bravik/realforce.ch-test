<?php

/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Demo\Command;

use App\Model\Payroll\Entity\BillingPeriod;
use App\Model\Payroll\Repository\EmployeeRepositoryInterface;
use App\Model\Payroll\Service\EarningsCalculator\EarningsCalculator;
use App\Model\Payroll\Service\EarningsCalculator\Query;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class SalaryReport extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:salary-report';

    private EmployeeRepositoryInterface $employeeRepository;
    private EarningsCalculator $earningsCalculator;

    public function __construct(EmployeeRepositoryInterface $employeeRepository, EarningsCalculator $earningsCalculator)
    {
        parent::__construct();
        $this->employeeRepository = $employeeRepository;
        $this->earningsCalculator = $earningsCalculator;
    }


    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("SALARY REPORT for 07/2020");
        $output->writeln("--------------------------");


        $employees = $this->employeeRepository->findAll();

        foreach ($employees as $employee) {
            $netSalaryQuery = new Query();
            $netSalaryQuery->employeeId = $employee->getId();
            $netSalaryQuery->billingPeriod = new BillingPeriod(2020, 07);

            try {
                $netSalary = $this->earningsCalculator->getNetSalary($netSalaryQuery);
            } catch (Throwable $e) {
                throw new RuntimeException("There was an error while calculating net Salary");
            }

            $line = "{$employee->getName()->first()} is {$employee->getAge()} years old";

            if ($employee->getKids() > 0) {
                $line .= ", has {$employee->getKids()} kids";
            } else {
                $line .= ", has no kids";
            }

            if ($employee->isUsingCompanyCar()) {
                $line .= ", uses company car";
            }

            $line .= " and his/her salary is {$netSalary->getAmount()}";

            $output->writeln($line);
        }

        $output->writeln("--------------------------");

        return Command::SUCCESS;
    }
}
