package ro.petrepatrasc.chainofresponsability.bank;

import ro.petrepatrasc.chainofresponsability.agent.AbstractLoanAgent;
import ro.petrepatrasc.chainofresponsability.agent.BranchManager;
import ro.petrepatrasc.chainofresponsability.agent.LineManager;
import ro.petrepatrasc.chainofresponsability.agent.TillAgent;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationRequest;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationResponse;

/**
 * A representation of the loan system - can also be thought
 * of as a bank/otherwise.
 *
 * @author Petre Pătrașc <petre@dreamlabs.ro>
 */
public class LoanSystem {

    protected AbstractLoanAgent firstInChain;

    public LoanSystem() {
        AbstractLoanAgent firstInChain = this.initializeLoanProcessChain();

        this.setFirstInChain(firstInChain);
    }

    public LoanApplicationResponse resolveLoanRequest(LoanApplicationRequest loanRequest) {
        return this.getFirstInChain().handleLoanRequest(loanRequest);
    }

    protected AbstractLoanAgent initializeLoanProcessChain() {
        LineManager lineManager = new LineManager();

        BranchManager branchManager = new BranchManager();
        branchManager.setNextInChain(lineManager);

        TillAgent tillAgent = new TillAgent();
        tillAgent.setNextInChain(branchManager);

        return tillAgent;
    }

    public AbstractLoanAgent getFirstInChain() {
        return firstInChain;
    }

    public LoanSystem setFirstInChain(AbstractLoanAgent firstInChain) {
        this.firstInChain = firstInChain;
        return this;
    }
}
