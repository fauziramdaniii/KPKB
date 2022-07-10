<?php
namespace AdminPanel\Test\TestCase\Command;

use AdminPanel\Command\DailyCustomerPeriodCommand;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Command\DailyCustomerPeriodCommand Test Case
 *
 * @uses \AdminPanel\Command\DailyCustomerPeriodCommand
 */
class DailyCustomerPeriodCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->useCommandRunner();
    }
    /**
     * Test buildOptionParser method
     *
     * @return void
     */
    public function testBuildOptionParser()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test execute method
     *
     * @return void
     */
    public function testExecute()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
