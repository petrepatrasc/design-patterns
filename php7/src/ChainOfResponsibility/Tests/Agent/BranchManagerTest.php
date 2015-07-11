<?php

declare(strict_types = 1);

namespace PetrePatrasc\ChainOfResponsibility\Tests\Agent;

use PetrePatrasc\ChainOfResponsibility\Agent\AbstractLoanAgent;
use PetrePatrasc\ChainOfResponsibility\Agent\BranchManager;

class BranchManagerTest extends AbstractLoanAgentTest
{
    /**
     * @var BranchManager
     */
    protected $branchManager;

    public function setUp()
    {
        parent::setUp();

        $this->branchManager = new BranchManager();
    }

    /**
     * @inheritDoc
     */
    protected function getTestedAgent(): AbstractLoanAgent
    {
        return $this->branchManager;
    }

    /**
     * @inheritDoc
     */
    public function loanAmountDataProvider(): array
    {
        return [
            [100, true],
            [300, true],
            [2000, true],
            [9482.382, true],
            [9999.99, true],
        ];
    }
}
