<?php
namespace AdminPanel\Test\TestCase\Controller\Component;

use AdminPanel\Controller\Component\LevelDeterminantComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminPanel\Controller\Component\LevelDeterminantComponent Test Case
 */
class LevelDeterminantComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminPanel\Controller\Component\LevelDeterminantComponent
     */
    public $LevelDeterminant;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->LevelDeterminant = new LevelDeterminantComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LevelDeterminant);

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
