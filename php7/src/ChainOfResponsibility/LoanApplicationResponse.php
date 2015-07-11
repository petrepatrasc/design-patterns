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
    protected $approved;

    /**
     * @var AbstractLoanAgent
     */
    protected $agent;

    /**
     * LoanApplicationResponse constructor.
     *
     * @param AbstractLoanAgent $agent
     * @param bool $approved
     */
    public function __construct(AbstractLoanAgent $agent = null, bool $approved = false)
    {
        $this->agent = $agent;
        $this->approved = $approved;
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->approved;
    }

    /**
     * @param bool $approved
     *
     * @return LoanApplicationResponse
     */
    public function setApproved(bool $approved): LoanApplicationResponse
    {
        $this->approved = $approved;

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
