<?php
namespace Member\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Member\Model\Table\ProvincesTable;

/**
 * Member\Model\Table\ProvincesTable Test Case
 */
class ProvincesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Member\Model\Table\ProvincesTable
     */
    public $Provinces;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Member.Provinces',
        'plugin.Member.Cities',
        'plugin.Member.CustomerContacts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Provinces') ? [] : ['className' => ProvincesTable::class];
        $this->Provinces = TableRegistry::getTableLocator()->get('Provinces', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Provinces);

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
