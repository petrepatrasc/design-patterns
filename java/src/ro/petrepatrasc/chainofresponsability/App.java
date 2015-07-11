package ro.petrepatrasc.chainofresponsability;

import ro.petrepatrasc.chainofresponsability.bank.LoanSystem;
import ro.petrepatrasc.chainofresponsability.bank.LoanSystemBuilder;
import ro.petrepatrasc.chainofresponsability.customer.BankCustomer;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationRequest;
import ro.petrepatrasc.chainofresponsability.loan.LoanApplicationResponse;
import ro.petrepatrasc.chainofresponsability.tests.customer.BankCustomerScenario;

import java.lang.reflect.Array;
import java.util.ArrayList;

/**
 * Main class to execute the functionality of the package.
 * Will not appear in unit tests, and only focus is to provide a small
 * usage example of the code provided.
 *
 * @author Petre Pătrașc <petre@dreamlabs.ro>
 */
public class App {

    public static void main(String[] args) {
        LoanSystem loanSystem = LoanSystemBuilder.build();

        for (BankCustomerScenario bankScenario : getCustomers()) {
            LoanApplicationRequest loanRequest = new LoanApplicationRequest(bankScenario.getCustomer(), bankScenario.getLoanAmount());
            LoanApplicationResponse loanResponse = bankScenario.getCustomer().applyForLoan(bankScenario.getLoanAmount(), loanSystem);

            System.out.println(generateStory(loanRequest, loanResponse));
        }
    }

    protected static ArrayList<BankCustomerScenario> getCustomers() {
        ArrayList<BankCustomerScenario> bankCustomerScenarios = new ArrayList<BankCustomerScenario>();

        bankCustomerScenarios.add(new BankCustomerScenario(new BankCustomer("John Smith"), 327.17));
        bankCustomerScenarios.add(new BankCustomerScenario(new BankCustomer("Randy Cooper"), 5836.87));
        bankCustomerScenarios.add(new BankCustomerScenario(new BankCustomer("Hannah Paul"), 17542));
        bankCustomerScenarios.add(new BankCustomerScenario(new BankCustomer("Jack Trenton"), 28745));

        return bankCustomerScenarios;
    }

    protected static String generateStory(LoanApplicationRequest loanRequest, LoanApplicationResponse loanResponse) {
        String approvedStatus = (loanResponse.isApproved()) ? "approved" : "not approved";

        StringBuilder story = new StringBuilder("--- The story of " + loanRequest.getCustomer() + " ---" + "\n");
        story.append("The bank customer " + loanRequest.getCustomer() + " has applied for a loan of " + loanRequest.getAmount() + "." + "\n");
        story.append("The bank has " + approvedStatus + " the request, and the form has been processed by a " + loanResponse.getAgent() + ".\n");

        return story.toString();
    }
}
