<?php
namespace Utils\Calculator;

class Calculator
{
    private $number1;
    private $number2;
    private $operand;

    function __construct(float $number1, string $operand, float $number2)
    {
        $this->validateOperandOrFail($operand);

        $this->number1 = $number1;
        $this->operand = $operand;
        $this->number2 = $number2;
    }

    function getResult() : float
    {
        $operand_to_fn_mapping = [
          '+' => 'add',
          '-' => 'subtract',
          '*' => 'multiply',
          '/' => 'divide',
        ];

        $function = $operand_to_fn_mapping[$this->operand];

        return $this->{$function}($this->number1, $this->number2);
    }

    function validateOperandOrFail(string $operand) : void
    {
        $valid_operands= ['+','-','*','/'];
        $is_valid = in_array($operand, $valid_operands);

        if (!$is_valid) {
            throw new \Exception('Invalid operand');
        }
    }

    function add(float $number1, float $number2) : float
    {
        return $number1 + $number2;
    }

    function subtract(float $number1, float $number2) : float
    {
        return $number1 - $number2;
    }

    function divide(float $number1, float $number2) : float
    {
        if ($number2 == 0) {
            throw new \Exception('Division by zero');
        }

        return $number1 / $number2;
    }

    function multiply(float $number1, float $number2) : float
    {
        return $number1 * $number2;
    }
}