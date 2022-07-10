<?php
namespace Member\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Member\Model\Table\CustomerContactsTable;

/**
 * Member\Model\Table\CustomerContactsTable Test Case
 */
class CustomerContactsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Member\Model\Table\CustomerContactsTable
     */
    public $CustomerContacts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Member.CustomerContacts',
        'plugin.Member.Customers',
        'plugin.Member.Countries',
        'plugin.Member.Provinces',
        'plugin.Member.Cities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CustomerContacts') ? [] : ['className' => CustomerContactsTable::class];
        $this->CustomerContacts = TableRegistry::getTableLocator()->get('CustomerContacts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerContacts);

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
