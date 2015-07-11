package ro.petrepatrasc.chainofresponsability.tests.bank;

import com.tngtech.java.junit.dataprovider.DataProvider;
import com.tngtech.java.junit.dataprovider.DataProviderRunner;
import com.tngtech.java.junit.dataprovider.UseDataProvider;
import junit.framework.TestCase;
import org.junit.Test;
import org.junit.runner.RunWith;
import ro.petrepatrasc.chainofresponsability.agent.AbstractLoanAgent;
import ro.petrepatrasc.chainofresponsability.agent.BranchManager;
import ro.petrepatrasc.chainofresponsability.agent.LineManager;
import ro.petrepatrasc.chainofresponsability.agent.TillAgent;
import ro.petrepatrasc.chainofresponsability.bank.LoanSystem;
import ro.petrepatrasc.chainofresponsability.bank.LoanSystemBuilder;
import ro.petrepatrasc.chainofresponsability.customer.BankCustomer;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationRequest;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationResponse;

@RunWith(DataProviderRunner.class)
public class LoanSystemTest extends TestCase {

    @Test
    public void testThatTheFirstElementInTheChainHasBeenDefinedOnConstruction() {
        LoanSystem loanSystem = LoanSystemBuilder.build();
        AbstractLoanAgent firstInChain = loanSystem.getFirstInChain();

        this.assertNotNull(firstInChain);
    }

    @Test
    public void testThatAChainOfMoreThanOneAgentHasBeenDefinedOnConstruction() {
        LoanSystem loanSystem = LoanSystemBuilder.build();
        AbstractLoanAgent firstInChain = loanSystem.getFirstInChain();

        int membersInChain = 1;
        AbstractLoanAgent currentMember = firstInChain;

        while (null != currentMember.getNextInChain()) {
            membersInChain++;
            currentMember = currentMember.getNextInChain();
        }

        this.assertTrue(membersInChain > 1);
    }

    @Test
    @UseDataProvider("loanAmountDataProvider")
    public void testResolveLoanRequest(double loanAmount, boolean expectedAcceptance, Class agentClass) {
        LoanSystem loanSystem = LoanSystemBuilder.build();
        LoanApplicationRequest loanRequest = new LoanApplicationRequest(new BankCustomer("Unit Test Customer"), loanAmount);
        LoanApplicationResponse loanResponse = loanSystem.resolveLoanRequest(loanRequest);

        this.assertNotNull(loanResponse);
        this.assertEquals(expectedAcceptance, loanResponse.isApproved());
        this.assertTrue(loanResponse.getAgent().getClass().equals(agentClass));
    }

    @DataProvider
    public static Object[][] loanAmountDataProvider() {
        return new Object[][]{
                {312.17, true, TillAgent.class},
                {10.38, true, TillAgent.class},
                {512.75, true, TillAgent.class},
                {3985.48, true, TillAgent.class},
                {4999.99, true, TillAgent.class},
                {5120.75, true, BranchManager.class},
                {3985.48, true, TillAgent.class},
                {9999.99, true, BranchManager.class},
                {18360.28, true, LineManager.class},
                {15120.75, true, LineManager.class},
                {13985.48, true, LineManager.class},
                {19999.99, true, LineManager.class},
                {20000, false, LineManager.class},
                {25000.127, false, LineManager.class},
                {27158.89, false, LineManager.class},
        };
    }
}
