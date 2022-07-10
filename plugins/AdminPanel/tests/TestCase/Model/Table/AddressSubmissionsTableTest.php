<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\AddressSubmissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\AddressSubmissionsTable Test Case
 */
class AddressSubmissionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\AddressSubmissionsTable
     */
    public $AddressSubmissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.AddressSubmissions',
        'plugin.AdminPanel.Customers',
        'plugin.AdminPanel.Images',
        'plugin.AdminPanel.SubmissionStatuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AddressSubmissions') ? [] : ['className' => AddressSubmissionsTable::class];
        $this->AddressSubmissions = TableRegistry::getTableLocator()->get('AddressSubmissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AddressSubmissions);

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
