package ro.petrepatrasc.chainofresponsability.tests.bank;

import junit.framework.TestCase;
import org.junit.Test;
import ro.petrepatrasc.chainofresponsability.bank.LoanSystem;
import ro.petrepatrasc.chainofresponsability.bank.LoanSystemBuilder;

public class LoanSystemBuilderTest extends TestCase {

    @Test
    public void testBuild() {
        LoanSystem loanSystem = LoanSystemBuilder.build();

        this.assertNotNull(loanSystem);
        this.assertTrue(loanSystem instanceof LoanSystem);
    }
}
