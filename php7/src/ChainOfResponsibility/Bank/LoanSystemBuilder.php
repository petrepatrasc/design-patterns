<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility\Bank;

/**
 * A builder for loan systems.
 *
 * @package PetrePatrasc\ChainOfResponsibility\Bank
 * @author Petre Pătraşc <petre@dreamlabs.ro>
 */
class LoanSystemBuilder
{
    public static function build(): LoanSystem
    {
        return new LoanSystem();
    }
}
