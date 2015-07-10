<?php

declare(strict_types = 1);


namespace PetrePatrasc\ChainOfResponsibility\Agent;


use PetrePatrasc\ChainOfResponsibility\LoanApplicationRequest;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse;

/**
 * The representation of a loan agent and the actions they can perform from
 * within the loan system.
 *
 * @package PetrePatrasc\ChainOfResponsibility\Agent
 * @author  Petre Pătraşc <petre@dreamlabs.ro>
 */
abstract class AbstractLoanAgent
{
    /**
     * @var AbstractLoanAgent
     */
    protected $nextInChain;

    /**
     * Handle the loan amount. In the event that the agent cannot handle the request,
     * they should redirect the request to the next agent in the chain.
     *
     * @param LoanApplicationRequest $loanAmount
     *
     * @return LoanApplicationResponse
     */
    abstract public function handleLoanAmount(LoanApplicationRequest $loanAmount): LoanApplicationResponse;

    /**
     * Approve the loan request and return it to the customer.
     *
     * @return LoanApplicationResponse
     */
    public function approveLoanRequest(): LoanApplicationResponse
    {
        $loanResponse = new LoanApplicationResponse;
        $loanResponse
            ->setAccepted(true)
            ->setAgent($this);

        return $loanResponse;
    }

    /**
     * Approve the loan request and return it to the customer.
     *
     * @return LoanApplicationResponse
     */
    public function rejectLoanRequest(): LoanApplicationResponse
    {
        $loanResponse = new LoanApplicationResponse;
        $loanResponse
            ->setAccepted(false)
            ->setAgent($this);

        return $loanResponse;
    }

    /**
     * @return AbstractLoanAgent
     */
    public function getNextInChain(): AbstractLoanAgent
    {
        return $this->nextInChain;
    }

    /**
     * @param AbstractLoanAgent $nextInChain
     *
     * @return AbstractLoanAgent
     */
    public function setNextInChain(AbstractLoanAgent $nextInChain): AbstractLoanAgent
    {
        $this->nextInChain = $nextInChain;

        return $this;
    }
}
