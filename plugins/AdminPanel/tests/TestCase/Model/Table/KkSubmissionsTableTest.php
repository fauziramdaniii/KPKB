<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\KkSubmissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\KkSubmissionsTable Test Case
 */
class KkSubmissionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\KkSubmissionsTable
     */
    public $KkSubmissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.KkSubmissions',
        'plugin.AdminPanel.Customers',
        'plugin.AdminPanel.SubmissionStatuses',
        'plugin.AdminPanel.Images',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('KkSubmissions') ? [] : ['className' => KkSubmissionsTable::class];
        $this->KkSubmissions = TableRegistry::getTableLocator()->get('KkSubmissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->KkSubmissions);

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
