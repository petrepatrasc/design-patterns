<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility\Tests;

use PetrePatrasc\ChainOfResponsibility\Agent\AbstractLoanAgent;
use PetrePatrasc\ChainOfResponsibility\Agent\BranchManager;
use PetrePatrasc\ChainOfResponsibility\Agent\LineManager;
use PetrePatrasc\ChainOfResponsibility\Agent\TillAgent;
use PetrePatrasc\ChainOfResponsibility\BankCustomer;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse;

class BankCustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BankCustomer
     */
    protected $bankCustomer;

    public function setUp()
    {
        parent::setUp();

        $this->bankCustomer = new BankCustomer("Unit Test");
    }

    /**
     * @param float $loanAmount
     * @param AbstractLoanAgent $expectedAgent
     * @param bool $expectedApprovalStatus
     *
     * @dataProvider loanApplicationDataProvider
     */
    public function testApplyForLoan(float $loanAmount, AbstractLoanAgent $expectedAgent, bool $expectedApprovalStatus)
    {
        $expectedLoanResponse = new LoanApplicationResponse($expectedAgent, $expectedApprovalStatus);

        $loanSystemMock = $this->getMockBuilder('PetrePatrasc\ChainOfResponsibility\Bank\LoanSystem')
            ->setMethods(['resolveLoanRequest'])
            ->getMock();
        $loanSystemMock->expects($this->atLeastOnce())->method('resolveLoanRequest')->willReturn($expectedLoanResponse);

        $actualLoanResponse = $this->bankCustomer->applyForLoan($loanAmount, $loanSystemMock);

        $this->assertNotNull($actualLoanResponse, 'No loan response received.');
        $this->assertEquals($expectedLoanResponse, $actualLoanResponse, 'Loan response was different than expected.');
    }

    public function loanApplicationDataProvider(): array
    {
        return [
            [320.17, new TillAgent(), true],
            [3200.18, new TillAgent(), true],
            [4999.99, new TillAgent(), true],
            [5000, new BranchManager(), true],
            [5283.74, new BranchManager(), true],
            [9999.99, new BranchManager(), true],
            [10000, new LineManager(), true],
            [13084.85, new LineManager(), true],
            [19999.99, new LineManager(), true],
            [20000, new LineManager(), false],
        ];
    }
}
