<?php

declare(strict_types = 1);


namespace PetrePatrasc\ChainOfResponsibility\Agent;


use PetrePatrasc\ChainOfResponsibility\LoanApplicationRequest;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse;

class BranchManager extends AbstractLoanAgent
{
    public function __toString(): string
    {
        return 'Branch Manager';
    }

    /**
     * @inheritDoc
     */
    public function handleLoanAmount(LoanApplicationRequest $loanRequest): LoanApplicationResponse
    {
        if ($loanRequest->getAmount() < 10000) {
            return $this->approveLoanRequest();
        }

        return $this->getNextInChain()->handleLoanAmount($loanRequest);
    }

}
