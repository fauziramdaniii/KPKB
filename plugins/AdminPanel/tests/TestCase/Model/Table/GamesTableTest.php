<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\GamesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\GamesTable Test Case
 */
class GamesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\GamesTable
     */
    public $Games;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.Games',
        'plugin.AdminPanel.FfParticipants',
        'plugin.AdminPanel.LiveBagans',
        'plugin.AdminPanel.MatchSchedules',
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
        $config = TableRegistry::getTableLocator()->exists('Games') ? [] : ['className' => GamesTable::class];
        $this->Games = TableRegistry::getTableLocator()->get('Games', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Games);

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
