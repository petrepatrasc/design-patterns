<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility\Tests\Agent;
use PetrePatrasc\ChainOfResponsibility\Agent\AbstractLoanAgent;
use PetrePatrasc\ChainOfResponsibility\BankCustomer;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationRequest;

/**
 * Governs all of the tests for the agents.
 *
 * @package PetrePatrasc\ChainOfResponsibility\Tests\Agent
 * @author Petre Pătraşc <petre@dreamlabs.ro>
 */
abstract class AbstractLoanAgentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider for testing the business logic of each agent.
     *
     * @return array
     */
    abstract public function loanAmountDataProvider(): array;

    /**
     * Get the loan agent that is being tested.
     *
     * @return AbstractLoanAgent
     */
    abstract protected function getTestedAgent(): AbstractLoanAgent;

    /**
     * @param $loanAmount
     * @param $expectedApproval
     *
     * @dataProvider loanAmountDataProvider
     */
    public function testHandleLoanAmountByCurrentAgent(float $loanAmount, bool $expectedApproval)
    {
        $loanApplicationRequest = new LoanApplicationRequest(new BankCustomer("Unit Test Customer"), $loanAmount);
        $actualLoanResponse = $this->getTestedAgent()->handleLoanAmount($loanApplicationRequest);

        $this->assertNotNull($actualLoanResponse);
        $this->assertInstanceOf('\PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse', $actualLoanResponse);

        $this->assertEquals($this->getTestedAgent(), $actualLoanResponse->getAgent());
        $this->assertEquals($expectedApproval, $actualLoanResponse->isApproved());
    }
}
