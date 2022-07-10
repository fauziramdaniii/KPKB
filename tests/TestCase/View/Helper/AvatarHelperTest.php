<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\AvatarHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\AvatarHelper Test Case
 */
class AvatarHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\AvatarHelper
     */
    public $Avatar;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Avatar = new AvatarHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Avatar);

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
