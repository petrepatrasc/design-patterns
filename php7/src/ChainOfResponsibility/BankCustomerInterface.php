<?php

declare(strict_types = 1);


namespace PetrePatrasc\ChainOfResponsibility;
use PetrePatrasc\ChainOfResponsibility\Bank\LoanSystem;

/**
 * A representations of the actions available for a bank customer.
 *
 * @package PetrePatrasc\ChainOfResponsibility
 * @author  Petre Pătraşc <petre@dreamlabs.ro>
 */
interface BankCustomerInterface
{
    /**
     * Apply for a loan for a specific amount.
     *
     * @param float $amount The amount that the user wants to apply for.
     * @param LoanSystem $loanSystem
     *
     * @return LoanApplicationResponse
     */
    function applyForLoan(float $amount, LoanSystem $loanSystem): LoanApplicationResponse;
}
