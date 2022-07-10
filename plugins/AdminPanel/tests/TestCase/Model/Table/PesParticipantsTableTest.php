<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\PesParticipantsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\PesParticipantsTable Test Case
 */
class PesParticipantsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\PesParticipantsTable
     */
    public $PesParticipants;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.PesParticipants',
        'plugin.AdminPanel.Games',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PesParticipants') ? [] : ['className' => PesParticipantsTable::class];
        $this->PesParticipants = TableRegistry::getTableLocator()->get('PesParticipants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PesParticipants);

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
