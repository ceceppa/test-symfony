<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Calculator.php';

use Utils\Calculator\Calculator;

class CalculatorTest extends TestCase
{
    public function test_should_throw_error_if_operand_is_invalid()
    {
        try {
            $calculator = new Calculator(1, '', 2);
        } catch (\Exception $e) {
            $this->assertTrue($e->getMessage() == 'Invalid operand');
        }
    }

    public function test_8_plus_4_should_be_12()
    {
        $calculator = new Calculator(8, '+', 4);
        $this->assertTrue($calculator->getResult() == 12);
    }

    public function test_9_minus_4_should_be_5()
    {
        $calculator = new Calculator(9, '-', 4);
        $this->assertTrue($calculator->getResult() == 5);
    }

    public function test_should_throw_an_exception_if_dividing_by_zero()
    {
        try {
            $calculator = new Calculator(9, '/', 0);
            $calculator->getResult();
        } catch(\Exception $e) {
            $this->assertTrue($e->getMessage() == 'Division by zero');
        }
    }

    public function test_10_divided_2_should_be_5()
    {
        $calculator = new Calculator(10, '/', 2);
        $this->assertTrue($calculator->getResult() == 5);
    }

    public function test_10_multiplied_2_should_be_20()
    {
        $calculator = new Calculator(10, '*', 2);
        $this->assertTrue($calculator->getResult() == 20);
    }
}
