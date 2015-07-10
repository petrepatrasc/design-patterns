<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility;

use PetrePatrasc\ChainOfResponsibility\Bank\LoanSystem;

/**
 * A representation of the bank customer that wants to apply for a loan.
 *
 * @package PetrePatrasc\ChainOfResponsibility
 * @author  Petre Pătraşc <petre@dreamlabs.ro>
 */
class BankCustomer implements BankCustomerInterface
{
    /**
     * @var string
     */
    protected $name;

    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * @inheritDoc
     */
    public function applyForLoan(float $amount): LoanApplicationResponse
    {
        $loanSystem = new LoanSystem();
        $loanRequest = new LoanApplicationRequest($this, $amount);

        return $loanSystem->resolveLoanRequest($loanRequest);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return BankCustomer
     */
    public function setName(string $name): BankCustomer
    {
        $this->name = $name;

        return $this;
    }
}
