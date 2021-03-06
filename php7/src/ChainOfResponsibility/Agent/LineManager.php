<?php

declare(strict_types = 1);


namespace PetrePatrasc\ChainOfResponsibility\Agent;


use PetrePatrasc\ChainOfResponsibility\LoanApplicationRequest;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse;

class LineManager extends AbstractLoanAgent
{
    public function __toString(): string
    {
        return 'Line Manager';
    }

    /**
     * @inheritDoc
     */
    public function handleLoanAmount(LoanApplicationRequest $loanRequest): LoanApplicationResponse
    {
        if ($loanRequest->getAmount() < 20000) {
            return $this->approveLoanRequest();
        }

        return $this->rejectLoanRequest();
    }

}
