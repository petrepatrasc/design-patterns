package ro.petrepatrasc.chainofresponsability.tests.agent;

import com.tngtech.java.junit.dataprovider.DataProviderRunner;
import com.tngtech.java.junit.dataprovider.UseDataProvider;
import junit.framework.TestCase;
import org.junit.Test;
import org.junit.runner.RunWith;
import ro.petrepatrasc.chainofresponsability.agent.AbstractLoanAgent;
import ro.petrepatrasc.chainofresponsability.agent.TillAgent;
import ro.petrepatrasc.chainofresponsability.customer.BankCustomer;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationRequest;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationResponse;

@RunWith(DataProviderRunner.class)
abstract public class AbstractLoanAgentTest extends TestCase {

    @Test
    @UseDataProvider("loanAmountDataProvider")
    public void testHandleLoanAmountByCurrentAgent(double loanAmount, boolean expectedApproval) throws Exception {
        AbstractLoanAgent testedAgent = this.getTestedAgent();

        LoanApplicationRequest loanRequest = new LoanApplicationRequest(new BankCustomer(new String("Unit Test Customer")), loanAmount);

        LoanApplicationResponse actualLoanResponse = testedAgent.handleLoanRequest(loanRequest);

        this.assertEquals(testedAgent, actualLoanResponse.getAgent());
        this.assertEquals(expectedApproval, actualLoanResponse.isApproved());
    }

    /**
     * Get the loan agent that is being tested in the class.
     *
     * @return
     */
    abstract public AbstractLoanAgent getTestedAgent();
}
