<?php

declare(strict_types = 1);


namespace PetrePatrasc\ChainOfResponsibility;

use PetrePatrasc\ChainOfResponsibility\Agent\AbstractLoanAgent;

/**
 * A representation of a loan application response,
 * from one of the loan agents, intended towards the customer.
 *
 * @package PetrePatrasc\ChainOfResponsibility
 * @author  Petre Pătraşc <petre@dreamlabs.ro>
 */
class LoanApplicationResponse
{
    /**
     * @var bool
     */
    protected $accepted;

    /**
     * @var AbstractLoanAgent
     */
    protected $agent;

    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        return $this->accepted;
    }

    /**
     * @param bool $accepted
     *
     * @return LoanApplicationResponse
     */
    public function setAccepted(bool $accepted): LoanApplicationResponse
    {
        $this->accepted = $accepted;

        return $this;
    }

    /**
     * @return AbstractLoanAgent
     */
    public function getAgent(): AbstractLoanAgent
    {
        return $this->agent;
    }

    /**
     * @param AbstractLoanAgent $agent
     *
     * @return LoanApplicationResponse
     */
    public function setAgent(AbstractLoanAgent $agent): LoanApplicationResponse
    {
        $this->agent = $agent;

        return $this;
    }
}
