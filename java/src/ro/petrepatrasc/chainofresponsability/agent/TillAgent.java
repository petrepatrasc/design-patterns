package ro.petrepatrasc.chainofresponsability.agent;

import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationRequest;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationResponse;

/**
 * @author Petre Pătrașc <petre@dreamlabs.ro>
 */
public class TillAgent extends AbstractLoanAgent {

    public static final float AGENT_THRESHOLD = 5000;

    @java.lang.Override
    public LoanApplicationResponse handleLoanRequest(LoanApplicationRequest loanRequest) {
        if (loanRequest.getAmount() < this.AGENT_THRESHOLD) {
            return this.approveLoanRequest();
        }

        return this.getNextInChain().handleLoanRequest(loanRequest);
    }
}
