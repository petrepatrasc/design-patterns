package ro.petrepatrasc.chainofresponsability.loan;

import ro.petrepatrasc.chainofresponsability.agent.AbstractLoanAgent;

/**
 * A representation of a loan application response,
 * from one of the loan agents, intended towards the customer.
 *
 * @author Petre Pătrașc <petre@dreamlabs.ro>
 */
public class LoanApplicationResponse {

    protected boolean approved;

    protected AbstractLoanAgent agent;

    public LoanApplicationResponse(AbstractLoanAgent agent, boolean approved) {
        this.agent = agent;
        this.approved = approved;
    }

    public boolean isApproved() {
        return approved;
    }

    public LoanApplicationResponse setApproved(boolean approved) {
        this.approved = approved;
        return this;
    }

    public AbstractLoanAgent getAgent() {
        return agent;
    }

    public LoanApplicationResponse setAgent(AbstractLoanAgent agent) {
        this.agent = agent;
        return this;
    }
}
