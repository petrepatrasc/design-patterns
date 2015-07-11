package ro.petrepatrasc.chainofresponsability.loan;

import ro.petrepatrasc.chainofresponsability.customer.BankCustomer;

/**
 * A representation of a loan application request,
 * from a customer, towards the loan system.
 *
 * @author Petre Pătrașc <petre@dreamlabs.ro>
 */
public class LoanApplicationRequest {

    protected double amount;

    protected BankCustomer customer;

    public LoanApplicationRequest(BankCustomer customer, double amount) {
        this.amount = amount;
        this.customer = customer;
    }

    public double getAmount() {
        return amount;
    }

    public LoanApplicationRequest setAmount(double amount) {
        this.amount = amount;
        return this;
    }

    public BankCustomer getCustomer() {
        return customer;
    }

    public LoanApplicationRequest setCustomer(BankCustomer customer) {
        this.customer = customer;
        return this;
    }
}
