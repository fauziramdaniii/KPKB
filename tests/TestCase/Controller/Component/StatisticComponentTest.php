<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\StatisticComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\StatisticComponent Test Case
 */
class StatisticComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\StatisticComponent
     */
    public $Statistic;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Statistic = new StatisticComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Statistic);

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
