package ro.petrepatrasc.chainofresponsability.tests.agent;

import com.tngtech.java.junit.dataprovider.DataProvider;
import com.tngtech.java.junit.dataprovider.DataProviderRunner;
import org.junit.runner.RunWith;
import ro.petrepatrasc.chainofresponsability.agent.AbstractLoanAgent;
import ro.petrepatrasc.chainofresponsability.agent.TillAgent;

@RunWith(DataProviderRunner.class)
public class TillAgentTest extends AbstractLoanAgentTest {

    @Override
    public AbstractLoanAgent getTestedAgent() {
        return new TillAgent();
    }

    @DataProvider
    public static Object[][] loanAmountDataProvider() {
        return new Object[][]{
                {312.17, true},
                {10.38, true},
                {512.75, true},
                {3985.48, true},
                {4999.99, true},
        };
    }
}
