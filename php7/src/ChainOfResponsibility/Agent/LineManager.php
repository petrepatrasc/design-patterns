<?php

declare(strict_types = 1);


namespace PetrePatrasc\ChainOfResponsibility\Agent;


use PetrePatrasc\ChainOfResponsibility\LoanApplicationRequest;
use PetrePatrasc\ChainOfResponsibility\LoanApplicationResponse;

class LineManager extends AbstractLoanAgent
{
    /**
     * @inheritDoc
     */
    public function handleLoanAmount(LoanApplicationRequest $loanAmount): LoanApplicationResponse
    {
        if ($loanAmount->getAmount() < 20000) {
            return $this->approveLoanRequest();
        }

        return $this->rejectLoanRequest();
    }

}
