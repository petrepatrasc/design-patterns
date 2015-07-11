package ro.petrepatrasc.chainofresponsability.customer;

import ro.petrepatrasc.chainofresponsability.bank.LoanSystem;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationRequest;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationResponse;

/**
 * A representation of the bank customer that wants to apply for a loan.
 *
 * @author Petre Pătrașc <petre@dreamlabs.ro>
 */
public class BankCustomer implements BankCustomerInterface {

    protected String name;

    public BankCustomer(String name) {
        this.name = name;
    }

    @Override
    public String toString() {
        return this.getName();
    }

    @Override
    public LoanApplicationResponse applyForLoan(double amount, LoanSystem loanSystem) {
        LoanApplicationRequest loanRequest = new LoanApplicationRequest(this, amount);

        return loanSystem.resolveLoanRequest(loanRequest);
    }

    public String getName() {
        return name;
    }

    public BankCustomer setName(String name) {
        this.name = name;
        return this;
    }
}
