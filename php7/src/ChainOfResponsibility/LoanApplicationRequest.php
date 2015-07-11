<?php

declare(strict_types = 1);


namespace PetrePatrasc\ChainOfResponsibility;

/**
 * A representation of a loan application request,
 * from a customer, towards the loan system.
 *
 * @package PetrePatrasc\ChainOfResponsibility
 * @author  Petre Pătraşc <petre@dreamlabs.ro>
 */
class LoanApplicationRequest
{
    /**
     * @var BankCustomer
     */
    protected $customer;

    /**
     * @var float
     */
    protected $amount;

    /**
     * LoanApplicationRequest constructor.
     *
     * @param BankCustomer $customer
     * @param float        $amount
     */
    public function __construct(BankCustomer $customer = null, float $amount = 0)
    {
        $this->customer = $customer;
        $this->amount   = $amount;
    }

    /**
     * @return BankCustomer
     */
    public function getCustomer(): BankCustomer
    {
        return $this->customer;
    }

    /**
     * @param BankCustomer $customer
     *
     * @return LoanApplicationRequest
     */
    public function setCustomer(BankCustomer $customer): LoanApplicationRequest
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return LoanApplicationRequest
     */
    public function setAmount(float $amount): LoanApplicationRequest
    {
        $this->amount = $amount;

        return $this;
    }
}
