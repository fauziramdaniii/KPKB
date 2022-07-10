<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\DailyCustomerPeriodsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\DailyCustomerPeriodsTable Test Case
 */
class DailyCustomerPeriodsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\DailyCustomerPeriodsTable
     */
    public $DailyCustomerPeriods;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.DailyCustomerPeriods',
        'plugin.AdminPanel.Customers',
        'plugin.AdminPanel.CustomerPeriods',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DailyCustomerPeriods') ? [] : ['className' => DailyCustomerPeriodsTable::class];
        $this->DailyCustomerPeriods = TableRegistry::getTableLocator()->get('DailyCustomerPeriods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DailyCustomerPeriods);

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
