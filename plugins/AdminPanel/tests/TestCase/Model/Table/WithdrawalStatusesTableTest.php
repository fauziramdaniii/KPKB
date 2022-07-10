<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\WithdrawalStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\WithdrawalStatusesTable Test Case
 */
class WithdrawalStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\WithdrawalStatusesTable
     */
    public $WithdrawalStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.WithdrawalStatuses',
        'plugin.AdminPanel.Withdrawals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('WithdrawalStatuses') ? [] : ['className' => WithdrawalStatusesTable::class];
        $this->WithdrawalStatuses = TableRegistry::getTableLocator()->get('WithdrawalStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WithdrawalStatuses);

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
}
