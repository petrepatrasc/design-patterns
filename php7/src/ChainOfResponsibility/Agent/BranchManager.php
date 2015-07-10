<?php

declare(strict_types = 1);


namespace PetrePatrasc\ChainOfResponsibility\Agent;


use PetrePatrasc\ChainOfResponsibility\LoanApplicationRequest;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse;

class BranchManager extends AbstractLoanAgent
{
    /**
     * @inheritDoc
     */
    public function handleLoanAmount(LoanApplicationRequest $loanAmount): LoanApplicationResponse
    {
        if ($loanAmount->getAmount() < 10000) {
            return $this->approveLoanRequest();
        }

        return $this->getNextInChain()->handleLoanAmount($loanAmount);
    }

}
