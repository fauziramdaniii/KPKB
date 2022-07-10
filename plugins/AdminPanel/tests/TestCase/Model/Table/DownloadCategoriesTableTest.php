<?php
namespace AdminPanel\Test\TestCase\Model\Table;

use AdminPanel\Model\Table\DownloadCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Model\Table\DownloadCategoriesTable Test Case
 */
class DownloadCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AdminPanel\Model\Table\DownloadCategoriesTable
     */
    public $DownloadCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminPanel.DownloadCategories',
        'plugin.AdminPanel.Downloads'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DownloadCategories') ? [] : ['className' => DownloadCategoriesTable::class];
        $this->DownloadCategories = TableRegistry::getTableLocator()->get('DownloadCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DownloadCategories);

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
