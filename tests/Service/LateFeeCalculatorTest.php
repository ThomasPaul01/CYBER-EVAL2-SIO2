<?php
// tests/Service/LateFeeCalculatorTest.php
namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\LateFeeCalculator;

class LateFeeCalculatorTest extends TestCase
{
    public function testCalculateLateFeeWith3Days(): void
    {
        $calculator = new LateFeeCalculator();
        $dueDate = new \DateTime('2024-01-01');
        $returnDate = new \DateTime('2024-01-04');

        $this->assertEquals(1.5, $calculator->calculateLateFee($dueDate, $returnDate));
    }
    public function testCalculateLateFeeBeforeDate(): void
    {
        $calculator = new LateFeeCalculator();
        $dueDate = new \DateTime('2024-01-01');
        $returnDate = new \DateTime('2023-01-01');

        $this->assertEquals(0, $calculator->calculateLateFee($dueDate, $returnDate));
    }
    public function testCalculateLateFeeSameDay(): void
    {
        $calculator = new LateFeeCalculator();
        $dueDate = new \DateTime('2024-01-01');
        $returnDate = new \DateTime('2024-01-01');

        $this->assertEquals(0, $calculator->calculateLateFee($dueDate, $returnDate));
    }

}