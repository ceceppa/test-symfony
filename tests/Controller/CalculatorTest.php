<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    private $client = null;
    private $crawler = null;

    function setUp() : void
    {
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/calculator');
    }
    function test_calculator_route_should_exists()
    {
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    function test_should_render_the_calculator_form()
    {
        $this->assertEquals(
            1,
            $this->crawler->filter('html form')->count()
        );
    }

    function test_should_render_the_display()
    {
        $this->assertEquals(
            1,
            $this->crawler->filter('html span.calculator-display')->count()
        );
    }

    function test_should_render_the_numpad()
    {
        $this->assertEquals(
            10,
            $this->crawler->filter('html button.number')->count()
        );
    }

    function test_should_render_the_operand_buttons()
    {
        $this->assertEquals(
            4,
            $this->crawler->filter('html button.operand')->count()
        );
    }

    function test_should_render_the_submit_button()
    {
        $this->assertEquals(
            1,
            $this->crawler->filter('html button[type="submit"]')->count()
        );
    }

    function test_calculator_solution_route_should_exists()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/calculator/solution/1/+/2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    function test_calculator_solution_route_should_fail_if_wrong_operand()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/calculator/solution/1/x/2');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/calculator/solution/1//2');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }


    function test_calculator_solution_plus()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/calculator/solution/1/+/2');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // $crawler = $client->request('GET', '/calculator/solution/1/-/2');
        // $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // $crawler = $client->request('GET', '/calculator/solution/1/*/2');
        // $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // $crawler = $client->request('GET', '/calculator/solution/1/%2F/2');
        // $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}