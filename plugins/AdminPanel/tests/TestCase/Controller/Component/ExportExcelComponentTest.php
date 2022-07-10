<?php
namespace AdminPanel\Test\TestCase\Controller\Component;

use AdminPanel\Controller\Component\ExportExcelComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Controller\Component\ExportExcelComponent Test Case
 */
class ExportExcelComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Controller\Component\ExportExcelComponent
     */
    public $ExportExcel;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->ExportExcel = new ExportExcelComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExportExcel);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
