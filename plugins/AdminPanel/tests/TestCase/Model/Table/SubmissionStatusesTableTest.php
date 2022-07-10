<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\SubmissionStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\SubmissionStatusesTable Test Case
 */
class SubmissionStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\SubmissionStatusesTable
     */
    public $SubmissionStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.SubmissionStatuses',
        'plugin.AdminPanel.KiaSubmissions',
        'plugin.AdminPanel.KkSubmissions',
        'plugin.AdminPanel.KtpSubmissions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SubmissionStatuses') ? [] : ['className' => SubmissionStatusesTable::class];
        $this->SubmissionStatuses = TableRegistry::getTableLocator()->get('SubmissionStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SubmissionStatuses);

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
