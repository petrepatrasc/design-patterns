package ro.petrepatrasc.chainofresponsability.tests.agent;

import com.tngtech.java.junit.dataprovider.DataProvider;
import com.tngtech.java.junit.dataprovider.DataProviderRunner;
import org.junit.runner.RunWith;
import ro.petrepatrasc.chainofresponsability.agent.AbstractLoanAgent;
import ro.petrepatrasc.chainofresponsability.agent.BranchManager;

@RunWith(DataProviderRunner.class)
public class BranchManagerTest extends AbstractLoanAgentTest {

    @Override
    public AbstractLoanAgent getTestedAgent() {
        return new BranchManager();
    }

    @DataProvider
    public static Object[][] loanAmountDataProvider() {
        return new Object[][]{
                {371.137, true},
                {8360.28, true},
                {5120.75, true},
                {3985.48, true},
                {9999.99, true},
        };
    }
}
