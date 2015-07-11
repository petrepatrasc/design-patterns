<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility;

use PetrePatrasc\ChainOfResponsibility\Bank\LoanSystemBuilder;

/**
 * Main class to execute the functionality of the package.
 * Will not appear in unit tests, and only focus is to provide a small
 * usage example of the code provided.
 *
 * @package PetrePatrasc\ChainOfResponsibility
 * @author Petre Pătraşc <petre@dreamlabs.ro>
 */
class App
{
    public static function main()
    {
        $loanSystem = LoanSystemBuilder::build();

        foreach (self::getCustomers() as $customerDefinition) {
            /** @var BankCustomer $customer */
            $customer = $customerDefinition[0];
            $loanAmount = $customerDefinition[1];

            $loanRequest = new LoanApplicationRequest($customer, $loanAmount);
            $loanResponse = $customer->applyForLoan($loanAmount, $loanSystem);

            echo self::generateStory($loanRequest, $loanResponse);
        }
    }

    public static function getCustomers()
    {
        return [
            [new BankCustomer('John Smith'), 327.17],
            [new BankCustomer('Randy Cooper'), 5836.87],
            [new BankCustomer('Hannah Paul'), 17542.52],
            [new BankCustomer('Jack Trenton'), 28745.52],
        ];
    }

    public static function generateStory(LoanApplicationRequest $request, LoanApplicationResponse $response): string
    {
        $approvedStatus = ($response->isApproved()) ? 'approved' : 'not approved';

        $story = "--- The story of {$request->getCustomer()} ---" . PHP_EOL;
        $story .= "The bank customer {$request->getCustomer()} has applied for a loan of {$request->getAmount()}." . PHP_EOL;
        $story .= "The bank has {$approvedStatus} the request, and the form has been processed by a {$response->getAgent()}." . PHP_EOL . PHP_EOL;

        return $story;
    }
}

require_once '../../vendor/autoload.php';
App::main();
