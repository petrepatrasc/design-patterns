package ro.petrepatrasc.chainofresponsability.tests.agent;

import com.tngtech.java.junit.dataprovider.DataProvider;
import ro.petrepatrasc.chainofresponsability.agent.AbstractLoanAgent;
import ro.petrepatrasc.chainofresponsability.agent.BranchManager;
import ro.petrepatrasc.chainofresponsability.agent.LineManager;

public class LineManagerTest extends AbstractLoanAgentTest {

    @Override
    public AbstractLoanAgent getTestedAgent() {
        return new LineManager();
    }

    @DataProvider
    public static Object[][] loanAmountDataProvider() {
        return new Object[][]{
                {9371.137, true},
                {18360.28, true},
                {15120.75, true},
                {13985.48, true},
                {19999.99, true},
                {20000, false},
                {25000.127, false},
                {27158.89, false},
        };
    }
}
