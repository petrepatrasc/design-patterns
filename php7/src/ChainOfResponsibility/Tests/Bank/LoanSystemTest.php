<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility\Tests\Bank;


use PetrePatrasc\ChainOfResponsibility\Bank\LoanSystem;
use PetrePatrasc\ChainOfResponsibility\Bank\LoanSystemBuilder;
use PetrePatrasc\ChainOfResponsibility\BankCustomer;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationRequest;

class LoanSystemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LoanSystem
     */
    protected $loanSystem;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->loanSystem = LoanSystemBuilder::build();
    }

    public function testThatTheFirstElementInTheChainHasBeenDefinedOnConstruction()
    {
        $firstInChain = $this->loanSystem->getFirstInChain();

        $this->assertNotNull($firstInChain, 'No agents have been defined in the chain');
        $this->assertInstanceOf('\PetrePatrasc\ChainOfResponsibility\Agent\AbstractLoanAgent', $firstInChain);
    }

    public function testThatAChainOfMoreThanOneAgentHasBeenDefinedOnConstruction()
    {
        $firstInChain = $this->loanSystem->getFirstInChain();

        $membersInChain = 1;
        $currentMember = $firstInChain;

        while (null !== $currentMember->getNextInChain()) {
            $this->assertInstanceOf('\PetrePatrasc\ChainOfResponsibility\Agent\AbstractLoanAgent', $currentMember->getNextInChain(), 'The next member in the chain is not a loan agent.');

            $membersInChain++;
            $currentMember = $currentMember->getNextInChain();
        }

        $this->assertGreaterThan(1, $membersInChain, 'The chain should consist of more than one loan agents.');
    }

    /**
     * @param float $loanAmount
     * @param bool $expectedAcceptance
     * @param string $expectedAgentInstance
     *
     * @dataProvider loanApplicationDataProvider
     */
    public function testResolveLoanRequest(float $loanAmount, bool $expectedAcceptance, string $expectedAgentInstance)
    {
        $loanRequest = new LoanApplicationRequest(new BankCustomer('Unit Test Customer'), $loanAmount);
        $loanApprovalResult = $this->loanSystem->resolveLoanRequest($loanRequest);

        $this->assertNotNull($loanApprovalResult);
        $this->assertInstanceOf('\PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse', $loanApprovalResult);

        $this->assertInternalType('bool', $loanApprovalResult->isApproved());
        $this->assertEquals($expectedAcceptance, $loanApprovalResult->isApproved());

        $this->assertNotNull($loanApprovalResult->getAgent());
        $this->assertInstanceOf($expectedAgentInstance, $loanApprovalResult->getAgent());
    }

    public function loanApplicationDataProvider(): array
    {
        $tillAgent = '\PetrePatrasc\ChainOfResponsibility\Agent\TillAgent';
        $branchManager = '\PetrePatrasc\ChainOfResponsibility\Agent\BranchManager';
        $lineManager = '\PetrePatrasc\ChainOfResponsibility\Agent\LineManager';

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
    public function testResolveLoanRequestTypeErrorException($loanAmount)
    {
        $loanRequest = new LoanApplicationRequest(new BankCustomer('Unit Test Customer'), $loanAmount);

        $this->loanSystem->applyForLoan($loanRequest);
    }

    public function typeErrorDataProvider(): array
    {
        return [
            ['32'],
            [new \stdClass()],
            [true]
        ];
    }
}
