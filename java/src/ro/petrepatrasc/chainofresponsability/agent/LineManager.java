package ro.petrepatrasc.chainofresponsability.agent;

import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationRequest;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationResponse;

/**
 * @author Petre Pătrașc <petre@dreamlabs.ro>
 */
public class LineManager extends AbstractLoanAgent {

    public static final double AGENT_THRESHOLD = 20000;

    @Override
    public LoanApplicationResponse handleLoanRequest(LoanApplicationRequest loanRequest) {
        if (loanRequest.getAmount() < this.AGENT_THRESHOLD) {
            return this.approveLoanRequest();
        }

        return this.rejectLoanRequest();
    }
}
