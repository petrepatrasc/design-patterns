<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility\Tests;

use PetrePatrasc\ChainOfResponsibility\BankCustomer;

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
     * @param float  $loanAmount
     * @param bool   $expectedAcceptance
     * @param string $expectedAgentInstance
     *
     * @dataProvider loanApplicationDataProvider
     */
    public function testApplyForLoan(float $loanAmount, bool $expectedAcceptance, string $expectedAgentInstance)
    {
        $loanApprovalResult = $this->bankCustomer->applyForLoan($loanAmount);

        $this->assertNotNull($loanApprovalResult);
        $this->assertInstanceOf('\PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse', $loanApprovalResult);

        $this->assertInternalType('bool', $loanApprovalResult->isAccepted());
        $this->assertEquals($expectedAcceptance, $loanApprovalResult->isAccepted());

        $this->assertNotNull($loanApprovalResult->getAgent());
        $this->assertInstanceOf($expectedAgentInstance, $loanApprovalResult->getAgent());
    }

    public function loanApplicationDataProvider()
    {
        $tillAgent     = '\PetrePatrasc\ChainOfResponsibility\Agent\TillAgent';
        $branchManager = '\PetrePatrasc\ChainOfResponsibility\Agent\BranchManager';
        $lineManager   = '\PetrePatrasc\ChainOfResponsibility\Agent\LineManager';

        return [
            [32.20, true, $tillAgent],
            [320, true, $tillAgent],
            [4999.99, true, $tillAgent],
            [5000, true, $branchManager],
            [9000, true, $branchManager],
            [9999.99, true, $branchManager],
            [10000, true, $lineManager],
            [15000.807, true, $lineManager],
            [19999.99, true, $lineManager],
            [20000, false, $lineManager],
            [30000, false, $lineManager],
        ];
    }

    /**
     * @param mixed $loanAmount
     *
     * @expectedException TypeError
     *
     * @dataProvider typeErrorDataProvider
     */
    public function testApplyForLoanTypeErrorException($loanAmount)
    {
        $this->bankCustomer->applyForLoan($loanAmount);
    }

    public function typeErrorDataProvider()
    {
        return [
            ['32'],
            [new \stdClass()],
            [true]
        ];
    }
}
