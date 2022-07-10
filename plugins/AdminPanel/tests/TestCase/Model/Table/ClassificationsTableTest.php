<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\ClassificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\ClassificationsTable Test Case
 */
class ClassificationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\ClassificationsTable
     */
    public $Classifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.Classifications',
        'plugin.AdminPanel.AddressSubmissions',
        'plugin.AdminPanel.KiaSubmissions',
        'plugin.AdminPanel.KkSubmissions',
        'plugin.AdminPanel.KtpSubmissions',
        'plugin.AdminPanel.Requirements',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Classifications') ? [] : ['className' => ClassificationsTable::class];
        $this->Classifications = TableRegistry::getTableLocator()->get('Classifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Classifications);

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
