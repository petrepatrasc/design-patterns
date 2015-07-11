package ro.petrepatrasc.chainofresponsability.agent;

import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationRequest;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationResponse;

/***
 * The representation of a loan agent and the actions they can perform from
 * within the loan system.
 */
abstract public class AbstractLoanAgent {

    protected AbstractLoanAgent nextInChain;

    @Override
    public String toString() {
        return this.getClass().getSimpleName();
    }

    /**
     * Handle the loan amount. In the event that the agent cannot handle the request,
     * they should redirect the request to the next agent in the chain.
     *
     * @param loanRequest
     * @return
     */
    abstract public LoanApplicationResponse handleLoanRequest(LoanApplicationRequest loanRequest);

    /**
     * Approve the loan request and return it to the customer.
     *
     * @return
     */
    public LoanApplicationResponse approveLoanRequest() {
        return new LoanApplicationResponse(this, true);
    }

    /**
     * Approve the loan request and return it to the customer.
     *
     * @return
     */
    public LoanApplicationResponse rejectLoanRequest() {
        return new LoanApplicationResponse(this, false);
    }

    public AbstractLoanAgent getNextInChain() {
        return nextInChain;
    }

    public AbstractLoanAgent setNextInChain(AbstractLoanAgent nextInChain) {
        this.nextInChain = nextInChain;
        return this;
    }
}
