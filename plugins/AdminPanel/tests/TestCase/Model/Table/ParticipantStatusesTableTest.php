<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\ParticipantStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\ParticipantStatusesTable Test Case
 */
class ParticipantStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\ParticipantStatusesTable
     */
    public $ParticipantStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.ParticipantStatuses',
        'plugin.AdminPanel.FfParticipants',
        'plugin.AdminPanel.MlParticipants',
        'plugin.AdminPanel.PesParticipants',
        'plugin.AdminPanel.PubgParticipants',
        'plugin.AdminPanel.ValorantParticipants',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ParticipantStatuses') ? [] : ['className' => ParticipantStatusesTable::class];
        $this->ParticipantStatuses = TableRegistry::getTableLocator()->get('ParticipantStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ParticipantStatuses);

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
