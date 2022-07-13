<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\VideosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\VideosTable Test Case
 */
class VideosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\VideosTable
     */
    public $Videos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.Videos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Videos') ? [] : ['className' => VideosTable::class];
        $this->Videos = TableRegistry::getTableLocator()->get('Videos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Videos);

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
