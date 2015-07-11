<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility\Tests\Agent;


use PetrePatrasc\ChainOfResponsibility\Agent\AbstractLoanAgent;
use PetrePatrasc\ChainOfResponsibility\Agent\LineManager;

class LineManagerTest extends AbstractLoanAgentTest
{
    /**
     * @var LineManager
     */
    protected $lineManager;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->lineManager = new LineManager();
    }

    /**
     * @inheritDoc
     */
    public function loanAmountDataProvider(): array
    {
        return [
            [300.17, true],
            [9474.50, true],
            [15000, true],
            [19999.99, true],
            [20000, false],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getTestedAgent(): AbstractLoanAgent
    {
        return $this->lineManager;
    }
}
