<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility\Tests\Agent;


use PetrePatrasc\ChainOfResponsibility\Agent\AbstractLoanAgent;
use PetrePatrasc\ChainOfResponsibility\Agent\TillAgent;

class TillAgentTest extends AbstractLoanAgentTest
{
    /**
     * @var TillAgent
     */
    protected $tillAgent;

    public function setUp()
    {
        parent::setUp();

        $this->tillAgent = new TillAgent();
    }

    /**
     * @inheritDoc
     */
    public function loanAmountDataProvider(): array
    {
        return [
            [10, true],
            [50, true],
            [310.3827, true],
            [999.70, true],
            [4999.99, true],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getTestedAgent(): AbstractLoanAgent
    {
        return $this->tillAgent;
    }

}
