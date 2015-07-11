<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility\Tests\Bank;


use PetrePatrasc\ChainOfResponsibility\Bank\LoanSystemBuilder;

class LoanSystemBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $loanSystem = LoanSystemBuilder::build();

        $this->assertNotNull($loanSystem);
        $this->assertInstanceOf('\PetrePatrasc\ChainOfResponsibility\Bank\LoanSystem', $loanSystem);
    }
}
