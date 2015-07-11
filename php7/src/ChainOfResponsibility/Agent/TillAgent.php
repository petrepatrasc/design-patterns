<?php

declare(strict_types = 1);


namespace PetrePatrasc\ChainOfResponsibility\Agent;


use PetrePatrasc\ChainOfResponsibility\LoanApplicationRequest;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse;

class TillAgent extends AbstractLoanAgent
{
    public function __toString(): string
    {
        return 'Till Agent';
    }

    /**
     * @inheritDoc
     */
    public function handleLoanAmount(LoanApplicationRequest $loanRequest): LoanApplicationResponse
    {
        if ($loanRequest->getAmount() < 5000) {
            return $this->approveLoanRequest();
        }

        return $this->getNextInChain()->handleLoanAmount($loanRequest);
    }
}
