<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\KtpSubmissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\KtpSubmissionsTable Test Case
 */
class KtpSubmissionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\KtpSubmissionsTable
     */
    public $KtpSubmissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.KtpSubmissions',
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
        $config = TableRegistry::getTableLocator()->exists('KtpSubmissions') ? [] : ['className' => KtpSubmissionsTable::class];
        $this->KtpSubmissions = TableRegistry::getTableLocator()->get('KtpSubmissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->KtpSubmissions);

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
