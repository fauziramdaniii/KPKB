<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\OrderDetailSerialsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\OrderDetailSerialsTable Test Case
 */
class OrderDetailSerialsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\OrderDetailSerialsTable
     */
    public $OrderDetailSerials;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.OrderDetailSerials',
        'plugin.AdminPanel.OrderDetails',
        'plugin.AdminPanel.Cards'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrderDetailSerials') ? [] : ['className' => OrderDetailSerialsTable::class];
        $this->OrderDetailSerials = TableRegistry::getTableLocator()->get('OrderDetailSerials', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrderDetailSerials);

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
