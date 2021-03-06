<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\EventsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\EventsTable Test Case
 */
class EventsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\EventsTable
     */
    public $Events;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.Events',
        'plugin.AdminPanel.Users',
        'plugin.AdminPanel.EventAttendances',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Events') ? [] : ['className' => EventsTable::class];
        $this->Events = TableRegistry::getTableLocator()->get('Events', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Events);

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
