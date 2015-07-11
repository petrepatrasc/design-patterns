package ro.petrepatrasc.chainofresponsability.tests.customer;

import ro.petrepatrasc.chainofresponsability.customer.BankCustomer;

public class BankCustomerScenario {

    protected BankCustomer customer;

    protected double loanAmount;

    public BankCustomerScenario(BankCustomer customer, double loanAmount) {
        this.customer = customer;
        this.loanAmount = loanAmount;
    }

    public BankCustomer getCustomer() {
        return customer;
    }

    public BankCustomerScenario setCustomer(BankCustomer customer) {
        this.customer = customer;
        return this;
    }

    public double getLoanAmount() {
        return loanAmount;
    }

    public BankCustomerScenario setLoanAmount(double loanAmount) {
        this.loanAmount = loanAmount;
        return this;
    }
}
