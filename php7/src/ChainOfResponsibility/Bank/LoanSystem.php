<?php

declare(strict_types = 1);


namespace PetrePatrasc\ChainOfResponsibility\Bank;

use PetrePatrasc\ChainOfResponsibility\Agent\AbstractLoanAgent;
use PetrePatrasc\ChainOfResponsibility\Agent\BranchManager;
use PetrePatrasc\ChainOfResponsibility\Agent\LineManager;
use PetrePatrasc\ChainOfResponsibility\Agent\TillAgent;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationRequest;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse;

/**
 * A representation of the loan system - can also be thought
 * of as a bank/otherwise.
 *
 * @package PetrePatrasc\ChainOfResponsibility\Bank
 * @author  Petre Pătraşc <petre@dreamlabs.ro>
 */
class LoanSystem
{
    /**
     * @var AbstractLoanAgent
     */
    protected $firstInChain;

    public function __construct()
    {
        $firstInChain = $this->initializeLoanProcessChain();

        $this->setFirstInChain($firstInChain);
    }

    /**
     * Resolve the loan request by progressively passing it up the chain until
     * one of the agents picks it up.
     *
     * @param LoanApplicationRequest $loanAmount
     *
     * @return LoanApplicationResponse
     */
    public function resolveLoanRequest(LoanApplicationRequest $loanAmount): LoanApplicationResponse
    {
        return $this->getFirstInChain()->handleLoanAmount($loanAmount);
    }

    /**
     * Initialize the loan process chain and retrieve the first member of the chain.
     *
     * @return AbstractLoanAgent
     */
    protected function initializeLoanProcessChain(): AbstractLoanAgent
    {
        $lineManager = new LineManager();

        $branchManager = new BranchManager();
        $branchManager->setNextInChain($lineManager);

        $tillAgent = new TillAgent();
        $tillAgent->setNextInChain($branchManager);

        return $tillAgent;
    }

    /**
     * @return AbstractLoanAgent
     */
    public function getFirstInChain(): AbstractLoanAgent
    {
        return $this->firstInChain;
    }

    /**
     * @param AbstractLoanAgent $firstInChain
     *
     * @return LoanSystem
     */
    public function setFirstInChain(AbstractLoanAgent $firstInChain): LoanSystem
    {
        $this->firstInChain = $firstInChain;

        return $this;
    }
}
