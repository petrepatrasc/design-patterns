package ro.petrepatrasc.chainofresponsability.bank;

/**
 * A builder for loan systems.
 *
 * @author Petre Pătrașc <petre@dreamlabs.ro>
 */
public class LoanSystemBuilder {

    public static LoanSystem build() {
        return new LoanSystem();
    }
}
