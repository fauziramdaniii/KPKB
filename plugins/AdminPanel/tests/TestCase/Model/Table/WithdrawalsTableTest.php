<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\WithdrawalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\WithdrawalsTable Test Case
 */
class WithdrawalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\WithdrawalsTable
     */
    public $Withdrawals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.Withdrawals',
        'plugin.AdminPanel.Customers',
        'plugin.AdminPanel.CustomerBanks',
        'plugin.AdminPanel.WithdrawalStatuses',
        'plugin.AdminPanel.Transactions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Withdrawals') ? [] : ['className' => WithdrawalsTable::class];
        $this->Withdrawals = TableRegistry::getTableLocator()->get('Withdrawals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Withdrawals);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
