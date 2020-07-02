<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Tests\Functional\Model\Payroll\Service;

use App\Model\Payroll\Entity\BillingPeriod;
use App\Model\Payroll\Entity\Id;
use App\Model\Payroll\Service\EarningsCalculator\EarningsCalculator;
use App\Model\Payroll\Service\EarningsCalculator\Query;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Theses test doesn't make much sense
 * because salary modificators are dynamic (e.g. created by system userss)
 * Still I'll keep it here
 */
class EarningsCalculatorTest extends KernelTestCase
{
    private $earningsCalculator;

    protected function setUp()
    {
        self::bootKernel();
        $this->earningsCalculator = self::$container->get(EarningsCalculator::class);
    }


    public function testAutowiring()
    {
        $this->assertInstanceOf(EarningsCalculator::class, $this->earningsCalculator);
    }


    public function testBasicSalaryWithNoBonuses(): void
    {
        $query = new Query();
        $query->employeeId = new Id("basic");
        $query->billingPeriod = new BillingPeriod(2020, 1);

        $salary = $this->earningsCalculator->getNetSalary($query);

        $this->assertEquals(800, $salary->getAmount());
    }

    public function testWithKidsTaxReduction(): void
    {
        $query = new Query();
        $query->employeeId = new Id("with-kids-bonus");
        $query->billingPeriod = new BillingPeriod(2020, 1);

        $salary = $this->earningsCalculator->getNetSalary($query);

        $this->assertEquals(4920, $salary->getAmount());
    }

    public function testAgeBonus(): void
    {
        $query = new Query();
        $query->employeeId = new Id("aged");
        $query->billingPeriod = new BillingPeriod(2020, 1);

        $salary = $this->earningsCalculator->getNetSalary($query);

        $this->assertEquals(3424, $salary->getAmount());
    }

    public function testWithCar(): void
    {
        $query = new Query();
        $query->employeeId = new Id("with-car");
        $query->billingPeriod = new BillingPeriod(2020, 1);

        $salary = $this->earningsCalculator->getNetSalary($query);

        $this->assertEquals(2800, $salary->getAmount());
    }
}
