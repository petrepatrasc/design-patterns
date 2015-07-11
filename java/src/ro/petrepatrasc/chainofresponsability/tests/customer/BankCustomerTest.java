package ro.petrepatrasc.chainofresponsability.tests.customer;

import junit.framework.TestCase;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.mockito.Mockito;
import org.mockito.runners.MockitoJUnitRunner;
import ro.petrepatrasc.chainofresponsability.agent.LineManager;
import ro.petrepatrasc.chainofresponsability.agent.TillAgent;
import ro.petrepatrasc.chainofresponsability.bank.LoanSystem;
import ro.petrepatrasc.chainofresponsability.customer.BankCustomer;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationRequest;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationResponse;

@RunWith(MockitoJUnitRunner.class)
public class BankCustomerTest extends TestCase {

    @Test
    public void testApplyForLoanSuccessfully() {
        double loanAmount = 320.17;
        TillAgent expectedLoanAgent = new TillAgent();
        boolean expectedApprovalStatus = true;

        LoanSystem loanSystemMock = Mockito.mock(LoanSystem.class);
        BankCustomer bankCustomer = new BankCustomer("Unit Test Customer");

        LoanApplicationResponse expectedLoanResponse = new LoanApplicationResponse(expectedLoanAgent, expectedApprovalStatus);
        Mockito.when(loanSystemMock.resolveLoanRequest(Mockito.any(LoanApplicationRequest.class))).thenReturn(expectedLoanResponse);

        bankCustomer.applyForLoan(loanAmount, loanSystemMock);
    }

    @Test
    public void testApplyForLoanWithoutSuccess() {
        double loanAmount = 33320.17;
        LineManager expectedLoanAgent = new LineManager();
        boolean expectedApprovalStatus = false;

        LoanSystem loanSystemMock = Mockito.mock(LoanSystem.class);
        BankCustomer bankCustomer = new BankCustomer("Unit Test Customer");

        LoanApplicationResponse expectedLoanResponse = new LoanApplicationResponse(expectedLoanAgent, expectedApprovalStatus);
        Mockito.when(loanSystemMock.resolveLoanRequest(Mockito.any(LoanApplicationRequest.class))).thenReturn(expectedLoanResponse);

        bankCustomer.applyForLoan(loanAmount, loanSystemMock);
    }
}
