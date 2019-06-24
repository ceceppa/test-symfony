<?php

namespace App\Controller;

require_once __DIR__ . '../../Calculator.php';

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Utils\Calculator\Calculator;

class CalculatorController extends AbstractController
{
    /**
     * @Route("/calculator", name="calculator")
     */
    public function index()
    {
        return $this->render(
            'calculator/calculator.twig', [
                'controller_name' => 'CalculatorController',
            ]
        );
    }

    /**
     * @Route("/calculator", name="calculator")
     */
    public function solution($number1, $operand, $number2)
    {
        try {
            $calculator = new Calculator($number1, $operand, $number2);

            $result = $calculator->getResult();
        } catch (\Exception $e) {
            $result = $e->getMessage();
        }

        return $this->render(
            'calculator/solution.twig', [
                'controller_name' => 'CalculatorController',
                'solution' => $result,
            ]
        );
    }
}
