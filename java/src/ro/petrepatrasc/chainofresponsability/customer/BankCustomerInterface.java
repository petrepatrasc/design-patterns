package ro.petrepatrasc.chainofresponsability.customer;

import ro.petrepatrasc.chainofresponsability.bank.LoanSystem;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationResponse;

/**
 * A representations of the actions available for a bank customer.
 *
 * @author Petre Pătrașc <petre@dreamlabs.ro>
 */
public interface BankCustomerInterface {

    LoanApplicationResponse applyForLoan(double amount, LoanSystem loanSystem);
}
