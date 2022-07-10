<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\LevelDeterminantComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\LevelDeterminantComponent Test Case
 */
class LevelDeterminantComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\LevelDeterminantComponent
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
